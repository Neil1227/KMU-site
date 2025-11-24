<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostMedia;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $query = Post::with('media', 'admin')->orderBy('created_at', 'desc');

        // Only KMU can see unapproved posts
        if (session('role') !== 'KMU') {
            $query->where('is_approved', true);
        }

        // Execute the query
        $posts = $query->get();

        // Prepare Facebook Pages (static)
        $facebookPages = [
            [
                'title' => 'PSAU Office of Extension and Training',
                'url' => 'https://www.facebook.com/PSAUOET',
                'logo' => 'assets/img/about/Logo (1).png',
            ],
            [
                'title' => 'PSAU Knowledge Management Center',
                'url' => 'https://www.facebook.com/psau.kmc',
                'logo' => 'assets/img/logo.png',
            ],
            [
                'title' => 'PSAU-Intellectual Property and Technology Business Management Office',
                'url' => 'https://www.facebook.com/psau.iptbm',
                'logo' => 'assets/img/iptbm.png',
            ],
            [
                'title' => 'PSAU-Technology Business Incubator',
                'url' => 'https://www.facebook.com/psau.tbi',
                'logo' => 'assets/img/sibultbi-logo.png',
            ],
        ];

        return view('media-resources-section.updates', compact('posts', 'facebookPages'));
    }

    // Admin overview
    public function adminIndex(Request $request)
    {
        $selectedOffice = $request->query('office', 'all');

        $query = Post::with('media', 'admin')->orderBy('created_at', 'desc');

        if ($selectedOffice !== 'all') {
            $query->whereHas('admin', function ($q) use ($selectedOffice) {
                // Make comparison case-insensitive
                $q->whereRaw('UPPER(role) = ?', [strtoupper($selectedOffice)]);
            });
        }

        $posts = $query->paginate(6)->withQueryString();

        return view('admin.upload-updates', compact('posts', 'selectedOffice'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'media.*' => 'nullable|file',
        ]);

        // Detect type
        $detectedTypes = [];

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $ext = strtolower($file->getClientOriginalExtension());

                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $detectedTypes[] = 'image';
                } elseif ($ext === 'mp4') {
                    $detectedTypes[] = 'video';
                } elseif (in_array($ext, ['pdf', 'doc', 'docx'])) {
                    $detectedTypes[] = 'file';
                }
            }
        }

        // Final post type
        $postType = 'text'; // default

        if (!empty($detectedTypes)) {
            $unique = array_unique($detectedTypes);
            $postType = count($unique) > 1 ? 'mixed' : $unique[0];
        }

        // Create the post
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'admin_id' => session('admin_id'),
            'tags' => $request->filled('tags') ? implode(',', array_unique($request->tags)) : null,
            'sdg_target_indicators' => $request->sdg_target_indicators,
            'type' => $postType,
            'is_approved' => false, // KMU will approve manually
        ]);




        // Save media
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('uploads', 'public');
                $ext = strtolower($file->getClientOriginalExtension());

                $mediaType = match (true) {
                    in_array($ext, ['jpg', 'jpeg', 'png', 'webp']) => 'image',
                    $ext === 'mp4' => 'video',
                    in_array($ext, ['pdf', 'doc', 'docx']) => 'file',
                    default => 'other',
                };

                PostMedia::create([
                    'post_id' => $post->id,
                    'type' => $mediaType,
                    'url' => $path,
                    'admin_id' => session('admin_id'),
                ]);
            }
        }

        return back()->with('success', 'Post created successfully!');
    }

    // Load post data for edit
    public function edit($id)
    {
        $post = Post::with('media')->findOrFail($id);

        return response()->json([
            'id' => $post->id,
            'title' => $post->title,
            'description' => $post->description,
            'sdg_target_indicators' => $post->sdg_target_indicators,
            'tags' => $post->tags ?? [], // always array thanks to mutator
            'media' => $post->media,
        ]);
    }

    // Update post
    public function update(Request $request, $id)
    {
        $post = Post::with('media')->findOrFail($id);

        // Update main fields
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'sdg_target_indicators' => $request->sdg_target_indicators,
            'tags' => $request->tags, // mutator converts array to CSV
        ]);

        // Replace media if new files uploaded
        if ($request->hasFile('media')) {
            // Delete old media files and records
            foreach ($post->media as $m) {
                Storage::disk('public')->delete($m->url);
                $m->delete();
            }

            // Save new media with proper type detection
            foreach ($request->file('media') as $file) {
                $path = $file->store('uploads', 'public');
                $ext = strtolower($file->getClientOriginalExtension());

                $mediaType = match (true) {
                    in_array($ext, ['jpg', 'jpeg', 'png', 'webp']) => 'image',
                    $ext === 'mp4' => 'video',
                    in_array($ext, ['pdf', 'doc', 'docx']) => 'file',
                    default => 'other',
                };

                PostMedia::create([
                    'post_id' => $post->id,
                    'type' => $mediaType,
                    'url' => $path,
                    'admin_id' => session('admin_id'),
                ]);
            }
        }

        return response()->json(['success' => true]);
    }


    public function approve($id)
    {
        $post = Post::findOrFail($id);

        // Only KMU can approve
        if (session('admin_role') !== 'KMU') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $post->is_approved = true;
        $post->save();

        return response()->json(['success' => true, 'message' => 'Post approved successfully']);
    }




    // Delete post
    public function destroy(Post $post)
    {
        try {
            $post->delete();
            return response()->json([
                'success' => true,
                'message' => 'Post deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete post.'
            ], 500);
        }
    }
}
