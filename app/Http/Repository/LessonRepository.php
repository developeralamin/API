<?php

namespace App\Http\Repository;

use App\Models\Lesson;

class LessonRepository
{

    /**
     * get All Lesson
     */
    public function allLesson()
    {
        return Lesson::with('post')->paginate(5);
    }

    /**
     * Create a Lesson
     */
    public function createLesson($data)
    {
        return Lesson::create($data);
    }

    /**
     * show single Lesson
     */
    public function findOrFail($id)
    {
        return Lesson::findOrFail($id);
    }

    /**
     * Update a single Lesson
     */
    public function update($id, $data)
    {
        $post =  $this->findOrFail($id);
        return $post->update($data);
    }
}
