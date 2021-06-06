<?php declare(strict_types=1);


use App\Models\Game;
use App\Models\Hero;
use App\Models\StructuralAttribute;
use Nkf\General\Utils\ArrayUtils;
use Tests\ApiTestCase;

class HeroStructuralAttributeTest extends ApiTestCase
{
    public function testUpdateHeroStructuralAttributeValues() : void
    {
        $user = $this->getRandomUser();
        $game = Game::inRandomOrder()->first();

        /** @var Hero $hero */
        $hero = $user->heroes()->where('game_id', $game->id)->inRandomOrder()->first();
        $attribute = StructuralAttribute::query()
            ->where('game_id', $game->id)
            ->inRandomOrder()
            ->first();

        $valueIds = ArrayUtils::toArray($attribute->values()->pluck('id'));
        if ($attribute->multiply)
            $valueIds = ArrayUtils::randomValues($valueIds);
        else
            $valueIds = ArrayUtils::randomValue($valueIds);

        $this->login($user)
            ->put("api/heroes/{$hero->id}/structural_attributes/{$attribute->id}/value", ['value_ids' => $valueIds])
            ->assertSuccessful();

        $hero = $hero->refresh();

        $heroValueIds = ArrayUtils::toArray($hero->structuralAttributeValues->pluck('id'));
        foreach ($valueIds as $id)
            $this->assertTrue(in_array($id, $heroValueIds, true), sprintf('%d in %s', $id, implode(',', $valueIds)));

        $hero = Hero::query()
            ->where('user_id', '!=', $user->id)
            ->first();
        $this->assertResponseError(['hero_id' => ['invalid_value']], $this->put("/api/heroes/{$hero->id}/attributes/{$attribute->id}/value", ['value_ids' => $valueIds]));

        // TODO: add assert for other games
    }
}
