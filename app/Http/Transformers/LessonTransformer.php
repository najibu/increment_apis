<?php 

namespace App\Http\Transformers;


class LessonTransformer extends Tranformer {

  /**
     * Transform a lesson
     * @param $lesson 
     * @return array         
     */
  public function transform($lesson)
  {
    return[
      'title' => $lesson['title'],
      'body' => $lesson['body'],
      'active' => $lesson['some_bool']
    ];
  }
}