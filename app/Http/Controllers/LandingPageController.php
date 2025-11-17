<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimoni;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil data testimoni dari database, kecuali yang di-hidden
        $hiddenTestimonials = session('hidden_testimonials', []);
        $testimonials = Testimoni::whereNotIn('id', $hiddenTestimonials)->get();

        return view('landingpage', compact('testimonials'));
    }
}
