<?php declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Game;
use App\Models\Hero;
use Tests\ApiTestCase;

class HeroesTest extends ApiTestCase
{
    public function testCreateHero() : void
    {
        $user = $this->getRandomUser();
        $game = Game::inRandomOrder()->first();
        $this->login($user);
        $this->assertResponseError(['game_id' => ['invalid_value']], $this->post('/api/heroes/create', [
            'game_id' => Game::max('id') + 1,
            'name' => 'test',
        ]));

        $countUserHeroes = $user->heroes()->where('game_id', $game->id)->count();
        $this->post('/api/heroes/create', [
            'game_id' => $game->id,
            'name' => 'test',
        ])->assertSuccessful();
        $this->assertEquals($countUserHeroes + 1, $user->heroes()->where('game_id', $game->id)->count());
    }

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

    public function testDeleteHero() : void
    {
        $user = $this->getRandomUser();
        /** @var Hero $hero */
        $hero = $user->heroes()->inRandomOrder()->first();
        $this->login($user)->delete("/api/heroes/{$hero->id}")->assertSuccessful();
        $this->assertResponseError(['hero_id' => ['invalid_value']], $this->delete("/api/heroes/{$hero->id}"));

        $hero = Hero::query()
            ->where('user_id', '!=', $user->id)
            ->inRandomOrder()
            ->first();
        $this->assertResponseError(['hero_id' => ['invalid_value']], $this->delete("/api/heroes/{$hero->id}"));
    }
}
