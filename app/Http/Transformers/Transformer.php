<?php 

namespace App\Http\Transformers;

abstract class Tranformer {

  /**
   * [transform a collection of lessons]
   * @param  [type] $lessons [description]
   * @return [type]          [description]
   */
  public function transformCollection(array $items)
  {
    return array_map([$this, 'transform'], $items);
  }

  public abstract function transform($item);
}