<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$person->first_name}} {{$person->last_name}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body style="background-color:lightgrey;">
  <section class="section" >
    <div class="container section" style="max-width: 850px; background-color:white;">
        <h1 class="title is-1">
            {{$person->first_name}} {{$person->last_name}}
        </h1>

        <br>
        @if(!empty($person->obituary))
            <h2 class="title is-2">
                Obituary
            </h2>
            <div class="content is-medium">
                <p class="lead">{!! nl2br(e($person->obituary)) !!}</p>
            </div>
            <hr>
        @endif
        <div class="content is-medium">
            <h2 class="title is-2">
                Member Testimonials
            </h2>
            @foreach ($tributes as $tribute)
                <p>{!! nl2br(e($tribute->text)) !!}</p>
                <p class="is-italic">{{trim($tribute->tribute_from->first_name . ' ' . $tribute->tribute_from->last_name) ?? $tribute->name}}</p>
                <hr>
            @endforeach
        </div>
    </div>
  </section>
  </body>
</html>
