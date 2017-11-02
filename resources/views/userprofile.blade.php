@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="row center-vertically">
        <div class="col-xs-12 col-lg-6">
            <div class="card">
                <div class="card-header">

                  Edit your Profile

                </div>

                <div class="card-body" style="overflow: scroll;">

                <p>Soon you will be able to edit your profile here, but until this page is ready, you can change what is displayed about you on the membership list by editing your answers in your personalised questionnaire:</p>

                <div class="d-flex justify-content-center">
                  <a class="btn btn-danger" href="https://ctc-members.dk/questionnaire/?p={{$user->uniqid()}}" target="_blank">
                  Edit Your Personal Questionnaire <br/>(opens in new window)
                  </a>
                </div>


                </div>
            </div>
        </div>
    </div>
</div>

<script   src="https://code.jquery.com/jquery-3.2.1.js"   integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>
<script type="text/javascript">

$('body').on('click', '[data-toggle="modal"]', function(){
  // alert ('Hello World!');
  $($(this).data("target")+' .modal-body').load($(this).attr('href'));
});



</script>
@endsection
