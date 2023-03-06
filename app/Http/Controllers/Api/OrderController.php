<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * @throws TwilioException
     * @throws ConfigurationException
     */
    public function sendMessage(Request $request): \Illuminate\Http\JsonResponse
    {
        $message = $this->twilio()->messages->create(
            $request->input('to'),
            [
                'from' => 'whatsapp:+15676777791',
                'body' => $request->input('message'),
            ]
        );

        return response()->json([
            'sid' => $message->sid,
            'status' => $message->status,
        ]);
    }

    /**
     * @throws ConfigurationException
     */
//    protected function twilio(): Client
//    {
//        return new Client(
//            config('services.twilio.account_sid'),
//            config('services.twilio.auth_token')
//        );
//    }

    public function order (Request $request)
    {
        $sid = config('services.twilio.account_sid');
        $token = config('services.twilio.auth_token');
        $twilio = new Client($sid, $token);

        try {
            $mobileNumber = $request->get('WaId');
            $twilio->messages
                ->create("whatsapp:+" . $mobileNumber, // to
                    [
                        'from' => 'whatsapp:+15676777791',
                        "body" => 'Carl akaipa',
                    ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage(), [
                'request' => $request->all(),
            ]);
        }




    }
}
