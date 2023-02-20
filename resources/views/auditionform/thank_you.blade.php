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
    <div class="container mt-4" style="max-width: 600px;">
        <div class="row mb-3">
            <div class="col alert alert-info">
                Thank you for your interest. We have sent a complete audition form to your mail address. It should
                arrive within the next 5 minutes. If you don't receive a mail, please check your spam folder or contact
                {{ $auditionFormVariables['reply_to_address'] }} so we can send you the full form manually.
            </div>
        </div>
    </div>
</body>

</html>
