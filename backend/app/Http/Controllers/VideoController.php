<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $videos = Video::with('course')->get();
        if (!$request->has('admin')) {
            $videos->transform(function ($video) {
                if ($video->is_locked) {
                    $video->youtube_url = null;
                }
                return $video;
            });
        }
        return response()->json($videos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'youtube_url' => 'required|url',
            'notes_url' => 'nullable|url',
            'quiz_url' => 'nullable|url',
            'available_from' => 'nullable|date',
            'available_until' => 'nullable|date',
            'is_locked' => 'nullable|boolean',
        ]);
        
        $video = Video::create($validated);
        return response()->json($video, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        return response()->json($video->load('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'course_id' => 'exists:courses,id',
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'youtube_url' => 'url',
            'notes_url' => 'nullable|url',
            'quiz_url' => 'nullable|url',
            'available_from' => 'nullable|date',
            'available_until' => 'nullable|date',
            'is_locked' => 'nullable|boolean',
        ]);

        $video->update($validated);
        return response()->json($video);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return response()->json(null, 204);
    }
}
