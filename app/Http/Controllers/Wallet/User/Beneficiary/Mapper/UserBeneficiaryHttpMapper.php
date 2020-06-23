<?php


namespace App\Http\Controllers\Wallet\User\Beneficiary\Mapper;


use Illuminate\Http\Request;
use Wallet\Wallet\User\Beneficiary\Entity\BeneficiaryEntity;
use Wallet\Wallet\User\Beneficiary\Entity\BeneficiaryEntityInterface;

class UserBeneficiaryHttpMapper implements UserBeneficiaryHttpMapperInterface
{

    /**
     * @inheritDoc
     */
    public static function createUserBeneficiaryFromHttpRequest(Request $request): BeneficiaryEntityInterface
    {
        return BeneficiaryEntity::fromArray(
            array_merge(
                $request->json()->all(),
                [
                    'organizations' => $request->get('ApiConsumer')->getOrganizations()
                ]
            )
        );
    }
}
