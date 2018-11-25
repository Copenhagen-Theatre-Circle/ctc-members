<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CTC Members</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #fff;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                padding: 20px;
            }

            .title {
                font-size: 72px;
            }

            .links > a {
                color: #fff;
                padding: 0 25px;
                font-size: 16px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            a {
              color: #fff;
              letter-spacing: .1rem;
              text-decoration: underline;
            }

            .links > a:hover {
                text-decoration: underline;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .lead {
              font-size: 24px;
            }
        </style>
    </head>
    <body style="background-color: black; background: linear-gradient( rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4) ), url('/media/smoky-theatre.jpg') no-repeat center center fixed; background-size: cover;">
        <div class="flex-center position-ref full-height" style="max-width: 850px; margin-left: auto; margin-right: auto;">

            <div class="content">
              <img src="/media/logo_dark.png" style="display: inline; width: 120px;"/>
              <br/><br/>
                <div class="title m-b-md">
                    almost there...
                </div>
                <div class="lead">
                    <p>
                        Unfortunately, our records don't show that you have paid your membership fee for the {{$season->year_start}}/{{$season->year_start+1}} season with the registered email address.
                    </p>
                    <p>
                        Please pay your membership fee
                        <a href="https://place2book.com/en/choose_ticket_sales_workflow?seccode={{$season->seccode}}" target="_blank">here</a>
                        and try to refresh this page.
                    </p>
                    <p>
                        Or contact
                        <a href="mailto:membership@ctcircle.dk(CTC Membership)">
                            membership@ctcircle.dk
                        </a>
                        if you have paid and need help to access the members' section.
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
