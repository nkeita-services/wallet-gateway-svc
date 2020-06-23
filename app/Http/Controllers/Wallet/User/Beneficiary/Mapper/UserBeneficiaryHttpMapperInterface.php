<?php


namespace App\Http\Controllers\Wallet\User\Beneficiary\Mapper;


use Illuminate\Http\Request;
use Wallet\Wallet\User\Beneficiary\Entity\BeneficiaryEntityInterface;

interface UserBeneficiaryHttpMapperInterface
{
    /**
     * @param Request $request
     * @return BeneficiaryEntityInterface
     */
    public static function createUserBeneficiaryFromHttpRequest(Request $request):BeneficiaryEntityInterface;
}
