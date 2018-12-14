<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- CSRF Token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Styles --}}
<link href="{{ asset('css/bulma_app.css') }}" rel="stylesheet">
{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

{{-- TO DO: transfer to scss file under assets --}}
<link href="{{ asset('css/master_bulma.css') }}" rel="stylesheet">


{{-- TO DO: bundle this in webpack? --}}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<link href="/css/dropzone.css" rel="stylesheet">

{{-- TO DO: put this into css file ! --}}
<style type="text/css">
    [v-cloak] {
      display: none !important;
    }
</style>

<!-- Head-level scripts -->
<!-- TO DO: refactor by taking scripts out of content and into scripts section, so that they follow -->
<script src="https://code.jquery.com/jquery-3.2.1.js"   integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>

{{-- select2.js --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
