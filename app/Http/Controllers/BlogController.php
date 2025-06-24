<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BlogController extends Controller
{
      private function transformSettings($image)
    {
        if (!empty($image)) {
            return asset('storage/' . ltrim($image, '/'));
        }
        return null;
    }

    public function index()
    {
        try {
            $posts = DB::table('fblog_posts')->get();
            if ($posts->isEmpty()) {
                return response()->json(['message' => 'No blog posts found'], 404);
            }
            if ($posts) {
                foreach ($posts as $post) {
                    if(isset($post->cover_photo_path) && $post->cover_photo_path !== null) {
                        $post->cover_photo_path = $this->transformSettings($post->cover_photo_path);
                    }
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'Blog posts fetched successfully',
                'data' => $posts,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching posts', 'error' => $e->getMessage()], 500);
        }
    }


    public function show($id)
    {
        $post = DB::table('fblog_posts')->find($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        return response()->json($post);
    }

    public function latestPosts()
    {
        $posts = DB::table('fblog_posts')->orderBy('created_at', 'desc')->take(5)->get();
        return response()->json($posts);
    }
}
