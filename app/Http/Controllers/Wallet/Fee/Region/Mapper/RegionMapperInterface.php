<?php


namespace App\Http\Controllers\Wallet\Fee\Region\Mapper;


use Illuminate\Http\Request;
use Wallet\Wallet\Fee\Region\Entity\RegionEntityInterface;

interface RegionMapperInterface
{
    /**
     * @param Request $request
     * @return RegionEntityInterface
     */
    public static function createRegionFromHttpRequest(
        Request $request
    ): RegionEntityInterface;
}
