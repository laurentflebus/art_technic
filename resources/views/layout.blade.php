<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Art Technic</title>
        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        
    </head>
    <body>
        <div class="container-fluid">
            <div class="container">
                {{-- directive yield --}}
                @yield('contenu') 
            </div> 
        </div>   
    </body>
</html>
            