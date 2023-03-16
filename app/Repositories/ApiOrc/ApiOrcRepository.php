<?php

namespace App\Repositories\ApiOrc;

use App\Models\LevelGroup\LevelGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiOrcRepository
{
    public $errors = [];

    public function __construct()
    {
        $this->URLBASE = "https://pub.orcid.org/v3.0";
    }

    public function GET($url) 
    {
        $this->errors = [];
        $curl = curl_init();

        $header = array(
            "cache-control: no-cache",
            "Content-Type: application/json",
            "Accept: application/json",
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => "{$this->URLBASE}{$url}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => $header,
        ));

        $response = curl_exec($curl);

        return $this->handleResponse($curl, $response);
    }

    private function handleResponse($curl, $response){
        if (curl_errno($curl)) {
            return false;
        }
        if (($rcodigo = curl_getinfo($curl, CURLINFO_HTTP_CODE)) !== 200) {
            $this->errors = array(["message" => "Resource not found"]) ?? [];
            return false;
        }
        if (empty($response)) {
            return false;
        }
        $response = json_decode($response);

        curl_close($curl);
        return $response;
    }

    public function getByORCID($orcid){
        return $this->GET("/{$orcid}");
    }
}