<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreDownloadedPodcastsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response =  $this->call(
            'POST',
            '/api/v1/store-downloaded-podcast',
            [],
            [],
            [],
            $headers = [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json'
            ],
            $json = json_encode([
                'type' => 'episode.downloaded',
                'event_id' => '3b10a884-6ad2-4c78-a3e8-4912df02ff2f',
                'occurred_at' => '2022-07-27 22:47:46',
                'data' => [
                    'episode_id' => '<script>fedd1dd6-2abb-4219-a412-68096005ce6b</script>',
                    'podcast_id' => '3112d561-800d-4955-9fb8-43ae678c9e9a'
                ]
            ])
        );

        $response->assertStatus(200);
    }
}
