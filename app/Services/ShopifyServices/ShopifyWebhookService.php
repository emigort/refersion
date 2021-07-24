<?php


namespace App\Services\ShopifyServices;


class ShopifyWebhookService
{
    /**
     * @param $data
     * @param $hmac_header
     * @return bool
     */
    public static function verifyWebhook($data, $hmac_header): bool
    {
        $hash_hmac = hash_hmac('sha256', $data, env('SHOPIFY_WEBHOOK_SECRET'), true);
        $calculated_hmac = base64_encode($hash_hmac);
        return hash_equals($hmac_header, $calculated_hmac);
    }
}