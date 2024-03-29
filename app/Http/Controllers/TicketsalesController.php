<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Ticketorder;
use App\Ticket;
use App\Mapping;
use App\Ticketprtype;
use Illuminate\Support\Facades\DB;

class TicketsalesController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('member');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $events = Event::where('project_id', $id)->orderBy('date')->orderBy('time')->get();
    $array['total_sold'] = 0;
    $array['total_available'] = 0;
    $array['total_standard'] = 0;
    $array['total_early_bird'] = 0;
    $array['total_child'] = 0;
    $array['total_student'] = 0;
    $array['total_group_10_to_19'] = 0;
    $array['total_group_20_or_more'] = 0;
    $array['total_membership_adult'] = 0;
    $array['total_membership_child'] = 0;
    $array['total_comp'] = 0;

    $project = \App\Project::where('id', $id)->first();
    $array['project'] = $project['name'];
    $array['project_id'] = $project['id'];

    foreach ($events as $event) {
      $subarray['id'] = $event['id'];
      $subarray['date'] = $event['date'];
      $subarray['time'] = $event['time'];
      // $seccode = $event['place2book_seccode'];
      // $subarray['seccode'] = $seccode;
      // $orders = place2bookShowStats($seccode);
      // $orders_array = json_decode($orders, TRUE);

      // Get orders from ticketsales_billetlugen entity with given event-id
      $orders_array = \App\TicketsalesBilletlugen::where('event_id', $event['billetlugen_event_id'])->get();

      // return $orders_array;

      // $orders_array = $orders_array['event']['tickets']['ticket'];
      //wrap in array if only one value
      // if (isset($orders_array['name'])) {
      //   $extended_array = array();
      //   $extended_array[0] = $orders_array;
      //   $orders_array = $extended_array;
      // }
      // return $orders_array;
      //initialise ticket amounts
      $subarray['sold'] = 0;

      $subarray['available'] = 0;
      $subarray['standard'] = 0;
      $subarray['early_bird'] = 0;
      $subarray['child'] = 0;
      $subarray['student'] = 0;
      $subarray['group_10_to_19'] = 0;
      $subarray['group_20_or_more'] = 0;
      $subarray['membership_adult'] = 0;
      $subarray['membership_child'] = 0;
      $subarray['comp'] = 0;



      //map each ticket type and add to sum
      foreach ($orders_array as $orders_detail) {

        // if (isset($orders_detail['available'])) {
        //   $available_iteration = (int) $orders_detail['available'];
        //   if ($available_iteration > $subarray['available']) {
        //     $subarray['available'] = $available_iteration;
        //   }
        // } else {
        //   $available_iteration = (int) $orders_array['available'];
        //   if ($available_iteration > $subarray['available']) {
        //     $subarray['available'] = $available_iteration;
        //   }
        // }
        // if not a valid order, skip
        if ($orders_detail['status'] != 'valid') {
          continue;
        }

        $tickettype = $orders_detail['ticket_type'];
        $subarray['sold'] += 1;
        $array['total_sold'] += 1;

        switch ($tickettype) {
          //standard tickets
          case 'Normal';
          case 'Adult';
            $tickettype = "standard";
            break;
          case 'Early Bird Tickets';
          case 'Early Bird Promo';
            $tickettype = 'early_bird';
            break;
          //   $tickettype = "discount";
          //   break;
          //child tickets
          case 'Under 25';
          case 'Students (18-25 y.o.)';
            $tickettype = 'student';
            break;
          case 'Kids (17 y.o. & below)';
            $tickettype = "child";
            break;
          //group 10-19
          case 'Group 10-19';
            $tickettype = "group_10_to_19";
            break;
          //group 20+
          case 'Group 20+';
            $tickettype = "group_20_or_more";
            break;
          //membership
          case 'CTC Member';
            $tickettype = "membership_adult";
            break;
          //membership child
          // case 'Membership Ticket (child)';
          // case 'Membership ticket (child)';
          //   $tickettype = "membership_child";
          //   break;
          //membership child
          case 'Complimentary';
          case 'Comp';
            $tickettype = "comp";
            break;
          //default: list ticket type
          default;
            break;
        }

        $subarray[$tickettype] = $subarray[$tickettype] ?? 0;
        $subarray[$tickettype] += 1;
        $array['total_' . $tickettype] += 1;

      }
      // Assign available from events data instead
      $subarray['available'] = $event['available_tickets'] - $subarray['sold'];
      $array['total_available'] += $subarray['available'];
      $array['events'][] = $subarray;
    }
    $output = $array;
    // return $output;
    return view('ticketsales.show', Compact('output'));

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }

  /**
   * Import ticket sales data
   */
  public function import($id)
  {
    $events = Event::where('project_id', $id)->orderBy('date')->orderBy('time')->get();

    // uncomment here to return json of event data from database
    // return $events;

    //for debugging only:
    // foreach ($events as $event) {
    //   $seccode = $event['place2book_seccode'];
    //   $api_data = place2bookShowOrders ($seccode);
    //   $api_data = json_decode($api_data, TRUE);
    //   $orders[] = $api_data['event']['purchases']['purchase'];
    //
    // }
    // return $orders;


    foreach ($events as $event) {

      //store event_id
      $event_id = $event['id'];

      // retrieve seccode for each event from database
      $seccode = $event['place2book_seccode'];

      // retrieve orders from place2book API
      $api_data = place2bookShowOrders($seccode);

      // json_decode
      $api_data = json_decode($api_data, TRUE);

      // uncomment here to return json of ALL api_data as returned by place2book
      // return $api_data;

      // return $api_data;
      $orders = $api_data['event']['purchases']['purchase'];

      // uncomment here to return json of only purchase data as returned by place2book
      // return $orders;

      // make sure ticket orders are always in array
      $orderarray = array();
      if (isset($orders['purchase_id'])) {
        $orderarray[0] = $orders;
      } else {
        foreach ($orders as $order) {
          $orderarray[] = $order;
        }
      }

      // reorganise array
      foreach ($orderarray as $order) {

        //initialise order_array
        $order_array = array();

        //store purchase id
        $purchase_id = $order['purchase_id'];

        // make sure tickets are always in array
        $tickets = $order['tickets']['ticket'];
        $ticketarray = array();
        if (isset($tickets['id'])) {
          $ticketarray[0] = $tickets;
        } else {
          foreach ($tickets as $ticket) {
            $ticketarray[] = $ticket;
          }
        }

        //store values for each order
        $order_array['event_id'] = $event_id;
        $order_array['id'] = $order['purchase_id'];
        $order_array['purchase_timestamp'] = $order['created_at'];
        $order_array['customer_name'] = string_or_empty($order['customer']['name']);
        $order_array['customer_mail'] = string_or_empty($order['customer']['email']);


        //initialise pr and $newsletter
        $order_array['ticketprtype_id'] = "";
        $order_array['newsletter'] = "";

        // parse custom field 1

        if (!empty($order['custom_fields']['custom_field'][0]['value'])) {

          $custom_field_1_name = $order['custom_fields']['custom_field'][0]['name'];
          $custom_field_1_value = $order['custom_fields']['custom_field'][0]['value'];
          $order_array['question_1'] = $custom_field_1_name;
          $order_array['answer_1'] = $custom_field_1_value;

          //pr
          if (strpos($custom_field_1_name, 'How') !== false) {
            $pr = (string) trim($custom_field_1_value);
            $mapping = Mapping::where('from_name', $pr)->pluck('to_id')->toArray();
            if (!empty($mapping)) {
              // return $mapping;
              $pr_id = $mapping[0] ?? $mapping;

              $order_array['ticketprtype_id'] = $pr_id;
            } else {
              $ticketprtypes = Ticketprtype::all()->toArray();
              // return "unmapped ticketprtype: " . $pr;
              return view('mappings.prtypes', Compact('pr', 'ticketprtypes'));

            }
            // $order_array['ticketprtype_id']=mapTicketPRTypeID($pr);
            // $order_array['ticketprtype_name']=$pr;
            // if ($order_array['ticketprtype_id']==10){
            //     return "unmapped ticketprtype: " . $pr;
            //   }
          }

          //newsletter
          elseif (
            strpos(
              $custom_field_1_name,
              'newsletter'
            ) !== false
            ||
            strpos(
              $custom_field_1_name,
              'Newsletter'
            ) !== false
          ) {
            $newsletter = trim($custom_field_1_value);
            if (strpos($newsletter, "Yes") !== false) {
              $newsletter = "Yes";
            } else {
              $newsletter = "";
            }
            $order_array['newsletter'] = $newsletter;
          }

        }

        // parse custom field 2

        if (!empty($order['custom_fields']['custom_field'][1]['value'])) {

          $custom_field_2_name = $order['custom_fields']['custom_field'][1]['name'];
          $custom_field_2_value = $order['custom_fields']['custom_field'][1]['value'];
          $order_array['question_2'] = $custom_field_2_name;
          $order_array['answer_2'] = $custom_field_2_value;

          //pr
          if (strpos($custom_field_2_name, 'How ') !== false) {
            $pr = (string) trim($custom_field_2_value);
            $mapping = Mapping::where('from_name', '=', $pr)->pluck('to_id')->toArray();
            // $mapping = DB::table('mappings')->where('from', '=', 'On Facbeook')->get();
            // return array ($mapping,$pr);
            if (!empty($mapping)) {
              // return $mapping;
              $pr_id = $mapping[0] ?? $mapping;
              $order_array['ticketprtype_id'] = (int) $pr_id;
            } else {
              $ticketprtypes = Ticketprtype::all()->toArray();
              // return "unmapped ticketprtype: " . $pr;
              return view('mappings.prtypes', Compact('pr', 'ticketprtypes'));
            }

            // $order_array['ticketprtype_id']=mapTicketPRTypeID($pr);
            // $order_array['ticketprtype_name']=$pr;
            // if ($order_array['ticketprtype_id']==10){
            //     return "unmapped ticketprtype: " . $pr;
            //   }
          }

          //newsletter
          elseif (strpos($custom_field_2_name, ' newsletter') !== false) {
            $newsletter = trim($custom_field_2_value);
            if (strpos($newsletter, "Yes") !== false) {
              $newsletter = "Yes";
            } else {
              $newsletter = "";
            }
            $order_array['newsletter'] = $newsletter;
          }

        }


        //store values for each ticket nested in orders
        foreach ($ticketarray as $ticket) {
          $ticket_array = array();
          $ticket_array['purchase_id'] = $purchase_id;
          $ticket_array['id'] = $ticket['id'];
          $ticket_array['price'] = $ticket['price'] / 100;
          $ticket_array['tickettype_id'] = mapTicketTypeID($ticket['type']);
          if ($ticket_array['tickettype_id'] == 8) {
            return "unmapped tickettype: " . $ticket['type'];
            // $ticket_array['tickettype_name']=$ticket['type'];
          }
          // $ticket_array['credited']=$ticket['credited'];
          if ($ticket['credited'] != 'true') {
            $order_array['tickets'][] = $ticket_array;
          }
        }
        if (isset($order_array['tickets'])) {
          $output[] = $order_array;
        }

      }
      // uncomment here to return json of orders for first event in array
      // return $output;
    }

    // uncomment here to return json of orders for all events in array
    // return $output;

    foreach ($output as $order) {

      $save_order = Ticketorder::updateOrCreate(
        ['id' => $order['id']],
        [
          'event_id' => $order['event_id'],
          'ticketprtype_id' => $order['ticketprtype_id'],
          'newsletter' => $order['newsletter'],
          'customer_name' => $order['customer_name'] ?: '',
          'customer_mail' => $order['customer_mail'] ?: '',
          'purchase_timestamp' => $order['purchase_timestamp'],
        ]
      );

      // uncomment here to return json of first saved order
      // return $save_order;

      foreach ($order['tickets'] as $ticket) {
        $save_ticket = Ticket::updateOrCreate(
          ['id' => $ticket['id']],
          [
            'ticketorder_id' => $ticket['purchase_id'],
            'price' => $ticket['price'],
            'tickettype_id' => $ticket['tickettype_id'],
          ]
        );

        // uncomment here to return json of first saved ticket
        // return $save_ticket;

      }



    }

    // return $output;
    return "import complete";
  }

}