<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $cacheKey = 'agritech_latest_posts';
        $endpoint = 'https://agritech.ie/wp-json/wp/v2/posts?per_page=5';

        $posts = Cache::remember($cacheKey, now()->addHours(1), function () use ($endpoint) {
            try {
                $response = Http::timeout(5)->get($endpoint);

                if (!$response->ok()) {
                    return 'Error: Failed to fetch posts.';
                }

                return collect($response->json())->map(function ($post) {
                    return (object) [
                        'title' => $post['title']['rendered'] ?? '',
                        'url'   => $post['link'] ?? '',
                    ];
                })->toArray();
            } catch (\Exception $e) {
                return 'Error: Could not retrieve Agritech posts.';
            }
        });

        return view(
            'index',
            [
                'posts' => $posts
            ]
        );
    }
}
