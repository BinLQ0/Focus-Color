<?php

namespace Tests\Feature;

use Tests\TestCase;

class HistoryFeatureTest extends TestCase
{
    /** @test */
    public function test_check_api_history_structure()
    {
        $response = $this->get('/api/product/1/history');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                     'type',
                     'date',
                     'document_reference',
                     'description',
                     'location',
                     'in',
                     'out'
                ]
            ]
        ]);
    }
}
