<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Slack Apps Hosting')</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <link rel="canonical" href="{{ Request::url() }}">

    <meta name="description" content="@yield('description', 'Host Your Slack Apps Here')">

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    {{-- style sheets --}}

    {{-- Javascript --}}

</head>
<body>
    @yield('content')
    {{-- Footer Scripts --}}
    @yield('bottom-scripts')
</body>
</html>