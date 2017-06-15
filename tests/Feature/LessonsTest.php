<?php

namespace Tests\Feature;

use App\Lesson;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LessonsTest extends ApiTester
{
    use DatabaseTransactions;
    use Factory;
    use WithoutMiddleware;

    /** @test **/
    public function it_fetches_lessons()
    {
        // arrange
        $this->times(5)->make('App\Lesson',['some_bool' => true]);

        // act
        $response = $this->getJson('api/v1/lessons');

        // assert
        $response->assertStatus(200);
    }

    /** @test **/
    public function it_fetches_a_single_lesson()
    {
        // arrange
        $this->make(Lesson::class, [
            'title' => 'pets',
            'body' => 'Millie, Kitcha, Jo Jo, Bill',
            'some_bool' => true
        ]);

        // act 
        $response = $this->getJson('/api/v1/lessons/1');

        // assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'body',
                    'title',
                    'active'
                ]
            ]);
    }  

    /** @test **/
    public function it_404s_if_a_lesson_is_not_found()
    {
        $response = $this->getJson('/api/v1/lessons/cutepuppy');
        // dd($response);
        
        $response->assertStatus(404)
            ->assertJsonStructure(['error']);

    }  

    protected function getStub()
    {  
        return [
                'title' => $this->fake->sentence,
                'body' => $this->fake->paragraph,
                'some_bool' => false //$this->fake->boolean
        ];
    }
}
