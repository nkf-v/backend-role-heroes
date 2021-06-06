<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\HeroUpdateStructuralAttributeValuesRequest;
use App\Models\StructuralAttribute;
use App\Providers\HeroProvider;
use App\Providers\UserProvider;
use DB;
use Exception;
use Illuminate\Http\JsonResponse;
use Nkf\General\Utils\ArrayUtils;
use Nkf\Laravel\Classes\Exceptions\ServerError;

class HeroStructuralAttributeApiController extends ApiController
{
    protected HeroProvider $heroProvider;

    public function __construct(UserProvider $userProvider, HeroProvider $heroProvider)
    {
        parent::__construct($userProvider);

        $this->heroProvider = $heroProvider;
    }

    public function updateValue(HeroUpdateStructuralAttributeValuesRequest $request, int $heroId, int $attributeId) : JsonResponse
    {
        $hero = $this->heroProvider->getOptionalHeroById($heroId);
        if ($hero === null)
            throw new ServerError(['hero_id']);

        $attribute = StructuralAttribute::query()
            ->where('game_id', $hero->game_id)
            ->find($attributeId);
        if ($attribute === null)
            throw new ServerError(['attribute_id' => ['invalid_value']]);

        $valueIds = $request->validated()['value_ids'];
        $mapAttributeValues = ArrayUtils::toArray($attribute->values()->pluck('id', 'id'));
        foreach ($valueIds as $id)
            if (!array_key_exists($id, $mapAttributeValues))
                throw new ServerError(["attribute.$id" => ['invalid_value']]);

        try
        {
            DB::beginTransaction();
            $hero->structuralAttributeValues()->detach($attribute->values()->pluck('id'));
            $hero->structuralAttributeValues()->sync($attribute->multiply ? $valueIds : ArrayUtils::first($valueIds), false);
            DB::commit();
        }
        catch (Exception $e)
        {
            DB::rollBack();
            throw new ServerError(['attribute_value' => ['no_update']]);
        }

        return $this->respondContent(['message' => ['updated_attribute_value']]);
    }
}
