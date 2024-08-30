<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index(){
        $testimonials= Testimonial::all()->where('status', 2);
        return response()-> json($testimonials);
    }
}
