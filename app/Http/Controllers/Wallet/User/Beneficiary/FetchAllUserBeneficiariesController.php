<?php


namespace App\Http\Controllers\Wallet\User\Beneficiary;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Wallet\User\Mapper\UserMapper;
use App\Http\Controllers\Wallet\User\Mapper\UserMapperInterface;
use Wallet\Wallet\User\Service\UserService;
use Wallet\Wallet\User\Service\UserServiceInterface;
use Illuminate\Http\Request;

class FetchAllUserBeneficiariesController extends Controller
{


    private $userBeneficiaryService;


    public function fetchAll(
        Request $request
    )
    {
        return

             [
                "status" => "success",
                "data" => [
                    "UserBeneficiaries" => [
                        [
                            "beneficiaryType" => "individual",
                            "beneficiaryDetails" => [
                                "name" => "New Beneficiary Name",
                                "email" => "mkeita@hakili.io",
                                "phoneNumber" => "0033613045943",
                                "address" => [
                                    "streetName" => "Wicksteed House",
                                    "streetNumber" => 35,
                                    "city" => "Elephant And Castle",
                                    "postCode" => "SE16RQ",
                                    "state" => "London",
                                    "country" => "United Kingdom"
                                ]
                            ],
                            "beneficiaryAccountDetails" => [
                                "accountType" => "Wallet Account",
                                "accountIdentifiers" => [
                                    [
                                        "AccountIdentifierName" => "WALLET_ACCOUNT_ID",
                                        "AccountIdentifierValue" => "5e7e2423b7628f5bc41f6bea"
                                    ]
                                ]
                            ],
                            "transferNotification" => [
                                "beneficiary" => [
                                    "notify" => true
                                ],
                                "sender" => [
                                    "notify" => true
                                ]
                            ],
                            "beneficiaryId" => "5e7e2423b7628f5bc41f6bea",
                            "userId" => "5e7e2423b7628f5bc41f6bea",
                            "organizationId" => "5e7e2423b7628f5bc41f6bea",
                            "createdAt" => 1587577927,
                            "modifiedAt" => 1587577927,
                            "deletedAt" => 1587577927,
                            "status" => "active"
                        ]
                    ]
                ]
            ];


    }
}
