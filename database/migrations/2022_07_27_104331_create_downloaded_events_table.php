<?php

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
        Schema::create('downloaded_events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->uuid('event_id');
            $table->datetime('occurred_at');
            $table->uuid('episode_id');
            $table->uuid('podcast_id');
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('episode_id')->references('id')->on('episodes')->onDelete('cascade');
            $table->foreign('podcast_id')->references('id')->on('podcasts')->onDelete('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('downloaded_events', function (Blueprint $table) {
            $table->dropForeign('downloaded_events_event_id_foreign');
            $table->dropForeign('downloaded_events_episode_id_foreign');
            $table->dropForeign('downloaded_events_podcast_id_foreign');
        });

        Schema::dropIfExists('downloaded_events');
    }
};
