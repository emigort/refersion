<?php

namespace App\Services\RefersionServices;

use App\Clients\RefersionApiClient;

class AffiliationService
{
    public function getAffiliateId($variant): int
    {
        $find_me = config('refersion.sku_key_word');
        $find_me_length = strlen($find_me);
        $pos = strpos($variant->sku, $find_me);
        if ($pos === false) {
            return false;
        }
        $affiliate_part = substr($variant->sku, $pos + $find_me_length);
        return (int) filter_var($affiliate_part, FILTER_SANITIZE_NUMBER_INT);
    }

    public function createConversionTriggerBySku(array $variants)
    {
        foreach ($variants as $variant) {
            $affiliate_id = $this->getAffiliateId($variant);
            if (!$affiliate_id) {
                continue;
            }
            $sku = $variant->sku;
            $type = 'SKU';
            $RefersionApiClient = new RefersionApiClient();
            $res = $RefersionApiClient->createConversionTrigger($affiliate_id, $sku, $type);
            if ($res->successful()) {
               return $res->body(); //do something with result
            } else {
               return $res->json();
            }
        }
    }
}