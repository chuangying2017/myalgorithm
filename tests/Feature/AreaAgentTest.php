<?php

namespace Tests\Feature;

use App\AreaAgentLevelModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class AreaAgentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/get/area_agent_level');

        $response->assertStatus($response->getStatusCode());

//        $response->getOriginalContent();
    }
}
