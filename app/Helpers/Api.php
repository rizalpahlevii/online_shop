<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Api
{
    protected $client;
    public function __construct()
    {
        $this->client = new Client([
            'headers' => [
                'key' => '4094bed72cb6d0e77f434de0940e68b0'
            ]
        ]);
    }
    public function province($id = null)
    {
        if ($id == null) {
            $response = $this->client->request('GET', 'https://api.rajaongkir.com/starter/province');
        } else {
            $response = $this->client->request('GET', 'https://api.rajaongkir.com/starter/province?id=' . $id);
        }
        return $response->getBody()->getContents();
    }
    public function city($province_id = null)
    {
        if ($province_id == null) {
            $response = $this->client->request('GET', 'https://api.rajaongkir.com/starter/city');
        } else {
            $response = $this->client->request('GET', 'https://api.rajaongkir.com/starter/city?province=' . $province_id);
        }
        return $response->getBody()->getContents();
    }
    public function postalCode($city_id)
    {
        $response = $this->client->request('GET', 'https://api.rajaongkir.com/starter/city?id=' . $city_id);
        return $response->getBody()->getContents();
    }
}
