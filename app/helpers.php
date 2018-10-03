<?php

function auth_person ($field='id') {
  $person = \Auth::user()->person;
  return $person->$field;
}

function user_can_see_all_people () {
  $person = \Auth::user()->person;
  return $person->can_see_all_people == 1;
}

function user_is_admin () {
  $person = \Auth::user()->person;
  return $person->is_admin == 1;
}

function user_is_superuser () {
  $person = \Auth::user()->person;
  return $person->is_superuser == 1;
}

function user_is_admin_or_superuser () {
  $person = \Auth::user()->person;
  return ($person->is_superuser == 1) || ($person->is_admin == 1) ;
}

function string_or_empty($variable) {
  if (is_string($variable)){
    return $variable;
  } else {
    return '';
  }
}

function is_thumbnailable($filename) {
    $array = array ('jpg','gif','png','bmp','jpeg');
    $extension = strtolower (pathinfo($filename)['extension']);
    $is_thumbnailable = in_array ( $extension , $array );
    return $is_thumbnailable;
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

function mapTicketType ($tickettype) {
  switch ($tickettype) {
    //standard tickets
    case 'Standard (reserved)';
    case 'Standard';
    case 'Standard ticket';
    case 'Standard overbooking';
    case 'Adults';
    case 'Adult';
    case 'voksen';
    case 'VIP Table 1A';
    case 'VIP Table 1B';
    case 'VIP Table 2A';
    case 'VIP Table 2B';
      $tickettype = "standard";
      break;
    //child tickets
    case 'Child (reserved)';
    case 'Child';
      $tickettype = "child";
      break;
    //group 10-19
    case 'Group 10-19 adults';
    case 'Split Group 10-19';
    case 'Group 10-19 (reserved)';
    case 'Group (10-19 tickets)';
      $tickettype = "group_10_to_19";
      break;
    //group 20+
    case 'Group 20+';
    case 'Group 20+ (reserved)';
    case 'Extra group tickets (over 20)';
    case 'Group (20 and up)';
      $tickettype = "group_20_or_more";
      break;
    //membership
    case 'Membership Ticket';
    case 'Membership ticket';
      $tickettype = "membership_adult";
      break;
    //membership child
    case 'Membership Ticket (child)';
    case 'Membership ticket (child)';
      $tickettype = "membership_child";
      break;
    //membership child
    case 'Complimentary';
    case 'Comp';
      $tickettype = "comp";
      break;
    //default: list ticket type
    default;
      $tickettype = "other";
      break;
  }
  return $tickettype;
}

function mapTicketTypeID ($tickettype) {
  switch ($tickettype) {
    //standard tickets
    case 'Standard (reserved)';
    case 'Standard';
    case 'Standard ticket';
    case 'Standard overbooking';
    case 'Adults';
    case 'Adult';
    case 'Adult (reserved)';
    case 'voksen';
    case 'VIP Table 1A';
    case 'VIP Table 1B';
    case 'VIP Table 2A';
    case 'VIP Table 2B';
      $tickettype = 1;
      break;
    //child tickets
    case 'Child (reserved)';
    case 'Child';
    case 'Child (12 yrs and under)';
      $tickettype = 2;
      break;
    //group 10-19
    case 'Group 10-19 adults';
    case 'Split Group 10-19';
    case 'Group 10-19 (reserved)';
    case 'Group (10-19 tickets)';
      $tickettype = 3;
      break;
    //group 20+
    case 'Group 20+';
    case 'Group 20+ (reserved)';
    case 'LINK Group ticket adult';
    case 'LINK Group ticket child';
    case 'Extra group tickets (over 20)';
    case 'Group (20 and up)';
      $tickettype = 4;
      break;
    //membership
    case 'Membership Ticket';
    case 'Membership ticket';
      $tickettype = 5;
      break;
    //membership child
    case 'Membership Ticket (child)';
    case 'Membership ticket (child)';
      $tickettype = 6;
      break;
    //membership child
    case 'Complimentary';
    case 'Comp';
      $tickettype = 7;
      break;
    case 'Club Lorry';
    case 'Discount';
      $tickettype = 9;
      break;
    //default: list ticket type
    default;
      $tickettype = 8;
      break;
  }
  return $tickettype;
}

function mapTicketPRTypeID ($ticketprtype) {
  $ticketprtype = trim($ticketprtype);
  switch ($ticketprtype) {
    case 'Via a CTC member';
      $id = 1;
      break;
    case 'Via a cast member';
      $id = 2;
      break;
    case 'On a poster or postcard';
    case 'I saw a poster or postcard';
      $id = 3;
      break;
    case 'By word of mouth';
    case 'Through a friend';
      $id = 4;
      break;
    case 'On Facebook';
      $id = 5;
      break;
    case 'In the Copenhagen Post';
    case 'The Copenhagen Post';
      $id = 6;
      break;
    case 'In Østerbro Avis';
      $id = 7;
      break;
    case 'Other';
    case 'A combination of the above';
      $id = 8;
      break;
    case 'Via e-mail';
    case 'I received information via email';
      $id = 9;
      break;
    case 'On Internations';
      $id = 11;
      break;
    case 'Via Meet-up';
      $id = 12;
      break;
    case 'Through Zangenbergs Teater';
      $id = 13;
      break;
    default;
      $id = 10;
      break;
  }
  return $id;
}
