<?php

namespace App\Http\Controllers;

use App\Services\RefersionServices\AffiliationService;
use Exception;
use Illuminate\Http\Request;

class ShopifyWebhookController extends Controller
{
    /**
     * @throws Exception
     */
    public function productCreate(Request $request)
    {
        try {
            echo 'Done';
            $payload = json_decode($request->getContent());
            $AffiliationService = new AffiliationService;
            $AffiliationService->createConversionTriggerBySku($payload->variants);
            //I think this should be send to a queue because if a products has
            //several variants the execution could be longer that what the webhook is
            //allowed to wait for the response
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
