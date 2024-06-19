<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="rotate-90">
<h1 class="text-2xl text-center">hello</h1>

@foreach($families as $family)
    <li class="text-2xl text-red-500">{{$family->name}}</li>
@endforeach
</body>
</html>
