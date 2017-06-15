<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Lesson;
use Illuminate\Http\Request;
use App\Http\Transformers\TagTransformer;

class TagsController extends ApiController
{
    protected $tagTransformer;

    public function __construct(TagTransformer $tagTransformer)
    {
        $this->tagTransformer = $tagTransformer;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lessonId = null)
    {   
        $tags = $this->getTags($lessonId); // All is bad

        return $this->respond([
            'data' => $this->tagTransformer->transformCollection($tags->all())
        ]);
    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    private function getTags($lessonId)
    {
        $tags = $lessonId ? Lesson::findOrFail($lessonId)->tags : Tag::all();

        return $tags;
    }
}
