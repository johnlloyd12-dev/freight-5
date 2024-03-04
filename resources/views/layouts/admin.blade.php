<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
    <link rel='stylesheet' href='/assets/css/style.css'>
    <link href='/assets/css/bootstrap.min.css' rel= 'stylesheet'>
    <link href='/assets/css/custom.css' rel= 'stylesheet'>
   
   
    @livewireStyles
</head>
<body>
<div class="content">
    @include('layouts.inc.admin.navbar')
    

<div class="container-fluid page-body-wrapper">
    @include('layouts.inc.admin.sidebar')
    <div class="main-panel">
    <div class="content-wrapper">
    @yield('content')
    </div>
    
</div>

</div>
</div>

<script src='/assets/js/index.js'></script>
<script src='/assets/js/jquery-3.7.1.min.js'></script>
    <script src='/assets/js/bootstrap.bundle.min.js'></script>

    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
<script src='https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
    
<script src='https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js'></script>

{{-- <script>
    // Print the displayed PDF
    window.print();
</script> --}}
@livewireScripts
</body>
</html>






