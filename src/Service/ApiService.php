<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiService
{
    public function __construct(
        private HttpClientInterface $client
    ){}

    public function requestApi($metode, $url, $option = [])
    {
        $ApiKeys=["k_50j02iau","k_beyr9s66"];
        //"k_j3omsu24","k_4bx47zo8","k_j7187ii9","k_yh57hl53","k_xgb2vq56","k_bfyih0ap","k_8qw3mkmj","k_97a2otm1","k_8np0aebl","k_0s5tw04y","k_t78tl34w","k_q3qadbr1","k_0u3kzxoj"
        $key=0;
        $url = str_replace("ApiKey",$ApiKeys[$key],$url);
        while ($key!=-1){
            $request=$this->client->request($metode, $url, $option);
            if(
                isset($request->toArray()['errorMessage']) &&
                $request->toArray()["errorMessage"]!= null &&
                $key+1 < sizeof($ApiKeys))
            {
                $url = str_replace($ApiKeys[$key],$ApiKeys[$key+1],$url);
                $key++;

            }else{
                $key= -1;
            }
        }

        return $request->toArray();
    }
}