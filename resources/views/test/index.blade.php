@extends('layouts.app')

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-1">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Ticket Sales</li>
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
                                <th>Purchased</th>
                                <th></th>
                            </tr>

                            @foreach ($output as $sale)
                                <tr>
                                    <td class="pt-3">
                                        {{$sale['customer']['name']}}
                                    </td>
                                    <td>{{count($sale['tickets']['ticket'])}}</td>
                                    <td>{{date ('d M Y H:i', strtotime($sale['created_at']))}}</td>
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
