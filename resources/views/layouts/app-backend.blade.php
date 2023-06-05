<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @extends('layouts.css')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    
    @include('tampilan.navigation')
    @include('tampilan.sidebar')
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    @include('tampilan.footer')
    </div>
    @extends('layouts.js')
</body>
</html>

<!-- <script>
    document.onkeydown = function(e) {
    if(event.keyCode == 123) {
    return false;
    }
    if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){
    return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
    return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
    return false;
    }
    if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
    return false;
    }
    if(e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)){
    return false;
    }
    if(e.ctrlKey && e.keyCode == 'H'.charCodeAt(0)){
    return false;
    }
    if(e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)){
    return false;
    }
    if(e.ctrlKey && e.keyCode == 'F'.charCodeAt(0)){
    return false;
    }
    if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){
    return false;
    }
    }
</script> -->
    
<!-- <script type="text/javascript">
        //Script for disabling right click on mouse
        var message="Function Disabled!";
        function clickdsb(){
        if (event.button==2){
        alert(message);
        return false;
        }
        }
        function clickbsb(e){
        if (document.layers||document.getElementById&&!document.all){
        if (e.which==2||e.which==3){
        alert(message);
        return false;
        }
        }
        }
        if (document.layers){
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown=clickbsb;
        }
        else if (document.all&&!document.getElementById){
        document.onmousedown=clickdsb;
        }
        
        document.oncontextmenu=new Function("alert(message);return false")
 </script> -->
