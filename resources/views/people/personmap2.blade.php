<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CTC Hall of Fame</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vue-slider-component@latest/theme/default.css">
    <script src="https://cdn.jsdelivr.net/npm/vue-slider-component@latest/dist/vue-slider-component.umd.min.js"></script>
    <style>
        p {
            display: inline;
        }
        a {
            color: #666;
            text-decoration: none;
            transition: 1s;
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
          <div class="columns">
            <div class="column is-narrow">
              <vue-slider
                ref="slider"
                v-model="value"
                v-bind="options"
              ></vue-slider>
            </div>
            <div class="column">
              <h1 class="title">@{{value}}</h1>
                  <a
                    {{-- :style="'font-size: ' + person.fontsize + 'px !important'" --}}
                    style="font-size: 24px; margin-right: 20px;"
                    :href="'/person/' + person.id "
                    v-for="person in people"
                    v-if="person.years.includes(value)"
                    >
                  @{{person.name}}
                  </a>
            </div>
          </div>
        </div>
      </section>
    </div>
  <script type="text/javascript">
    var app = new Vue({
      el: '#app',
      data: {
        people: {!!json_encode($people)!!},
        value: 1969,
        options: {
                dotSize: 14,
                width: 4,
                height: 600,
                direction: 'ttb',
                data: null,
                min: 1969,
                max: 2019,
                interval: 1,
                disabled: false,
                clickable: true,
                duration: 0.5,
                adsorb: false,
                lazy: false,
                tooltip: 'focus',
                tooltipPlacement: 'top',
                tooltipFormatter: void 0,
                useKeyboard: false,
                enableCross: true,
                fixed: false,
                minRange: void 0,
                maxRange: void 0,
                order: true,
                marks: false,
                dotOptions: void 0,
                process: true,
                dotStyle: void 0,
                railStyle: void 0,
                processStyle: void 0,
                tooltipStyle: void 0,
                stepStyle: void 0,
                stepActiveStyle: void 0,
                labelStyle: void 0,
                labelActiveStyle: void 0,
              }
          }
          ,
          methods: {
          },
          mounted () {
          },
          components: {
            'vueSlider': window[ 'vue-slider-component' ],
          },
        }
      )
  </script>
  </body>
</html>
