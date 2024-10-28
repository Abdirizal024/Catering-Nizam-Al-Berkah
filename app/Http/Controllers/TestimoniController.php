<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function create()
    {
        return view('testimoni');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|integer|between:1,5',
            'testimonial' => 'required|string',
        ]);

        $testimoni = new Testimoni();
        $testimoni->name = $request->name;
        $testimoni->position = $request->position;

        // Proses upload image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $testimoni->image = $imagePath;
        }

        $testimoni->rating = $request->rating;
        $testimoni->testimonial = $request->testimonial;
        $testimoni->save();

        return redirect()->back()->with('success', 'Testimoni berhasil dikirim!');
    }
}
