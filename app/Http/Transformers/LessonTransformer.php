<?php 

namespace App\Http\Transformers;


class LessonTransformer extends Transformer {

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
      'active' => (boolean) $lesson['some_bool']
    ];
  }
}