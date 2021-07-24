<?php

namespace App\Http\Middleware;

use App\Services\ShopifyServices\ShopifyWebhookService;
use Closure;
use Illuminate\Http\Request;

class ShopifyWebhooks
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $hmac_header = $request->header('x-shopify-hmac-sha256', null);
        $data = $request->getContent();
        if(!ShopifyWebhookService::verifyWebhook($data, $hmac_header)){
            return $next($request);
        }
        abort(403);
    }

}
