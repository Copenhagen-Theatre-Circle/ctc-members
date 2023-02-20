<!DOCTYPE html>
<html lang="en">

<head>
    <title>CTC Audition Form</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
        integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>


<body>

    <!--Banner -->


    <!--
    <div class="fluid-container" style="background-color: black;" >
      <div class="bg-dark  mx-auto" style="max-width: 1600px;">
          <img class="img-fluid" src="media/cabaret.jpg" style="width: 100%;">
      </div>
    </div>
-->
    <div class="fluid-container" style="background-color: {{ $auditionFormVariables['banner_background_color'] }};">
        <div class="mx-auto" style="max-width: {{ $auditionFormVariables['banner_max_width_px'] }}px;">
            <img class="img-fluid" src="media/{{ $auditionFormVariables['banner_filename'] }}" style="width: 100%;">
        </div>

    </div>

    <div class="container mt-3" style="max-width: 600px;">
        <div class="row">
            <div class="col">

                <h1 class="display-4">Audition Form</h1>
                <h3 class="mt-2">Performance dates:<br />{{ $auditionFormVariables['performance_dates'] }}</h3>
            </div>

        </div>
    </div>

    <form class="container" style="max-width: 600px;" method="post" action="audition_pre" enctype="multipart/form-data"
        id="needs-validation" novalidate>

        {{ csrf_field() }}
        <br />

        <div class="row mb-3">
            <div class="col">
                <p class="lead">Please enter your full name and mail address below, and we'll send you a complete
                    audition form to your email address.</p>
            </div>

        </div>

        <div class="row">
            <div class="form-group col">
                <label for="first_name">First Name</label>
                <input name="first_name" type="text" class="form-control" id="first_name" placeholder="first name"
                    required>
                <div class="invalid-feedback">
                    Please provide a first name.
                </div>
            </div>
        </div>


        <div class="row">
            <div class="form-group col">
                <label for="last_name">Last Name</label>
                <input name="last_name" type="text" class="form-control" id="last_name" placeholder="last name"
                    required>
                <div class="invalid-feedback">
                    Please provide a last name.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col mb-3">
                <label for="mail">Email</label>
                <input name="email" type="email" class="form-control" id="mail" placeholder="email" required>
                <div class="invalid-feedback">
                    Please provide a mail address where we can send the form.
                </div>
            </div>
        </div>

        <br />

        <input type="hidden" name="project_id" value="{{ $projectId }}">
        <button type="submit" class="btn btn-danger btn-lg">Send Me the Full Form</button>

        <br />

        <br />


    </form>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous">
    </script>

    <!-- Optional JavaScript -->
    <script>
        $(function() {
            $('[data-toggle="popover"]').popover()
        })
        $('.popover-dismiss').popover({
            trigger: 'focus'
        })
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });
    </script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';

            window.addEventListener('load', function() {
                var form = document.getElementById('needs-validation');
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            }, false);
        })();
    </script>

</body>

</html>
