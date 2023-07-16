<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Events\CreateOrder;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    public function createOrder(Request $request)
    {
        if (!isset(Session::get('cart')->products)) {
            return back();
        }
        $data = [
            'payment' => $request->payment,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'address' => $request->address,
            'note' => $request->note,
            'total_payment' => $request->total_payment,
        ];
        DB::beginTransaction();
        try {
            $order = Order::create($data);
            $orderId = $order->id;
            $totalPayment = $order->total_payment;
            $data = [];

            foreach (Session::get('cart')->products as $product) {
                $qty = $product['qty'];
                $data[] = [
                    'order_id' => $orderId,
                    'product_id' => $product['productInfo']->id,
                    'qty' =>  $qty,
                    'price' =>  $product['price'],
                ];
                $product = Product::find($product['productInfo']->id);
                $newInventory = $product->inventory - $qty;
                $product->update(['inventory' => $newInventory]);
            }
            $order->products()->sync($data);

            event(new CreateOrder($order, $data));
            $request->session()->forget('cart');
            DB::commit();
            if ($request->payment == 'online') {
                $payUrl = $this->createPayment($orderId, $totalPayment);
                return redirect()->to($payUrl);
            }
            return view('frontend.carts.checkout-success');
        } catch (\Exception $e) {
            //throw $th;
            Log::error($e->getMessage());
            DB::rollBack();
            return back()->with('error', 'Đặt hàng thất bại');
        }
    }

    public function checkoutSuccess(){
        return view('frontend.carts.checkout-success');
    }
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    function createPayment($orderId, $totalPayment) {
        try {
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $redirectUrl = route('checkout.success'); //route navigation when payment is complete
            $ipnUrl = route('checkout.success'); //route Momo returns transaction results

            $orderId = time().":".$orderId;
            $amount = $totalPayment;
            $extraData = base64_encode(json_encode(['schedule_health_check_id' => $orderId]));
            $requestId = time() ."id";
            $requestType = "captureWallet"; 
            $orderInfo = "Thanh toán qua MoMo";

            // Signature to confirm the transaction in the format of Momo
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array(
                        'partnerCode' => $partnerCode,
                        'requestId' => $requestId,
                        'amount' => $amount,
                        'orderId' => $orderId,
                        'orderInfo' => $orderInfo,
                        'redirectUrl' => $redirectUrl,
                        'ipnUrl' => $ipnUrl,
                        'lang' => 'vi',
                        'extraData' => $extraData,
                        'requestType' => $requestType,
                        'signature' => $signature,
                    );

            // Send payment request to Momo
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true); 
            if (!empty($jsonResult)) {
                return $jsonResult['payUrl'];
            } 
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Thanh toán thất bại');
        }       
    }
}
