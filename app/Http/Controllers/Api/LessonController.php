<?php

namespace App\Http\Controllers\Api;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Http\Repository\LessonRepository;

class LessonController extends Controller
{

    private LessonRepository $lesson;

    public function __construct()
    {
        $lesson  = new LessonRepository();
        $this->lesson = $lesson;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->lesson->allLesson();
        return LessonResource::collection($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lesson = $this->lesson->createLesson($request->all());
        return new LessonResource($lesson);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson =  $this->lesson->findOrFail($id);
        return new LessonResource($lesson);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lesson = $request->all();
        $this->lesson->update($id, $lesson);

        return response()->json([
            'status' => true,
            'message' => "Lesson Updated Successfully",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson =  $this->lesson->findOrFail($id);
        $lesson->delete();

        return response()->json([
            'status' => true,
            'message' => "Lesson Deleted Successfully",
            'data' => $lesson
        ]);
    }
}
