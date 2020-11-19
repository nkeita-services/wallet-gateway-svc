<?php


namespace App\Http\Controllers\Wallet\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wallet\Wallet\Organization\Service\OrganizationService;
use Wallet\Wallet\Organization\Service\OrganizationServiceInterface;

class FetchOrganizationDataController extends Controller
{

    /**
     * @var OrganizationServiceInterface
     */
    private $walletOrganizationService;

    /**
     * FetchOrganizationDataController constructor.
     * @param OrganizationServiceInterface $walletOrganizationService
     */
    public function __construct(OrganizationService $walletOrganizationService)
    {
        $this->walletOrganizationService = $walletOrganizationService;
    }


    public function fetchData(
        Request $request
    ){
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletOrganization' => $this
                        ->walletOrganizationService
                        ->fromClientIdentifier(
                            $request->get(
                                'clientIdentifier',
                                $request->get('ApiConsumer')->getClientId()
                                )
                        )->toArray()
                ]
            ]
        );
    }
}
