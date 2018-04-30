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

                        <p class="lead">We are in the process of building an interactive version of the production and committee handbooks.</p><p class="lead"> Meanwhile, you can download a pdf of the draft versions of them here:</p>



                        {{-- <div class="container py-3"> --}}
                            <div class="row">
                                <div class="col-xs-12 col-lg-6 mx-auto">
                                    <div class="card">
                                        <div class="card-header">

                                          CTC Production Handbook (Draft Version)

                                        </div>

                                        <div class="card-body" style="overflow: scroll;">


                                        <div class="d-flex justify-content-center">
                                          <a class="btn btn-danger" href="https://ctc-members.dk/media/CTC_Production_Handbook.pdf" target="_blank">
                                          Open pdf of Production Handbook <br/>(opens in new window)
                                          </a>
                                        </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-6 mx-auto">
                                    <div class="card">
                                        <div class="card-header">

                                          CTC Committee Handbook (Draft Version)

                                        </div>

                                        <div class="card-body" style="overflow: scroll;">


                                        <div class="d-flex justify-content-center">
                                          <a class="btn btn-danger" href="https://ctc-members.dk/media/CTC_Committee_Handbook.pdf" target="_blank">
                                          Open pdf of Committee Handbook<br/>(opens in new window)
                                          </a>
                                        </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- </div> --}}



                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
