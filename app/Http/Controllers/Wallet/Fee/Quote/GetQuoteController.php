<?php


namespace App\Http\Controllers\Wallet\Fee\Quote;


use App\Http\Controllers\Wallet\Fee\Quote\Mapper\QuoteFeeMapper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Wallet\Wallet\Fee\Quote\Service\QuoteFeeServiceInterface;
use App\Http\Controllers\Wallet\Fee\Quote\Mapper\QuoteFeeMapperInterface;
use Illuminate\Support\Facades\Validator;


class GetQuoteController extends Controller
{
    /**
     * @var QuoteFeeServiceInterface
     */
    private $quoteFeeService;

    /**
     * @var QuoteFeeMapperInterface
     */
    private $quoteFeeMapper;

    /**
     * GetQuoteController constructor.
     * @param QuoteFeeServiceInterface $quoteFeeService
     * @param QuoteFeeMapper $quoteFeeMapper
     */
    public function __construct(
        QuoteFeeServiceInterface $quoteFeeService,
        QuoteFeeMapper $quoteFeeMapper
    )
    {
        $this->quoteFeeService = $quoteFeeService;
        $this->quoteFeeMapper = $quoteFeeMapper;
    }

    public function getQuote(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'paymentMean' => ['required', 'string'],
                'amount' =>  ['required', 'numeric'],
                'regions' => ['required', 'array'],
                'currency' => ['required', 'string'],
                'originator' => ['required', 'array']
            ]
        );

        if($validator->fails()){
            return response()->json(
                [
                    'status' => 'error',
                    'statusCode'=> 0,
                    'statusDescription'=> $validator->errors()
                ]
            );
        }
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletQuoteFee' => $this
                        ->quoteFeeService
                        ->getQuotes(
                            $this->quoteFeeMapper
                                ->createQuoteFeeFromHttpRequest(
                                $request
                            )
                        )
                        ->toArray()
                ]
            ]
        );
    }
}
