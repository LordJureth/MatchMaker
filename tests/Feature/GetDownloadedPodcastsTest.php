<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetDownloadedPodcastsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response =  $this->call(
            'GET',
            '/api/v1/recent-downloaded-podcasts',
            [
                'days_back' => 7,
                'type' =>'episode.downloaded'
            ],
            [],
            [],
            $headers = [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json'
            ]
        );

        $response->assertStatus(200);


    
    }
}
