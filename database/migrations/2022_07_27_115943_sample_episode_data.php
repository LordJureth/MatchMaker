<?php

use App\Models\episodes;
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
                'name'=>'Episode 1', 
                'description'=> 'Episode 1 Description!'
            ],
            [
                'name'=>'Episode 2', 
                'description'=> 'Episode 2 Description!'
            ],
            [
                'name'=>'Episode 3', 
                'description'=> 'Episode 3 Description!'
            ],
            [
                'name'=>'Episode 4', 
                'description'=> 'Episode 4 Description!'
            ],
            [
                'name'=>'Episode 5', 
                'description'=> 'Episode 5 Description!'
            ],
            [
                'name'=>'Episode 6', 
                'description'=> 'Episode 6 Description!'
            ],
            [
                'name'=>'Episode 7', 
                'description'=> 'Episode 7 Description!'
            ],
            [
                'name'=>'Episode 8', 
                'description'=> 'Episode 8 Description!'
            ],
            [
                'name'=>'Episode 9', 
                'description'=> 'Episode 9 Description!'
            ],
            [
                'name'=>'Episode 10', 
                'description'=> 'Episode 10 Description!'
            ]
        ];

        foreach ($sample_data_array as $episode_data) {
            $episode = new episodes();
            $episode->name = $episode_data['name'];
            $episode->description = $episode_data['description'];
            $episode->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        episodes::truncate();
    }
};
