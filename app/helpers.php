<?php

function auth_person ($field='id') {
  $person = \Auth::user()->person;
  return $person->$field;
}

function place2bookAPI ($endpoint) {
  
  $uri = 'https://place2book.com/da/' . $endpoint;
  $header_key = "X-PLACE2BOOK-API-TOKEN";
  $header_value = env('PLACE2BOOK_API_TOKEN');

  $curl = curl_init();

  curl_setopt_array($curl, array(
      CURLOPT_URL => $uri,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_TIMEOUT => 30000,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
          $header_key .': ' . $header_value,
      ),
  ));
  $response = curl_exec($curl);
  // $err = curl_error($curl);
  curl_close($curl);
  $xml = simplexml_load_string($response);
  $json = json_encode($xml);
  return $json;
}

function place2bookShowStats ($event_id) {
    $endpoint = 'event_api/event_statistics?seccode=' . $event_id . '&secure=true';
    return place2bookAPI ($endpoint);
}

function place2bookShowOrders ($event_id) {
    $endpoint = 'event_api/event_orders?seccode=' . $event_id . '&secure=true';
    return place2bookAPI ($endpoint);
}
