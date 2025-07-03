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

    private function mainQuery()
    {
        return DB::table('fblog_posts as p')
            ->leftJoin('fblog_category_fblog_post as cp', 'cp.post_id', '=', 'p.id')
            ->leftJoin('fblog_categories as c', 'c.id', '=', 'cp.category_id')
            ->leftJoin('fblog_post_fblog_tag as pt', 'pt.post_id', '=', 'p.id')
            ->leftJoin('fblog_tags as t', 't.id', '=', 'pt.tag_id')
            ->select(
                'p.id',
                'p.title',
                'p.slug',
                'p.sub_title',
                'p.cover_photo_path',
                'p.photo_alt_text',
                'p.status',
                'p.published_at',
                DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT
            JSON_OBJECT('id', c.id, 'name', c.name)
        ), ']') AS categories"),
                DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT
            JSON_OBJECT('id', t.id, 'name', t.name)
        ), ']') AS tags")
            );
    }

    public function index()
    {
        try {

            $posts = $this->mainQuery()->where('p.status', '=', 'published')
                ->groupBy('p.id',
                    'p.title',
                    'p.slug',
                    'p.sub_title',
                    'p.cover_photo_path',
                    'p.photo_alt_text',
                    'p.status',
                    'p.published_at'
                )
                ->get()
                ->map(function ($post) {
                    $post->categories = json_decode($post->categories, true) ?? [];
                    $post->tags = json_decode($post->tags, true) ?? [];
                    return $post;
                });

            if ($posts->isEmpty()) {
                return response()->json(['message' => 'No blog posts found'], 404);
            }
            if ($posts) {
                foreach ($posts as $post) {
                    if (isset($post->cover_photo_path) && $post->cover_photo_path !== null) {
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


    public function search($search)
    {
        try {
            $posts = $this->mainQuery()->where('p.status', '=', 'published')
                ->groupBy('p.id',
                    'p.title',
                    'p.slug',
                    'p.sub_title',
                    'p.cover_photo_path',
                    'p.photo_alt_text',
                    'p.status',
                    'p.published_at'
                );
            $posts = $posts->where('p.title','like','%'.$search.'%');
            $posts = $posts->get()
                ->map(function ($post) {
                    $post->categories = json_decode($post->categories, true) ?? [];
                    $post->tags = json_decode($post->tags, true) ?? [];
                    return $post;
                });

            if ($posts->isEmpty()) {
                return response()->json(['message' => 'No blog posts found'], 404);
            }
            if ($posts) {
                foreach ($posts as $post) {
                    if (isset($post->cover_photo_path) && $post->cover_photo_path !== null) {
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

    public function show($slug)
    {
        $post = DB::table('fblog_posts as p')
            ->leftJoin('fblog_category_fblog_post as cp', 'cp.post_id', '=', 'p.id')
            ->leftJoin('fblog_categories as c', 'c.id', '=', 'cp.category_id')
            ->leftJoin('fblog_post_fblog_tag as pt', 'pt.post_id', '=', 'p.id')
            ->leftJoin('fblog_tags as t', 't.id', '=', 'pt.tag_id')
            ->leftJoin('users as u', 'u.id', '=', 'p.user_id')
            ->leftJoin('fblog_seo_details as seo', 'seo.post_id', '=', 'p.id')
            ->select(
                'p.id',
                'p.title',
                'p.slug',
                'p.sub_title',
                'p.body',
                'p.cover_photo_path',
                'p.photo_alt_text',
                'p.status',
                'p.published_at',
                'u.name as user_name',
                'u.id as user_id',
                'seo.title',
                'seo.description',
                'seo.keywords',
                DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT JSON_OBJECT('id', c.id, 'name', c.name)), ']') as categories"),
                DB::raw("CONCAT('[', GROUP_CONCAT(DISTINCT JSON_OBJECT('id', t.id, 'name', t.name)), ']') as tags")
            )
            ->where('p.slug', '=', $slug)
            ->groupBy(
                'p.id',
                'p.title',
                'p.slug',
                'p.sub_title',
                'p.body',
                'p.cover_photo_path',
                'p.photo_alt_text',
                'p.status',
                'p.published_at',
                'u.name',
                'u.id',
                'seo.title',
                'seo.description',
                'seo.keywords'
            )
            ->first();

        if ($post) {
            $post->categories = json_decode($post->categories ?? '[]', true);
            $post->tags = json_decode($post->tags ?? '[]', true);
        }


        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Blog posts fetched successfully',
            'data' => $post,
        ]);
    }

    public function latest()
    {
        $posts = $this->mainQuery()->where('p.status', 'published')->orderBy('p.published_at', 'desc')->groupBy('p.id',
            'p.title',
            'p.slug',
            'p.sub_title',
            'p.cover_photo_path',
            'p.photo_alt_text',
            'p.status',
            'p.published_at'
        )
            ->take(5)->get()
            ->map(function ($post) {
                $post->categories = json_decode($post->categories, true) ?? [];
                $post->tags = json_decode($post->tags, true) ?? [];
                return $post;
            });

        return response()->json([
            'success' => true,
            'message' => 'Latest Blog posts fetched successfully',
            'data' => $posts,
        ]);
    }

    public function categories($slug)
    {
        $posts = $this->mainQuery()
            ->where('p.status', 'published')
            ->orderBy('p.published_at', 'desc')
            ->where('c.slug',$slug)
            ->groupBy('p.id',
            'p.title',
            'p.slug',
            'p.sub_title',
            'p.cover_photo_path',
            'p.photo_alt_text',
            'p.status',
            'p.published_at'
        )
            ->get()
            ->map(function ($post) {
                $post->categories = json_decode($post->categories, true) ?? [];
                $post->tags = json_decode($post->tags, true) ?? [];
                return $post;
            });

        return response()->json([
            'success' => true,
            'message' => 'Categories Blog posts fetched successfully',
            'data' => $posts,
        ]);
    }

    public function tags($slug)
    {
        $posts = $this->mainQuery()
            ->where('p.status', 'published')
            ->orderBy('p.published_at', 'desc')
            ->where('t.slug',$slug)
            ->groupBy('p.id',
            'p.title',
            'p.slug',
            'p.sub_title',
            'p.cover_photo_path',
            'p.photo_alt_text',
            'p.status',
            'p.published_at'
        )
            ->get()
            ->map(function ($post) {
                $post->categories = json_decode($post->categories, true) ?? [];
                $post->tags = json_decode($post->tags, true) ?? [];
                return $post;
            });

        return response()->json([
            'success' => true,
            'message' => 'Tags Blog posts fetched successfully',
            'data' => $posts,
        ]);
    }

}
