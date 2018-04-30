@extends('layouts.app')

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-1">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Handbooks</li>
          </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="card light-transparency">

                    <div class="card-body">

                      <p class="lead">Please map the following PR Type definition:</p>

                      <form action="/mappings" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="url" value="{{url()->current()}}">
                        <input type="hidden" name="from" value="{{$pr}}">
                        <div class="form-group">
                          <label for="mapping">{{$pr}}</label>
                          <select class="form-control" id="mapping" name="to">
                            @foreach ($ticketprtypes as $ticketprtype)
                              <option value="{{$ticketprtype['id']}}">{{$ticketprtype['name']}}</option>
                            @endforeach
                          </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
