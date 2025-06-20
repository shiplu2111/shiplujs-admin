<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Package;
use App\Models\Client;
use App\Models\Faq;
class ServiceController extends Controller
{

    private function transformService($service)
        {
            // Convert related_service JSON string to array if needed
            if (is_string($service->related_service)) {
                $service->related_service = json_decode($service->related_service, true);
            }

            // Convert image path to full asset URL
            if (!empty($service->image)) {
                $service->image = asset('storage/' . ltrim($service->image, '/'));
            }

            return $service;
        }
    public function index()
    {
        $data = Service::all()->where('status', true);
        $data = $data->map(function ($item) {
            return $this->transformService($item);
        });
        return response()->json([
            'success' => true,
            'message' => 'Services fetched successfully',
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function pricingPlans()
    {
        $data = Package::where('status', true)->limit(3)->get();

        return response()->json([
            'success' => true,
            'message' => 'Pricing plans fetched successfully',
            'data' => $data,
        ]);
    }


    public function clients()
    {
        $data = Client::all()->where('status', true);

        foreach ($data as $item) {
            if ($item->image !== null) {
                $item->image = asset('storage/' . ltrim($item->image, '/'));
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Clients fetched successfully',
            'data' => $data,
        ]);
    }
    public function faqs()
    {
        $data = Faq::where('status', true)->get();

        return response()->json([
            'success' => true,
            'message' => 'FAQs fetched successfully',
            'data' => $data,
        ]);
    }
}
