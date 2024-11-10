<?php

namespace App\PaymentGateway;

use Pasargad\Classes\AbstractPayment;
use Pasargad\Classes\PaymentItem;
use Pasargad\Classes\PaymentType;
use Pasargad\Classes\RequestBuilder;
use Pasargad\Classes\RSA\RSAProcessor;

class Pasargad extends AbstractPayment
{
    /** @var RequestBuilder $api */
    private $api;

    /** @var string $token */
    private $token = null;

    /** @var boolean $safeMode */
    private $safeMode = true;

    /** @var array $paymentItems */
    private $paymentItems = [];

    /** @var boolean $multiPaymentMode */
    private $multiPaymentMode = false;

    /**
     * Address of gateway for getting token
     * @var string
     */
    const URL_GET_TOKEN = "https://pep.shaparak.ir/dorsa1/token/getToken";

    private $username_p = 'ERP5184648';
    private $password_p = 'GJe0sg0$2M';
    /**
     * Redirect User with token to this URL
     * e.q: https://pep.shaparak.ir/payment.aspx?n=Token
     */
    const URL_PAYMENT_GATEWAY = "https://pep.shaparak.ir/payment.aspx";
    const URL_BASE = "https://pep.shaparak.ir/dorsa1";
    const URL_CHECK_TRANSACTION = 'https://pep.shaparak.ir/Api/v1/Payment/CheckTransactionResult';
    const URL_VERIFY_PAYMENT = 'https://pep.shaparak.ir/Api/v1/Payment/VerifyPayment';
    const URL_REFUND = 'https://pep.shaparak.ir/Api/v1/Payment/RefundPayment';

    /**
     * Pasargad Constructor
     * @var int $merchantCode
     * @var int $terminalCode
     * @var string $redirectAddress
     * @var string $certificateFile
     * @var string $action
     */
    public function __construct($merchantCode, $terminalCode, $redirectAddress, $certificateFile, $merchantName = null, $action = "1003", $safeMode = true)
    {

        $this->merchantId = $merchantCode;
        $this->terminalId = $terminalCode;
        $this->redirectUrl = $redirectAddress;
//        $this->certificate = $certificateFile;
//        $this->merchantName = $merchantName;
//        $this->action = $action;
//        $this->safeMode = $safeMode;
//        $this->api = new RequestBuilder();


    }

    /**
     * Sign data using RSA key
     * @var array $data
     */
//    private function sign($data)
//    {
//        $processor = new RSAProcessor($this->certificate);
//        return base64_encode($processor->sign(sha1($data, true)));
//    }

    /**
     * Get Token to prepare user for redirecting to payment gateway
     */
//    public function getToken()
//    {
//        $params["amount"] = $this->getAmount();
//        $params["invoiceNumber"] = $this->getInvoiceNumber();
//        $params["invoiceDate"] = $this->getInvoiceDate();
//        $params['action'] = $this->getAction();
//        $params['merchantCode'] = $this->getMerchantId();
//        $params['terminalCode'] = $this->getTerminalId();
//        $params['redirectAddress'] = $this->getRedirectUrl();
//        $params['timeStamp'] = date("Y/m/d H:i:s");
//        if ($this->getMobile()) {
//            $params['mobile'] = $this->getMobile();
//        }
//        if ($this->getEmail()) {
//            $params['email'] = $this->getEmail();
//        }
//
//        if ($this->multiPaymentMode) {
//            if ($this->getMerchantName() !== null) {
//                $params['MerchantName'] = $this->getMerchantName();
//            }
//            $params['MultiPaymentData'] = base64_encode($this->generatePayment());
//        }
//
//        $sign = $this->sign(json_encode($params));
//        $this->token = $this->api->send(static::URL_GET_TOKEN, RequestBuilder::POST, ["Sign" => $sign], $params, true, $this->safeMode);
//        return $this->token;
//    }

    public function getToken()
{

    $us = $this->username_p;
    $pa = $this->password_p;
    $data = array(
        'username' => $us,
        'password' => $pa
    );
    $curl = curl_init(self::URL_GET_TOKEN);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $s = curl_exec($curl);

    $result = json_decode($s);
    curl_close($curl);
    $this->token = $result->token;


    if (!isset($result) || !isset($result->token)){
        self::display_error(110002, '', '', 1, 'خطای در دریافت توکن');
        exit;
    }elseif ( isset($result->resultCode) && $result->resultCode !=0 ){
        self::display_error(isset($result->resultCode) ? $result->resultCode : null, '', '', 0, self::PecStatus($result->resultCode));
        exit;
    }

    return ($result);
}

    /**
     * Redirect User to Gateway
     */

    public  function redirect($token_p,$national_code,$phone_number)
    {
        $us = $this->username_p;
        $pa = $this->password_p;
        $data = array(
            'username' => $us,
            'password' => $pa
        );

        //take token
//        $token_p = $this->getToken()->token;



        $result = "";
        if ( isset($token_p)) {
            $curl = curl_init();
            $d = date("Y-m-d");
            curl_setopt_array($curl, array(
                CURLOPT_URL => self::URL_BASE . '/api/payment/purchase',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                "amount":' . $this->getAmount() . ',
                "callbackApi": "' . $this->redirectUrl . '",

                "invoice": "' . $this->getInvoiceNumber() .'",
                "invoiceDate":"'. $d . '",
                "mobileNumber":"'.$phone_number.'",
                "serviceCode": "8",
                "serviceType": "PURCHASE",
                "payerMail": "",
                "payerName": "",
                "terminalNumber":"' . $this->terminalId . '",
                "nationalCode": "",
                "paymentCode":"0"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $token_p ,
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            $result = json_decode($response);


            curl_close($curl);



//            if (isset($response) && (isset($result->resultCode)) ){
//                if($result->resultCode == 0)
//                    self::d_redirect($result->data->url);
//                else
//                    self::display_error($result->resultCode, '', strval($InvoiceNumber), 0, isset($Request->Message) ? $Request->Message : 'خطای نامشخص');
//            }else{
//                self::display_error(110003, '', strval($InvoiceNumber), 0, isset($Request->Message) ? $Request->Message : 'خطای نامشخص');
//            }


        }
        return $result;
    }

//    public function redirect()
//    {
//        $token = null;
//        if (!$this->token) {
//            $this->token = $this->getToken();
//        }
//        $token = $this->token["Token"];
//        return static::URL_PAYMENT_GATEWAY . "?n=" . $token;
//    }

    /**
     * Verify Payment
     */
//    public function verifyPayment()
//    {
//        $params['amount'] = $this->getAmount();
//        $params['invoiceNumber'] = $this->getInvoiceNumber();
//        $params['invoiceDate'] = $this->getInvoiceDate();
//        $params['merchantCode'] = $this->getMerchantId();
//        $params['terminalCode'] = $this->getTerminalId();
//        $params['timeStamp'] = date("Y/m/d H:i:s");
//        $sign = $this->sign(json_encode($params));
//        $response = $this->api->send(static::URL_VERIFY_PAYMENT, RequestBuilder::POST, ["Sign" => $sign], $params, true, $this->safeMode);
//        return $response;
//    }


    public function verifyPayment($urlId){
         $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => self::URL_BASE . '/api/payment/verify-transactions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "invoice": "'. $this->getInvoiceNumber() . '",
            "urlId": "'. $urlId . '"
            }
            ',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->getToken()->token,
                'Content-Type: application/json',
            ),
            ));

            $response = curl_exec($curl);

            $result = json_decode( $response);
            curl_close($curl);


            return $result;
}
    /**
     * Check Transaction with referenceId
     */
//    public function checkTransaction()
//    {
//        $params['invoiceNumber'] = $this->getInvoiceNumber();
//        $params['invoiceDate'] = $this->getInvoiceDate();
//        $params['merchantCode'] = $this->getMerchantId();
//        $params['terminalCode'] = $this->getTerminalId();
//        $params['transactionReferenceID'] = $this->getTransactionReferenceId();
//        $response = $this->api->send(static::URL_CHECK_TRANSACTION, RequestBuilder::POST, [], $params, true, $this->safeMode);
//        return $response;
//    }
    public function checkTransaction()
    {
        $tk =  isset($this->getToken()->token) ? $this->getToken()->token: '';
        $error_code = isset($tk) ? null : 'توکن نامعتبر است';
        $TransactionReferenceID ='';
//
//        if (isset($error_code)){
//            self::display_error(isset($error_code) ? $error_code : null, $TransactionReferenceID, $sessionid, 1, isset($message) ? $message : '');
//            exit;
//        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::URL_BASE . '/api/payment/payment-inquiry',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                  "invoiceId": "' .  $this->getInvoiceNumber() . '"
              }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->getToken()->token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return($response);
    }
    /**
     * Refund Payment
     */
    public function refundPayment()
    {
        $params['invoiceNumber'] = $this->getInvoiceNumber();
        $params['invoiceDate'] = $this->getInvoiceDate();
        $params['merchantCode'] = $this->getMerchantId();
        $params['terminalCode'] = $this->getTerminalId();
        $params['timeStamp'] = date("Y/m/d H:i:s");
        $sign = $this->sign(json_encode($params));
        $response = $this->api->send(static::URL_REFUND, RequestBuilder::POST, ["Sign" => $sign], $params, true, $this->safeMode);
        return $response;
    }

    public function addPaymentType($iban,$type,$value)
    {
        $this->paymentItems[] = new PaymentItem($iban,$type,$value);
        $this->multiPaymentMode = true;
    }


    private function generatePayment()
    {
        $xw = xmlwriter_open_memory();
        xmlwriter_set_indent($xw, 1);
        $res = xmlwriter_set_indent_string($xw, ' ');
        xmlwriter_start_document($xw, '1.0', 'UTF-8');
        /** @var PaymentItem $item */
        foreach ($this->paymentItems as $item) {
            // <item>
            xmlwriter_start_element($xw, 'item');

            // <iban>
            xmlwriter_start_element($xw, 'iban');
            xmlwriter_text($xw, $item->getIban());
            xmlwriter_end_element($xw);
            // </iban>


            // <type>
            xmlwriter_start_element($xw, 'type');
            xmlwriter_text($xw, $item->getType());
            xmlwriter_end_element($xw);
            // </type>

            // <value>
            xmlwriter_start_element($xw, 'value');
            xmlwriter_text($xw, $item->getValue());
            xmlwriter_end_element($xw);
            // </value>

            xmlwriter_end_element($xw);
            // </item>
        }

        xmlwriter_end_document($xw);
        return xmlwriter_output_memory($xw);
    }
}
