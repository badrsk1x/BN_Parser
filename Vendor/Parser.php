<?php
namespace Vendor\Parser;

class Parse{

    public function file_get_contents_curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

        @$data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

}