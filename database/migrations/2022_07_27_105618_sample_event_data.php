<?php

use App\Models\events;
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
                'name'=>'Summer Event', 
                'description'=> 'This is the primary event of Summer!'
            ],
            [
                'name'=>'Winter Event', 
                'description'=> 'This is the primary event of Winter!'
            ],
            [
                'name'=>'Autumn Event', 
                'description'=> 'This is the primary event of Autumn!'
            ],
            [
                'name'=>'Spring Event', 
                'description'=> 'This is the primary event of Spring!'
            ]
        ];

        foreach ($sample_data_array as $event_data) {
            $event = new events();
            $event->name = $event_data['name'];
            $event->description = $event_data['description'];
            $event->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        events::truncate();
    }
};
