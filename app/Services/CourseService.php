<?php


namespace App\Services;

use App\Models\Course;
use App\Models\User;

class CourseService
{
    public function all()
    {
        $course = Course::with(['media'])->get();
        return $course;
    }

    public function store($id,array $data)
    {
        $course = Course::updateOrCreate(['id' =>$id],[
            'name' => $data['name'],
            'package_id' => $data['package_id'],
        ]);
        return $course;
    }

    public function show(string $id)
    {
        $course = Course::with('media')->FindOrFail($id);
        return $course;
    }

    public function destroy($id)
    {
        Course::whereId($id)->delete();
    }
}
