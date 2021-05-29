<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\HeroCharacteristicUpdateRequest;
use App\Models\Characteristic;
use App\Models\Hero;
use App\Providers\HeroProvider;
use App\Providers\UserProvider;
use DB;
use Exception;
use Illuminate\Http\JsonResponse;
use Nkf\Laravel\Classes\Exceptions\ServerError;

class HeroCharacteristicApiController extends ApiController
{
    protected HeroProvider $heroProvider;

    public function __construct(UserProvider $userProvider, HeroProvider $heroProvider)
    {
        parent::__construct($userProvider);

        $this->heroProvider = $heroProvider;
    }

    public function updateValue(int $heroId, int $characteristicId, HeroCharacteristicUpdateRequest $request) : JsonResponse
    {
        $hero = $this->heroProvider->getOptionalHeroById($heroId);
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
