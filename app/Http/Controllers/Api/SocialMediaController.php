<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMedia;

class SocialMediaController extends Controller
{
    public function index(){
        $socialMedia= SocialMedia::all();
        return response()-> json($socialMedia);
    }
}
