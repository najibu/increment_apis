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

        $this->middleware('auth.basic', ['only' => 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*
        Why it is bad practice Lesson::all();
        1. All is bad
        2. No way to attach meta data
        3. Linking db structure to the API output
        4. No way to signal headers/response codes
         */
        $limit = $request->input('limit') ?: 3;

        $lessons = Lesson::paginate($limit); 
        //dd(get_class_methods($lessons));

        return $this->respondWithPagination($lessons, [
            $this->lessonTransformer->transformCollection($lessons->all())
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
        if (! $request->title or ! $request->body or ! is_bool($request->active))
        {
            return $this->respondInvalidRequest();   
        }

        Lesson::create($request->all());

        return $this->respondCreated();
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
}
