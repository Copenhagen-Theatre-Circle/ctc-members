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
                                <th colspan="8" class="border-bottom-0">Breakdown by Ticket Types</th>
                                @if (user_is_admin_or_superuser())
                                  <th rowspan="2"></th>
                                @endif
                            </tr>
                            <tr>
                                <th>Standard</th>
                                <th>Early Bird</th>
                                <th>Student</th>
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
                                  <td>{{ $event['early_bird'] }}</td>
                                  <td>{{ $event['student'] }}</td>
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
                                <td>{{$output['total_early_bird']}}</td>
                                <td>{{$output['total_student']}}</td>
                                <td>{{$output['total_child']}}</td>
                                <td>{{$output['total_group_10_to_19']}}</td>
                                <td>{{$output['total_group_20_or_more']}}</td>
                                <td>{{$output['total_membership_adult']}}</td>
                                <td>{{$output['total_membership_child']}}</td>
                                <td>{{$output['total_comp']}}</td>
                                <td></td>
                            </tr>
                            @if (user_is_admin_or_superuser() and $output['project_id']==89)
                                <tr>
                                    <td colspan="2">Total Revenues:</td>
                                    <td colspan="2">
                                        <strong>
                                        {{
                                        $output['total_standard']*140
                                        + $output['total_child']*70
                                        + $output['total_group_10_to_19']*125
                                        + $output['total_group_20_or_more']*110
                                        + $output['total_membership_adult']*110
                                        + $output['total_membership_child']*55
                                        }} kr
                                        </strong>
                                    </td>
                                    <td>{{$output['total_standard']*140}} kr</td>
                                    <td>{{$output['total_child']*70}} kr</td>
                                    <td>{{$output['total_group_10_to_19']*125}} kr</td>
                                    <td>{{$output['total_group_20_or_more']*110}} kr</td>
                                    <td>{{$output['total_membership_adult']*110}} kr</td>
                                    <td>{{$output['total_membership_child']*55}} kr</td>
                                    <td>0 kr</td>
                                    <td></td>
                                </tr>
                            @endif
                            @if (user_is_admin_or_superuser() and $output['project_id']==93)
                                <tr>
                                    <td colspan="2">Total Revenues:</td>
                                    <td colspan="2">
                                        <strong>
                                        {{
                                        $output['total_standard']*220
                                        + $output['total_vip']*220
                                        + $output['total_group_10_to_19']*200
                                        + $output['total_group_20_or_more']*175
                                        + $output['total_membership_adult']*175
                                        }} kr
                                        </strong>
                                    </td>
                                    <td>{{$output['total_standard']*220}} kr</td>
                                    <td>{{$output['total_vip']*220}} kr</td>
                                    <td></td>
                                    <td>{{$output['total_group_10_to_19']*200}} kr</td>
                                    <td>{{$output['total_group_20_or_more']*175}} kr</td>
                                    <td>{{$output['total_membership_adult']*175}} kr</td>
                                    <td></td>
                                    <td>0 kr</td>
                                    <td></td>
                                </tr>
                            @endif
                            @if (user_is_admin_or_superuser() and $output['project_id']==92)
                                <tr>
                                    <td colspan="2">Total Revenues:</td>
                                    <td colspan="2">
                                        <strong>
                                        {{
                                        $output['total_standard']*85
                                        + $output['total_child']*70
                                        + $output['total_group_10_to_19']*125
                                        + $output['total_group_20_or_more']*110
                                        + $output['total_membership_adult']*110
                                        + $output['total_membership_child']*55
                                        }} kr
                                        </strong>
                                    </td>
                                    <td>{{$output['total_standard']*85}} kr</td>
                                    <td>{{$output['total_child']*70}} kr</td>
                                    <td>{{$output['total_group_10_to_19']*125}} kr</td>
                                    <td>{{$output['total_group_20_or_more']*110}} kr</td>
                                    <td>{{$output['total_membership_adult']*110}} kr</td>
                                    <td>{{$output['total_membership_child']*55}} kr</td>
                                    <td>0 kr</td>
                                    <td></td>
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

// capacity per show is the sum of available and sold tickets for that show
// for simplicity, we take the average (the sum of total available and sold divided by number of shows)
var capacity= {{ $output['total_available'] + $output['total_sold'] }} / {{ count($output['events']) }};
var shows=5;
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
      @if($event['id'] == 275)
        0,
      @else
        {{ $event['available'] }},
      @endif
    @endforeach
    {{$output['total_available']}}
  ]
}, {
  name: 'sold',
  showInLegend: false,
  data: [
    @foreach ($output['events'] as $event)

      @if($event['id'] == 275)
        85,
      @else
        {{ $event['sold'] }},
      @endif

    @endforeach
    {{$output['total_sold']}}
  ],
  zones: [{
      value: capacity/4, // Values up to 1/4 capacity ...
      color: 'red' // ... have the color red.
  },{
      value: capacity/2, // Values up to 1/2 capacity ...
      color: 'orange' // ... have the color orange.
  },{
      value: capacity/(3/4),
      color: 'lightgreen'
  },{
      value: capacity,
      color: 'darkgreen'
  },{
      value: capacity + 1,
      color: '#D4AF37'
  },{
      value: capacity*shows/4,
      color: 'red'
  },{
      value: capacity*shows/2,
      color: 'orange'
  },{
      value: capacity*shows/(3/4),
      color: 'lightgreen'
  },{
      color: 'darkgreen'
  }]
}]
});

  </script>
@endsection
