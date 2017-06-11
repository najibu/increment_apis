<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;
use App\Http\Transformers\LessonTransformer;

class LessonsController extends ApiController
{   
    /**
     * [$lessonTransformer description]
     * @var [App\Http\Transformers]
     */
    protected $lessonTransformer;

    public function __construct(LessonTransformer $lessonTransformer)
    {
    
        $this->lessonTransformer = $lessonTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        Why it is bad practice Lesson::all();
        1. All is bad
        2. No way to attach meta data
        3. Linking db structure to the API output
        4. No way to signal headers/response codes
         */
        $lessons = Lesson::all(); 
        return $this->respond([
            'data' => $this->lessonTransformer->transformCollection($lessons->all())
        ]);; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);

        if (! $lesson) {
            return $this->responseNotFound('Lesson does not exist.');
        }

        return $this->respond([
            'data' => $this->lessonTransformer->transform($lesson->toArray())
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
