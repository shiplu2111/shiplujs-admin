<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;
class ProjectController extends Controller
{

    private function transformProjects($projects)
        {
            return $projects->map(function ($project) {
                $category = Category::find($project->category_id);
                $project->category_name = $category?->title;

                foreach (['image', 'project_image_1', 'project_image_2', 'project_image_3'] as $imageField) {
                    if (!empty($project->$imageField)) {
                        $project->$imageField = asset('storage/' . ltrim($project->$imageField, '/'));
                    }
                }
                if (is_string($project->tags)) {
                    $project->tags = json_decode($project->tags, true);
                }

                return $project;
            });
        }
    public function categories()
    {
        // এখানে ক্যাটাগরি সম্পর্কিত লজিক যোগ করুন
        // যেমন, ডাটাবেজ থেকে ক্যাটাগরি নিয়ে আসা
        try {
            $data = Category::all()->where('status', true);
            $data = $this->transformProjects($data);
            return response()->json([
                'success' => true,
                'message' => 'Project Category fetched successfully',
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching project categories.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
     public function index()
    {
        $projects = Project::all()->where('status', true);

        // Map over projects to attach category names
        $projects = $this->transformProjects($projects);

        return response()->json([
            'success' => true,
            'message' => 'Projects fetched successfully',
            'data' => $projects,
        ]);
    }

    public function projectDetails($slug)
    {
        $project = Project::with('seoMetadata')->where('slug', $slug)->first();
        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found',
            ], 404);
        }

        // Attach category name
        $category = Category::where('id', $project->category_id)->first();
        $project->category_name = $category ? $category->title : null;

        if($project->image !==null){
            $project->image = asset('storage/' . ltrim($project->image, '/'));
        }

        if($project->project_image_1!==null){
            $project->project_image_1 = asset('storage/' . ltrim($project->project_image_1, '/'));
        }
        if($project->project_image_2!==null){
            $project->project_image_2 = asset('storage/' . ltrim($project->project_image_2, '/'));
        }
        if($project->project_image_3!==null){
            $project->project_image_3 = asset('storage/' . ltrim($project->project_image_3, '/'));
        }

        if (is_string($project->tags)) {
            $project->tags = json_decode($project->tags, true);
        }

        return response()->json([
            'success' => true,
            'message' => 'Project details fetched successfully',
            'data' => $project,
        ]);
    }
    public function testimonials()
    {
        $testimonials = Testimonial::all()->where('status', true);

        // Map over testimonials to attach project names
        $testimonials = $testimonials->map(function ($testimonial) {
            $project = Project::where('id', $testimonial->project_id)->first();
            $testimonial->project_name = $project ? $project->title : null;
            return $testimonial;
        });

        return response()->json([
            'success' => true,
            'message' => 'Testimonials fetched successfully',
            'data' => $testimonials,
        ]);
    }
    public function projectByCategory($categoryId)
    {
        $projects = Project::where('category_id', $categoryId)->where('status', true)->limit(3)->get();
        if ($projects->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No projects found for this category',
            ], 404);
        }
        $projects = $this->transformProjects($projects);
        return response()->json([
            'success' => true,
            'message' => 'Projects fetched successfully',
            'data' => $projects,
        ]);
    }
    public function projectByTag($tag)
    {
        $projects = Project::whereJsonContains('tags', $tag)->where('status', true)->get();
        if ($projects->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No projects found for this tag',
            ], 404);
        }
        $projects = $this->transformProjects($projects);
        return response()->json([
            'success' => true,
            'message' => 'Projects fetched successfully',
            'data' => $projects,
        ]);
    }
    public function projectByClient($client)
    {
        $projects = Project::where('client', $client)->where('status', true)->get();
        if ($projects->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No projects found for this client',
            ], 404);
        }
        $projects = $this->transformProjects($projects);
        return response()->json([
            'success' => true,
            'message' => 'Projects fetched successfully',
            'data' => $projects,
        ]);
    }

    public function projectByLocation($location)
    {
        $projects = Project::where('location', $location)->where('status', true)->get();
        if ($projects->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No projects found for this location',
            ], 404);
        }
        $projects = $this->transformProjects($projects);
        return response()->json([
            'success' => true,
            'message' => 'Projects fetched successfully',
            'data' => $projects,
        ]);
    }
    public function testimonialByProject($projectId)
    {
        $testimonials = Testimonial::where('project_id', $projectId)->where('status', true)->get();
        if ($testimonials->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No testimonials found for this project',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Testimonials fetched successfully',
            'data' => $testimonials,
        ]);
    }
}
