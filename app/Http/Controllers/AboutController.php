<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;
use App\Models\Skill;
use App\Models\Counter;

class AboutController extends Controller
{
    public function hero() {
        try {
            $hero = Hero::first();
            if ($hero->image !== null && $hero->image !== '') {
                $hero->image = asset('storage/' . ltrim($hero->image, '/'));
            }
            return response()->json([
                'success' => true,
                'message' => 'Hero section fetched successfully',
                'data' => $hero,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching hero section.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function skills() {
        try {
            $skills = Skill::where('status', true)->get();
            foreach ($skills as $skill) {
                if ($skill->image !== null && $skill->image !== '') {
                    $skill->image = asset('storage/' . ltrim($skill->image, '/'));
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'Skills fetched successfully',
                'data' => $skills,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching skills.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function counters() {
        try {
            $counters = Counter::where('status', true)->get();
            return response()->json([
                'success' => true,
                'message' => 'Counters fetched successfully',
                'data' => $counters,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching counters.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
