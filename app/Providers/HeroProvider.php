<?php declare(strict_types=1);

namespace App\Providers;

use App\Models\Hero;

final class HeroProvider
{
    private UserProvider $userProvider;

    public function __construct(UserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    public function getHero(int $heroId) : Hero
    {
        /** @var Hero $hero */
        $hero = $this->userProvider->getUser()->heroes()->find($heroId);
        return $hero;
    }

    public function getOptionalHeroById(int $heroId) : ?Hero
    {
        $user = $this->userProvider->getOptionalUser();

        /** @var Hero|null $hero */
        $hero = null;
        if ($user !== null)
            $hero = $user->heroes()->find($heroId);

        return $hero;
    }
}
