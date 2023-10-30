<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FindIO</title>

    @vite('resources/css/app.css')
</head>
<body class="p-0 m-0 flex flex-col bg-gray-200 min-h-[100vh] justify-between">
    @include("auth.component.header")
    @yield("mainAuth")
    @include("auth.component.footer")
</body>
</html>
