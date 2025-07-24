<?php

namespace App\Http\Controllers\Api;

use App\Models\Bill;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Services\PaymentService;
use App\Http\Resources\TransactionResourceCollection;

use Symfony\Component\HttpFoundation\Response;

class WalletController extends Controller
{
    private $paymentService;

    public function __construct()
    {
        $this->paymentService = app(PaymentService::class);
    }

    /**
     * Get the wallet balance.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWalletBalance()
    {
        $user = Auth::user();
        $userBalance = $user->balance;
        return response()->json(['balance' => $userBalance]);
    }

    /**
     * Get the wallet transaction history.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTransactionHistory()
    {
        $user = Auth::user();
        $data = $user->wallet->transactions;
        $transactions = new TransactionResourceCollection($data);

        return response()->json($transactions, Response::HTTP_OK);
    }

    /**
     * Get QR code for wallet recharge.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRechargeQRCode(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'amount' => 'required|numeric|min:1',
            ]);

            $user = Auth::user();
            $currentDate = now()->format('Y-m-d H:i:s');
            $payosId = time() . mt_rand(100000, 999999);
            $transaction = $user->deposit(
                $request->input('amount'),
                ['description' => `Wallet recharge - {$currentDate}`, 'payosId' => $payosId],
                false
            );

            $data = [
                'billId' => $payosId,
                'amount' => $request->input('amount'),
                'buyerName' => $user->name,
                'buyerEmail' => $user->email,
                'buyerPhone' => $user->phone,
                'items' => [
                    [
                        'name' => "Nạp Tiền Vào Vì Ứng Dụng Medlink - {$user->name}",
                        'price' => $request->input('amount'),
                        'quantity' => 1,
                    ]
                ],
                'expiryTime' => intval(now()->addMinutes(10)->timestamp)
            ];

            $response = $this->paymentService->processAppointmentPayment($data, 'qr_transfer', true, true);

            DB::commit();

            return response()->json([
                'message' => 'QR code created successfully',
                'data' => [
                    'qrCodeUrl' => $response['data']['checkoutUrl'],
                    'qrCode' => $response['data']['qrCode'],
                    'transactionId' => $transaction->id,
                    'billId' => $response['data']['orderCode'],
                    'amount' => $request->input('amount'),
                ]
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Recharge the wallet.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function rechargeWallet(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|integer',
        ]);

        $user = Auth::user();
        $transactionId = $request->input('transaction_id');

        $transaction = $user->wallet->transactions->find($transactionId);
        $user->confirm($transaction);

        return response()->json(['message' => 'Wallet recharged successfully', 'balance' => $user->balance], Response::HTTP_OK);
    }
}
