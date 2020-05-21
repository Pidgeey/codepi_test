<?php

namespace App\Http\Controllers;

use App\Models\Characteristic;
use App\Http\Resources\Characteristics\CharacteristicCollection as CharacteristicsResourceCollection;

/**
 * Class CharacteristicController
 * @package App\Http\Controllers
 */
class CharacteristicController extends Controller
{
    /**
     * Get characteristics list
     *
     * @return CharacteristicsResourceCollection
     */
    public function get(): CharacteristicsResourceCollection
    {
        $characteristics = Characteristic::all();
        return new CharacteristicsResourceCollection($characteristics);
    }
}
