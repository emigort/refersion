<?php

namespace App\Clients;

use Illuminate\Support\Facades\Http;

class RefersionApiClient
{
    /**
     * @var string $base_url
     */
    private $base_url;
    /**
     * @var string $pub_key
     */
    private $pub_key;
    /**
     * @var string $secret_key
     */
    private $secret_key;

    /**
     * @var $client
     */
    private $client;

    /**
     * RefersionApiClient constructor.
     * @throws Exception
     */
    public function __construct()
    {
        try {
            $this->pub_key = env('REFERSION_PUB');
            $this->secret_key = env('REFERSION_SECRET');
            $this->base_url = env('REFERSION_BASE_URL');
            $this->client = Http::withBasicAuth($this->pub_key, $this->secret_key)
                ->baseUrl($this->base_url);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param  string  $affiliate_code
     * @param  string  $type
     * @param  string  $trigger
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function createConversionTrigger(string $affiliate_code, string $type, string $trigger)
    {
        return $this->client->post('new_affiliate_trigger', compact(['affiliate_code', 'type', 'trigger']));
    }

}