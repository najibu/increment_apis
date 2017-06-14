<?php

use App\Tag;
use App\Lesson;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $tables = [
        'lessons',
        'tags'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->cleanDatabase();

        factory(Lesson::class, 30)->create();
        $this->call(TagsTableSeeder::class); 
        
    }

    public function cleanDatabase()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::disableForeignKeyConstraints();

        foreach ($this->tables as $tableName) {
            DB::table($tableName)->truncate();
        }

        Schema::enableForeignKeyConstraints();

        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
