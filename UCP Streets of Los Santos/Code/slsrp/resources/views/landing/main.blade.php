<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add a description here -->
    <meta name="description" content="{{$description}}">
    <meta name="keywords" content="{{$keywords}}">
    <meta name="robots" content="index,follow">
    <!-- Icon stuff -->
    <link rel="icon" sizes="196x196" href="icons/icon196.png">
    <link rel="icon" sizes="128x128" href="icons/icon128.png">
    <link rel="apple-touch-icon" sizes="128x128" href="icons/icon128.png">
    <link rel="apple-touch-icon-precomposed" sizes="128x128" href="icons/icon128.png">
    <link rel="apple-touch-startup-image" href="icons/icon196.png">
    <link rel="shortcut-icon" href="icons/favicon.ico">
    <link rel="icon" type="image/png" href="icons/favicon.png" sizes="32x32">
    
    
    <head>
        <!-- HTML5 shim and respond.js for IE8 and below support. -->
        <!--[if lt IE 9]>
            <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script>window.html5 || document.write('<script src="html5shiv/dist/html5shiv.min.js"><\/script>')</script>
            <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        @include('landing.stylesheets')
              
        <!-- Personal code for header here -->
        <title>{{$title}}</title>
        
    </head>
    <body>
        <!-- Inform user of outdated browsers -->
        @include('outdated_browser')
        
        
        <!-- container -->
        <div class="container">
            @yield('content')
        <!-- end of container -->
        </div>
        
        
        
        <!-- All scripts go below this point to allow the page to load fully before scripts are loaded. -->
        @include('landing.scripts')
    </body>
</html>