<?php declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\AttributeTypeEnum;
use App\Models\Attribute;
use App\Models\Game;
use App\Models\Hero;
use Tests\ApiTestCase;

class HeroAttributeTest extends ApiTestCase
{
    public function testUpdateHeroAttributeValue() : void
    {
        $user = $this->getRandomUser();
        $game = Game::inRandomOrder()->first();
        /** @var Hero $hero */
        $hero = $user->heroes()->where('game_id', $game->id)->inRandomOrder()->first();
        $attribute = Attribute::query()
            ->whereGameId($game->id)
            ->inRandomOrder()
            ->first();

        $value = null;
        switch ($attribute->type_value)
        {
            case AttributeTypeEnum::INT: $value = random_int(0, 100); break;
            case AttributeTypeEnum::DOUBLE: $value = 10.12; break;
            case AttributeTypeEnum::BOOL: $value = (boolean)random_int(0, 1); break;
            default: $value = 'test values';
        }

        $this->login($user)
            ->put("/api/heroes/{$hero->id}/attributes/{$attribute->id}/value", ['value' => $value])
            ->assertSuccessful();

        $hero = Hero::query()
            ->where('user_id', '!=', $user->id)
            ->first();
        $this->assertResponseError(['hero_id' => ['invalid_value']], $this->put("/api/heroes/{$hero->id}/attributes/{$attribute->id}/value", ['value' => $value]));

        // TODO: add assert for other games
    }
}
