<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Resources\CourseResource;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct(private CourseService $courseService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = $this->courseService->all();
        return CourseResource::collection($course);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $course = $this->courseService->store(['id' => $request?->course],$request->validated());
        if ($request->hasFile('image'))
        {
            $course->addMediaFromRequest('image')->toMediaCollection('course');
        }
        return response()->json(['data' => '' ,'message' => "Done"],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = $this->courseService->show($id);
        return CourseResource::make($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCourseRequest $request, string $id)
    {
        $course = $this->courseService->store(['id' => $request?->course],$request->validated());
        if ($request->hasFile('image'))
        {
            $course->addMediaFromRequest('image')->toMediaCollection('course');
        }
        return response()->json(['data' => '' ,'message' => "Done"],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->courseService->destroy($id);
        return response()->json(['data' => '' ,'message' => "Done"],200);
    }
}
