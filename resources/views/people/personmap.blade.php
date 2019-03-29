<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CTC Hall of Fame</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
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
    <div id="app">
      <section class="section">
        <div class="container">
              <a
                :style="'font-size: ' + person.fontsize + 'px !important'"
                :href="'/person/' + person.id "
                v-for="person in people"
                >
              @{{person.name}}
              </a>
        </div>
      </section>
    </div>
  <script type="text/javascript">
    var app = new Vue({
      el: '#app',
      data: {
        people: {!!json_encode($people)!!}
      }
    })
  </script>
  </body>
</html>
