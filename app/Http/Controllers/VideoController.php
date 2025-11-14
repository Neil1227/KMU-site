<?php

namespace App\Http\Controllers;

use App\Models\ICTV;
use App\Models\Podcast;
use App\Models\PromotionalActivity;

class VideoController extends Controller
{
    /**
     * Display the featured video and playlist for the given type.
     *
     * @param  int|null  $limit  Optional limit for the playlist
     * @return \Illuminate\View\View
     */
    public function show(string $type, ?int $id = null)
    {
        // Map content types to models and titles
        $models = [
            'ictv' => ICTV::class,
            'podcast' => Podcast::class,
            'promo' => PromotionalActivity::class,
        ];

        $titles = [
            'ictv' => 'ICTV',
            'podcast' => 'Podcast',
            'promo' => 'Promotional Activities',
        ];

        // Validate type
        if (! isset($models[$type])) {
            abort(404, 'Content type not found.');
        }

        $model = $models[$type];
        $title = $titles[$type];

        // Featured item
        $featured = $id ? $model::findOrFail($id) : $model::latest()->first();

        // Playlist: exclude the featured video, no limit
        $playlist = $model::where('id', '!=', $featured->id)
            ->latest()
            ->get();

        return view('video', compact('featured', 'playlist', 'title', 'type'));
    }
}
