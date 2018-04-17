<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

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
      $array['total_child'] = 0;
      $array['total_group_10_to_19'] = 0;
      $array['total_group_20_or_more'] = 0;
      $array['total_membership_adult'] = 0;
      $array['total_membership_child'] = 0;
      $array['total_comp'] = 0;

      $project = \App\Project::where('id',$id)->first();
      $array['project'] = $project['name'];

      foreach ($events as $event) {
        $subarray['id']=$event['id'];
        $subarray['date']=$event['date'];
        $subarray['time']=$event['time'];
        $seccode=$event['place2book_seccode'];
        $subarray['seccode']=$seccode;
        $orders = place2bookShowStats ($seccode);
        $orders_array = json_decode($orders, TRUE);

        $orders_array = $orders_array['event']['tickets']['ticket'];
        //wrap in array if only one value
        if (isset($orders_array['name'])){
          $extended_array = array();
          $extended_array[0]=$orders_array;
          $orders_array = $extended_array;
        }
        // return $orders_array;
        //initialise ticket amounts
        $subarray['sold'] = 0;

        if (isset($orders_array[0]['available'])){
          $available = (int)$orders_array[0]['available'];
        } else {
          $available = (int)$orders_array['available'];
        }
        $subarray['available'] = $available;
        $subarray['standard'] = 0;
        $subarray['child'] = 0;
        $subarray['group_10_to_19'] = 0;
        $subarray['group_20_or_more'] = 0;
        $subarray['membership_adult'] = 0;
        $subarray['membership_child'] = 0;
        $subarray['comp'] = 0;

        $array['total_available'] += $available;

        //map each ticket type and add to sum
        foreach ($orders_array as $orders_detail) {

          $tickettype = $orders_detail['name'];
          $sold = $orders_detail['sold'];
          $subarray['sold'] += $sold;
          $array['total_sold'] += $sold;

          switch ($tickettype) {
            //standard tickets
            case 'Standard (reserved)';
            case 'Standard';
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
              $tickettype = "group_10_to_19";
              break;
            //group 20+
            case 'Group 20+';
            case 'Group 20+ (reserved)';
            case 'Extra group tickets (over 20)';
              $tickettype = "group_20_or_more";
              break;
            //membership
            case 'Membership Ticket';
              $tickettype = "membership_adult";
              break;
            //membership child
            case 'Membership Ticket (child)';
            case 'Membership ticket (child)';
              $tickettype = "membership_child";
              break;
            //membership child
            case 'Complimentary';
              $tickettype = "comp";
              break;
            //default: list ticket type
            default;
              $tickettype = $tickettype;
              break;
          }

          $subarray[$tickettype] = $subarray[$tickettype] ?? 0;
          $subarray[$tickettype] += $sold;
          $array['total_' . $tickettype] += $sold;

        }

        $array['events'][]=$subarray;
      }
      $output = $array;
      // return $output;
      return view ('ticketsales.show', Compact('output'));

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
}
