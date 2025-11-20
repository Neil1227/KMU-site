<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostMedia;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::find(8); // or Admin::find(12)

        $postsData = [
            [
                'type' => 'image',
                'title' => 'Product Launch Event 2024',
                'description' => 'Celebrating our biggest product launch.',
                'tags' => [1, 3, 10],
                'media' => [
                    ['type' => 'image', 'url' => 'post/post_thumbnail/6879fd05a1cbc.png']
                ],
            ],
            [
                'type' => 'image',
                'title' => 'Team Building Activities',
                'description' => 'Our team enjoying fun and bonding activities.',
                'tags' => [2, 4, 6, 12],
                'media' => [
                    ['type' => 'image', 'url' => 'post/post_thumbnail/6879fd05a1cbc.png'],
                    ['type' => 'image', 'url' => 'post/post_thumbnail/6879fd05a1cbc.png'],
                    ['type' => 'image', 'url' => 'post/post_thumbnail/6879fd05a1cbc.png'],
                    ['type' => 'image', 'url' => 'post/post_thumbnail/6879fd05a1cbc.png'],
                    ['type' => 'image', 'url' => 'post/post_thumbnail/6879fd05a1cbc.png'],
                    ['type' => 'image', 'url' => 'post/post_thumbnail/6879fd05a1cbc.png'],
                ],
            ],
            [
                'type' => 'video',
                'title' => 'Behind the Scenes: Development Process',
                'description' => 'How our team builds amazing features.',
                'tags' => [1, 7, 10, 12],
                'media' => [
                    ['type' => 'video', 'url' => 'post/post_thumbnail/videoes/example.mp4']
                ],
            ],
            [
                'type' => 'file',
                'title' => 'Project Report PDF',
                'description' => 'Project report PDF file.',
                'tags' => [4, 8, 12, 10],
                'media' => [
                    ['type' => 'file', 'url' => 'post/pdf/resume.pdf']
                ],
            ],
        ];

        foreach ($postsData as $data) {

            $post = Post::create([
                'admin_id' => $admin->id,
                'type' => $data['type'],
                'title' => $data['title'],
                'description' => $data['description'],
                'tags' => $data['tags'],
            ]);


            foreach ($data['media'] as $media) {
                PostMedia::create([
                    'post_id' => $post->id,
                    'admin_id' => $admin->id,  // add this
                    'type' => $media['type'],
                    'url' => $media['url'],
                ]);
            }
        }
    }
}
