<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\HeroCharacteristicUpdateRequest;
use App\Models\Characteristic;
use App\Models\Hero;
use App\Providers\UserProvider;
use DB;
use Exception;
use Illuminate\Http\JsonResponse;
use Nkf\Laravel\Classes\Exceptions\ServerError;
use Nkf\Laravel\Traits\ApiController;

class HeroCharacteristicApiController
{
    use ApiController;

    protected $userProvider;

    public function __construct(UserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    public function updateCharacteristicValue(int $heroId, int $characteristicId, HeroCharacteristicUpdateRequest $request) : JsonResponse
    {
        $user = $this->userProvider->getUser();
        /** @var Hero $hero */
        $hero = $user->heroes()->find($heroId);
        if ($hero === null)
            throw new ServerError(['hero_id' => ['invalid_value']]);

        if (Characteristic::query()->whereGameId($hero->game_id)->find($characteristicId) === null)
            throw new ServerError(['characteristic_id' => ['invalid_value']]);

        $value = $request->validated()['value'];

        try
        {
            DB::beginTransaction();
            $hero->characteristicValues()->updateExistingPivot($characteristicId, ['value' => $value]);
            DB::commit();
        }
        catch (Exception $e)
        {
            DB::rollBack();
            throw new ServerError(['characteristic' => ['no_update']]);
        }

        return $this->respondContent(['message' => 'Characteristic update']);
    }
}
