<?php declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Game;
use App\Models\Hero;
use Tests\ApiTestCase;

class HeroesTest extends ApiTestCase
{
    public function testGetHeroes(): void
    {
        $user = $this->getRandomUser();
        /** @var Game $game */
        $game = $user->heroes()->first()->game;

        $this->assertNotEquals(200, $this->get("/api/games/{$game->id}/heroes")->getStatusCode());
        $this->login($user);

        $response = $this->get("/api/games/{$game->id}/heroes")
            ->assertSuccessful()
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                ],
            ])
            ->json();

        foreach ($response as $hero)
            $this->assertNotNull(Hero::whereUserId($user->id)->find($hero['id']));
    }

    public function testDetailHero() : void
    {
        $user = $this->getRandomUser();
        $hero = Hero::whereUserId($user->id)->inRandomOrder()->first();

        $this->assertNotEquals(200, $this->get('/api/heroes/' . $hero->id)->getStatusCode());

        $this->login($user);
        $this->get('/api/heroes/' . $hero->id)->assertSuccessful();

        $hero = Hero::where('user_id', '!=', $user->id)->inRandomOrder()->first();
        $this->assertResponseError(['hero' => ['not_found']], $this->get('/api/heroes/' . $hero->id));
    }
}
