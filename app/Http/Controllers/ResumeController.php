<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experiance;
use App\Models\Training;
use App\Models\CaseStudy;

class ResumeController extends Controller
{
    public function certificates()
    {
        $data = Certificate::all()->where('status', true);

        foreach ($data as $item) {
            if ($item->certificate_image !== null) {
                $item->certificate_image = asset('storage/' . ltrim($item->certificate_image, '/'));
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Certificate fetched successfully',
            'data' => $data,
        ]);
    }
    public function education()
    {
        $data = Education::all()->where('status', true);


        return response()->json([
            'success' => true,
            'message' => 'Education fetched successfully',
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function experiences()
    {

        $data = Experiance::all()->where('status', true);


        return response()->json([
            'success' => true,
            'message' => 'Experience fetched successfully',
            'data' => $data,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function trainings()
    {
        $data = Training::all()->where('status', true);


        return response()->json([
            'success' => true,
            'message' => 'Training fetched successfully',
            'data' => $data,
        ]);
    }

    public function caseStudies()
    {
        $data = CaseStudy::all()->where('status', true);

        foreach ($data as $item) {
            if ($item->cover_image !== null) {
                $item->cover_image = asset('storage/' . ltrim($item->cover_image, '/'));
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Case studies fetched successfully',
            'data' => $data,
        ]);
    }
}
