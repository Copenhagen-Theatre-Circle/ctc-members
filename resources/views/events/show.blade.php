@extends('layouts.app')

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-1">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/ticketsales/{{$output['project_id']}}">Ticket Sales: {{$output['project']}}</a></li>
            <li class="breadcrumb-item active">{{$output['date']}} {{$output['time']}}</li>
          </ol>
        </nav>

        <div class="row scrollbox">
            <div class="col-md-12 col-md-offset-0">
                <div class="card light-transparency">


                    <div class="card-body">

                      {{-- {{dd($output)}} --}}

                        <table class="table table-striped">

                            <tr>
                                <th>Client</th>
                                <th>Nr of Tickets</th>
                                <th>Sum</th>
                                <th>Purchased</th>
                                <th>Heard About Us</th>
                                <th></th>
                            </tr>

                            @foreach ($output['tickets'] as $sale)
                                <tr>
                                    <td class="pt-3">
                                        {{$sale['name']}}
                                    </td>
                                    <td>{{$sale['tickets_sold']}}</td>
                                    <td>{{$sale['sum']}}</td>
                                    <td>{{$sale['created_at']}}</td>
                                    <td>{{$sale['pr']}}</td>
                                    {{-- <td>{{date ('d M Y H:i', strtotime($sale['created_at']))}}</td> --}}
                                    {{-- <td>{{$sale['custom_fields']['custom_field'][1]['value']}}</td> --}}
                                </tr>
                            @endforeach

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
