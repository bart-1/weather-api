<?php

namespace App\Traits;

trait ApiHarvester
{
    public function apiHarvest($url)
    {
        $isActive = get_headers($url);
        $inactive = $url;

        if ($isActive && strpos($isActive[0], '200')) {
            $conn = curl_init();
            curl_setopt($conn, CURLOPT_URL, $url);
            curl_setopt($conn, CURLOPT_HEADER, false);
            curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($conn);
            $json = json_decode($data, true);
            curl_close($conn);
            return $json;
        } else {
            return $inactive;
        }

    }}
