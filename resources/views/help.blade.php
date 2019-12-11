<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CTC directors and writers</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body>
  <section class="section">
    <div class="container">
        <div class="select">
          <form action="/help">
            <select name="function" onchange="this.form.submit()">
              @foreach($functions as $function)
                <option value="{{$function->slug}}" @if($function->id == $function_id)selected @endif >{{$function->questionnaire_name}}</option>
              @endforeach
            </select>
          </form>
          </div>
          <br><br>
      <table class="table">
        <thead>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Email</th>
          <th>Experience</th>
          <th>Questionnaire completed</th>
        </thead>

        @foreach($array as $person)
        
        <tr>
          <td>
            {{$person['last_name']}}
          </td>
          <td>
            {{$person['first_name']}}
          </td>
          <td>
            {{$person['email']}}
          </td>
          <td>
            {{$person['experience']??''}}
          </td>
          <td>
            {{$person['last_answered']??''}}
          </td>
  
        </tr>
        
        @endforeach
  
      </table>
    </div>
  </section>
  </body>
</html>