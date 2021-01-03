<?php declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Characteristic;
use App\Models\Game;
use App\Models\Hero;
use Tests\ApiTestCase;

class HeroCharacteristicTest extends ApiTestCase
{
    public function testUpdateHeroCharacteristicValue() : void
    {
        $user = $this->getRandomUser();
        $game = Game::inRandomOrder()->first();
        /** @var Hero $hero */
        $hero = $user->heroes()->where('game_id', $game->id)->inRandomOrder()->first();
        $characteristic = Characteristic::query()
            ->whereGameId($game->id)
            ->inRandomOrder()
            ->first();
        $value = random_int(0, 100);
        $this->login($user)
            ->put("/api/heroes/{$hero->id}/characteristics/{$characteristic->id}/value", ['value' => $value])
            ->assertSuccessful();

        $hero = Hero::query()
            ->where('user_id', '!=', $user->id)
            ->first();
        $this->assertResponseError(['hero_id' => ['invalid_value']], $this->put("/api/heroes/{$hero->id}/characteristics/{$characteristic->id}/value", ['value' => $value]));

        // TODO: add assert for other characteristics
    }
}
