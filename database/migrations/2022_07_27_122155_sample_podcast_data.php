<?php

use App\Models\podcasts;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sample_data_array = [
            [
                'name'=>'Podcast 1', 
                'description'=> 'Podcast 1 Description!'
            ],
            [
                'name'=>'Podcast 2', 
                'description'=> 'Podcast 2 Description!'
            ],
            [
                'name'=>'Podcast 3', 
                'description'=> 'Podcast 3 Description!'
            ],
            [
                'name'=>'Podcast 4', 
                'description'=> 'Podcast 4 Description!'
            ],
            [
                'name'=>'Podcast 5', 
                'description'=> 'Podcast 5 Description!'
            ],
            [
                'name'=>'Podcast 6', 
                'description'=> 'Podcast 6 Description!'
            ],
            [
                'name'=>'Podcast 7', 
                'description'=> 'Podcast 7 Description!'
            ],
            [
                'name'=>'Podcast 8', 
                'description'=> 'Podcast 8 Description!'
            ],
            [
                'name'=>'Podcast 9', 
                'description'=> 'Podcast 9 Description!'
            ],
            [
                'name'=>'Podcast 10', 
                'description'=> 'Podcast 10 Description!'
            ]
        ];

        foreach ($sample_data_array as $podcast_data) {
            $podcast = new podcasts();
            $podcast->name = $podcast_data['name'];
            $podcast->description = $podcast_data['description'];
            $podcast->type = 'episode.downloaded';
            $podcast->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        podcasts::truncate();
    }
};
