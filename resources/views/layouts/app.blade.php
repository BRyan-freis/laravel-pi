<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Minha Aplicação</title>
     <style>
        /* Reset Universal para remover margens e garantir o layout correto */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            /* !important força esta regra a ter a prioridade máxima, 
               sobrescrevendo qualquer outra que esteja causando o problema. */
            margin: 0 !important;
            padding: 0 !important;
        }
    </style>
    </head>
<body>
    
    @include('layouts.partials.header')  

        <main>
            @yield('content')
        </main>

    @include('layouts.partials.footer')

    </body>
</html>