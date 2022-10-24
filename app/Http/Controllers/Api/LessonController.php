<?php

namespace App\Http\Controllers\Api;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Http\Repository\LessonRepository;
use Illuminate\Support\Facades\Validator;

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
        $lesson = $this->lesson->allLesson();
        // return LessonResource::collection($data);
        return response()->json([
            'success' => true,
            'message' => 'lesson List',
            'data'    => $lesson
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:lessons|max:255',
            'post_id' => 'nullable',
            'description' => 'nullable',
            'video_url' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response([
                'errorMsg' => ($validator->errors()),
                'msg' => '',
                'data' => ""
            ], 400);
        }

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
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'post_id' => 'nullable',
            'description' => 'nullable',
            'video_url' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response([
                'errorMsg' => ($validator->errors()),
                'msg' => '',
                'data' => ""
            ], 400);
        }

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
        ]);
    }
}
