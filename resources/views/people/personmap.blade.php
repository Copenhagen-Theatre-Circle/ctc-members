<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CTC Hall of Fame</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <style>
        p {
            display: inline;
        }
        a {
            color: #666;
            text-decoration: none;
        }
        a:hover {
            transform: scale(1.5);
        }
    </style>
  </head>
  <body>
  <section class="section">
    <div class="container">
        @foreach($people as $person)
          <a style="font-size: {{($person['count']/$max)*48+12}}px !important" href="/person/{{$person['id']}}">{{$person['name']}}</a>
        @endforeach
    </div>
  </section>
  </body>
</html>

<html>
<head>

</head>
<body>

</body>
</html>
