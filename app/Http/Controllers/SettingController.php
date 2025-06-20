<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Social;
use App\Models\Module;
use App\Models\ModuleText;

class SettingController extends Controller
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
            $settings = Setting::first();
            if ($settings) {
                $settings->logo = $this->transformSettings($settings->logo);
                $settings->favicon = $this->transformSettings($settings->favicon);
                $settings->preloader = $this->transformSettings($settings->preloader);
                $settings->resume = $this->transformSettings($settings->resume);
            }

            return response()->json([
                'success' => true,
                'message' => 'Settings fetched successfully',
                'data' => $settings,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching settings.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function socials () {
        try {
            $socials = Social::where('status', true)->get();
            return response()->json([
                'success' => true,
                'message' => 'Socials fetched successfully',
                'data' => $socials,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching socials.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function modules() {
        try {
            $modules = ModuleText::first();
            return response()->json([
                'success' => true,
                'message' => 'Modules fetched successfully',
                'data' => $modules,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching modules.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function moduleTexts() {
        try {
            $moduleTexts = ModuleText::first();
            return response()->json([
                'success' => true,
                'message' => 'Module texts fetched successfully',
                'data' => $moduleTexts,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching module texts.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
