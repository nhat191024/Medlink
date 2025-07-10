<?php

namespace App\Http\Services;

use App\Models\Appointment;
use PayOS\PayOS;

class PaymentService
{
    protected PayOS $payOS;

    public function __construct()
    {
        $this->payOS = new PayOS(
            env("PAYOS_CLIENT_ID"),
            env("PAYOS_API_KEY"),
            env("PAYOS_CHECKSUM_KEY")
        );
    }

    /**
     * Process appointment payment
     *
     * @param Appointment $appointment
     * @param string $paymentMethod
     * @return array
     */
    public function processAppointmentPayment(array $data, $paymentMethod, bool $isAppRequest)
    {
        // This would integrate with your payment gateway
        // For now, we'll simulate payment processing

        switch ($paymentMethod) {
            case 'wallet':
                return $this->processWalletPayment($data);
            case 'credit_card':
                return $this->processCreditCardPayment($data);
            case 'qr_transfer':
                return $this->processQRTransferPayment(
                    $data['billId'],
                    $data['amount'],
                    $data['buyerName'] ?? null,
                    $data['buyerEmail'] ?? null,
                    $data['buyerPhone'] ?? null,
                    $data['buyerAddress'] ?? null,
                    $data['items'] ?? null,
                    $data['expiryTime'] ?? null,
                    $isAppRequest
                );
            default:
                throw new \Exception('Invalid payment method');
        }
    }

    /**
     * Process wallet payment
     */
    private function processWalletPayment($appointment)
    {
        //TODO: Implement wallet payment logic
        return [];
    }

    /**
     * Process credit card payment
     */
    private function processCreditCardPayment($appointment)
    {
        //TODO: Implement credit card payment logic
        return [];
    }

    /**
     * Process QR transfer payment
     */
    private function processQRTransferPayment(
        int $billId,
        int $amount,
        ?string $buyerName = null,
        ?string $buyerEmail = null,
        ?string $buyerPhone = null,
        ?string $buyerAddress = null,
        ?array $items = null,
        ?int $expiryTime = null,
        bool $isAppRequest
    ) {
        $orderCode = $billId;
        $expiryTime ??= intval(now()->addMinutes(5)->timestamp);

        $url = $isAppRequest
            ? env("APP_DEEPLINK_URL")
            : env("APP_URL");

        $paymentRequest = [
            'orderCode' => $orderCode,
            'amount' => $amount,
            'description' => "VQR-{$billId}",
            'buyerName' => $buyerName,
            'buyerEmail' => $buyerEmail,
            'buyerPhone' => $buyerPhone,
            'buyerAddress' => $buyerAddress,
            'items' => $items,
            'cancelUrl' => $url,
            'returnUrl' => $url,
            'expiryTime' => $expiryTime,
        ];

        $signature = self::createSignaturePaymentRequest(
            env("PAYOS_CHECKSUM_KEY"),
            $paymentRequest
        );

        $paymentRequest['signature'] = $signature;

        $response = $this->payOS->createPaymentLink($paymentRequest);

        return $response;
    }

    /**
     * Create a signature for the payment request
     *
     * @param string $checksumKey
     * @param array $obj
     * @return string
     */
    public static function createSignatureFromObj($checksumKey, $obj)
    {
        ksort($obj);
        $queryStrArr = [];
        foreach ($obj as $key => $value) {
            if (in_array($value, ["undefined", "null"]) || gettype($value) == "NULL") {
                $value = "";
            }

            if (is_array($value)) {
                $valueSortedElementObj = array_map(function ($ele) {
                    ksort($ele);
                    return $ele;
                }, $value);
                $value = json_encode($valueSortedElementObj);
            }
            $queryStrArr[] = "{$key}={$value}";
        }
        $queryStr = implode("&", $queryStrArr);
        $signature = hash_hmac('sha256', $queryStr, $checksumKey);
        return $signature;
    }

    public static function createSignaturePaymentRequest($checksumKey, $obj)
    {
        $dataStr = "amount={$obj["amount"]}&cancelUrl={$obj["cancelUrl"]}&description={$obj["description"]}&orderCode={$obj["orderCode"]}&returnUrl={$obj["returnUrl"]}";
        $signature = hash_hmac("sha256", $dataStr, $checksumKey);
        return $signature;
    }
}
