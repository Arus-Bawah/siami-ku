<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIAMIKU - @yield('title')</title>

    @include('cms.template.css')
    @stack('top')
</head>

<body>
    @include('cms.component.loading')
    <section id="app">
        @yield('page')
    </section>

    @include('cms.template.script')
    @stack('bottom')
</body>

</html>
