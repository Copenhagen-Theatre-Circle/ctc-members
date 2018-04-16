@extends('layouts.app')

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-1">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Ticket Sales: {{$output['project']}}</li>
          </ol>
        </nav>

        <div class="row scrollbox">
            <div class="col-md-12 col-md-offset-0">
                <div class="card">


                    <div class="card-body">
                      <div class="card-header">
                        <h2>Ticket Sales: {{$output['project']}}</h2>
                        <hr>
                        <div class="col-xl-4 col-lg-6 col-md-6 pl-0">
                          <div class="row">
                            <div class="col">
                              <p class="lead mb-1">Performances:</p>
                              <p class="lead mb-1">Tickets sold:</p>
                              <p class="lead mb-1">% sold:</p>
                            </div>
                            <div class="col">
                              <p class="lead mb-1">
                                {{ count($output['events']) }}
                              </p>
                              <p class="lead mb-1">
                                {{ $output['total_sold'] }} <br>
                              </p>
                              <p class="lead mb-1">
                                {{ number_format ( $output['total_sold'] / ( $output['total_sold'] + $output['total_available'] )  * 100 , 2, '.', '') }}%
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="mt-4" id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                      <hr>
                      <table class="table table-striped table-bordered rounded">
                          <thead class="thead-dark">
                            <tr>
                                <th rowspan="2">Date</th>
                                <th rowspan="2">Time</th>
                                <th rowspan="2">Sold</th>
                                <th rowspan="2">Available</th>
                                <th colspan="7" class="border-bottom-0">Breakdown by Ticket Types</th>
                                @if (user_is_admin_or_superuser())
                                  <th rowspan="2"></th>
                                @endif
                            </tr>
                            <tr>
                                <th>Standard</th>
                                <th>Child</th>
                                <th>Group<br>10 to 19</th>
                                <th>Group<br>20+</th>
                                <th>Member<br>Adult</th>
                                <th>Member<br>Child</th>
                                <th>Comps</th>
                            </tr>
                          </thead>

                          @foreach ($output['events'] as $event)
                              <tr>
                                  <td>{{ date('d M Y', strtotime($event['date']))}}</td>
                                  <td>{{ date('H:i', strtotime($event['time']))}}</td>
                                  <td>{{ $event['sold'] }}</td>
                                  <td>{{ $event['available'] }}</td>
                                  <td>{{ $event['standard'] }}</td>
                                  <td>{{ $event['child'] }}</td>
                                  <td>{{ $event['group_10_to_19'] }}</td>
                                  <td>{{ $event['group_20_or_more'] }}</td>
                                  <td>{{ $event['membership_adult'] }}</td>
                                  <td>{{ $event['membership_child'] }}</td>
                                  <td>{{ $event['comp'] }}</td>
                                  @if (user_is_admin_or_superuser())
                                    <td>
                                      <a href="/events/{{$event['id']}}" class="btn btn-outline-primary btn-sm">Details</a>
                                    </td>
                                  @endif
                              </tr>
                          @endforeach
                            <tr>
                                <td colspan="2">Total:</td>
                                <td><strong>{{$output['total_sold']}}</strong></td>
                                <td><strong>{{$output['total_available']}}</strong></td>
                                <td>{{$output['total_standard']}}</td>
                                <td>{{$output['total_child']}}</td>
                                <td>{{$output['total_group_10_to_19']}}</td>
                                <td>{{$output['total_group_20_or_more']}}</td>
                                <td>{{$output['total_membership_adult']}}</td>
                                <td>{{$output['total_membership_child']}}</td>
                                <td>{{$output['total_comp']}}</td>
                                <td></td>
                            </tr>
                            @if (user_is_admin_or_superuser())
                                <tr>
                                    <td colspan="2">Total Revenues:</td>
                                    <td></strong></td>
                                    <td></strong></td>
                                    <td>{{$output['total_standard']*140}} kr</td>
                                    <td>{{$output['total_child']*70}} kr</td>
                                    <td>{{$output['total_group_10_to_19']*125}} kr</td>
                                    <td>{{$output['total_group_20_or_more']*110}} kr</td>
                                    <td>{{$output['total_membership_adult']*110}} kr</td>
                                    <td>{{$output['total_membership_child']*55}} kr</td>
                                    <td>0</td>
                                    <td>{{
                                        $output['total_standard']*140
                                        + $output['total_child']*70
                                        + $output['total_group_10_to_19']*125
                                        + $output['total_group_20_or_more']*110
                                        + $output['total_membership_adult']*110
                                        + $output['total_membership_child']*55
                                    }} kr</td>
                                </tr>
                            @endif


                      </table>



                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script>


Highcharts.chart('container2', {
chart: {
  type: 'column'
},
title: {
  text: ''
},
xAxis: {
  categories: [
    @foreach ($output['events'] as $event)
    '{{ date('D d M', strtotime($event['date']))}} {{ date('ga', strtotime($event['time']))}}',
    @endforeach
    'all performances'
  ],
},
yAxis: {
  min: 0,
  title: {
      text: '% tickets sold'
  },
  tickInterval: 25
},
credits: {
  enabled: false
  },
exporting: {
  enabled: false
  },
tooltip: {
  pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
  shared: true
},
plotOptions: {
  column: {
      stacking: 'percent'

  }
},
series: [{
  name: 'available',
  showInLegend: false,
  color: '#888',
  data: [
    @foreach ($output['events'] as $event)
    {{ $event['available'] }},
    @endforeach
    {{$output['total_available']}}
  ]
}, {
  name: 'sold',
  showInLegend: false,
  data: [
    @foreach ($output['events'] as $event)
    {{ $event['sold'] }},
    @endforeach
    {{$output['total_sold']}}
  ],
  zones: [{
      value: 21, // Values up to 10 (not including) ...
      color: 'red' // ... have the color blue.
  },{
      value: 42,
      color: 'orange' // Values from 10 (including) and up have the color red
  },{
      value: 63,
      color: 'lightgreen' // Values from 10 (including) and up have the color red
  },{
      value: 86,
      color: 'darkgreen' // Values from 10 (including) and up have the color red
  },{
      value: 255,
      color: 'red' // Values from 10 (including) and up have the color red
  },{
      value: 510,
      color: 'orange' // Values from 10 (including) and up have the color red
  },{
      value: 765,
      color: 'lightgreen' // Values from 10 (including) and up have the color red
  },{
      color: 'darkgreen' // Values from 10 (including) and up have the color red
  }]
}]
});

  </script>
@endsection
