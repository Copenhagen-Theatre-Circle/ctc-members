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

                      <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>


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
  text: 'Ticket Sales {{$output['project']}}'
},
xAxis: {
  categories: [
    @foreach ($output['events'] as $event)
    '{{ date('d M Y', strtotime($event['date']))}} {{ date('H:i', strtotime($event['time']))}}',
    @endforeach
  ]
},
yAxis: {
  min: 0,
  title: {
      text: '% tickets sold'
  }
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
  data: [
    @foreach ($output['events'] as $event)
    {{ $event['available'] }},
    @endforeach
  ]
}, {
  name: 'sold',
  data: [@foreach ($output['events'] as $event)
  {{ $event['sold'] }},
  @endforeach]
}]
});

  </script>
@endsection
