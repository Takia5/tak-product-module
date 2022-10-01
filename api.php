<?php

function requestApi($method, $apiUrl, $data){
   $curl = curl_init();
   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);                              
         break;
      default:
         if ($data)
            $apiUrl = sprintf("%s?%s", $apiUrl, http_build_query($data));
   }
   
   curl_setopt($curl, CURLOPT_URL, $apiUrl);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'APIKEY: HYU670',
      'Content-Type: application/json',
   ));
   
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   
   $resultData = curl_exec($curl);
   if(!$resultData){
        die("Invalid API Request!");
    }
   curl_close($curl);
   return $resultData;
}

?>