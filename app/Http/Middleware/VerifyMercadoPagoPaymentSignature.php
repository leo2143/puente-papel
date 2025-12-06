<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class VerifyMercadoPagoPaymentSignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $receivedSignature = $request->header('x-signature');
        $receivedRequestId = $request->header('x-request-id');
        $dataId = $request->input('data.id');

        $signatureParts = explode(',', $receivedSignature);
        $signatureTS = explode('=', $signatureParts[0])[1];
        $signatureKey = explode('=', $signatureParts[1])[1];

        $validationKey = "id:$dataId;request-id:$receivedRequestId;ts:$signatureTS;";

        $hashedKey = hash_hmac('sha256', $validationKey, config('mercadopago.secret_key'));
        
        $request->merge(['payment-successfuly' => $signatureKey == $hashedKey]);
        return $next($request);
    }
}
