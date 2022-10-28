<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Meet;
use App\Models\User;
use App\Models\Count;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Shetabit\Multipay\Invoice;
use Illuminate\Support\Facades\Http;
use Shetabit\Payment\Facade\Payment;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Shetabit\Payment\Facade\Payment as shetabit;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class PayController extends Controller
{

    public function  go_pay(Request  $request,Bill $bill)
    {
        $user = auth()->user();

        if (!$user) {
            session()->put('key_register', $request->all());
            alert()->error('ابتدا وارد حساب خود  شوید');
            return back();
        }
        if( $bill->buyer->id!= $user->id){
            alert()->error('  این فاکتور مربوط به شما نیست  ');
                    return back();
        }
        $bill->update(
            ['close'=>Carbon::now()]
        );
        $amount = 0;
        $via = 'zarinpal';

        $invoice = (new Invoice);
        $invoice->amount($bill->amount);
        return   shetabit::via($via)->callbackUrl(route('bill.verify'))->purchase($invoice, function ($driver, $transactionId) use ($user,$bill,$via) {
            $bill->update([
                    'trans_id' => $transactionId,
                    'port' => $via,]);
        })->pay()->render();
    }

    public function result_pay(Bill $bill)
    {
        return view('admin.buyer.pay_result', compact([ 'bill']));

    }
    public function verify(Request $request)
    {

        $bill = Bill::where('trans_id', $request->Authority)->first();
        if(!$bill){
            alert()->error('مشکلی پیش امده ');
            return redirect()->route('buyer.bills');
        }
        try {
            $receipt = Payment::amount($bill->amount)->transactionId($bill->trans_id)->verify();
            $bill->status=1;
            $bill->time=Carbon::now();
$bill->save();
        } catch (InvalidPaymentException $exception) {
            /**
                when payment is not verified, it will throw an exception.
                We can catch the exception to handle invalid payments.
                getMessage method, returns a suitable message that can be used in user interface.
            **/
            echo $exception->getMessage();
        }

        return redirect(route('bill.result_pay', $bill->id));
    }


    public function sky($action, $params = array())
    {
        try {
            $test = Http::post('https://www.skyroom.online/skyroom/api/apikey-263858-38-648406da3fbe1d295b451a0bde7427a1', [
                "action" => $action,
                'params' => $params
            ]);
            return   $test->json();
        } catch (\Exception $e) {
            return false;
        }
    }
}
