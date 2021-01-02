<?php declare(strict_types=1);

namespace Tests\Feature;

use Tests\ApiTestCase;

class GamesTest extends ApiTestCase
{
    public function testGetGames(): void
    {
        $this->assertNotEquals(200, $this->get('/api/games')->getStatusCode());

        $this->login()->get('/api/games')
            ->assertSuccessful()
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                ]
            ]);
    }
}
