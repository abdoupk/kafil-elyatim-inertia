<!doctype html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .w-full {
            width: 100%
        }

        .table {
            border-collapse: collapse
        }

        .border {
            border: 1px solid
        }

        .border-black {
            border-color: black
        }

        .text-black {
            color: black
        }

        .font-medium {
            font-weight: 500
        }

        .px-2 {
            padding-left: .5rem;
            padding-right: .5rem
        }

        .px-3 {
            padding-left: .75rem;
            padding-right: .75rem
        }

        .py-1 {
            padding-top: .25rem;
            padding-bottom: .25rem
        }

        .text-center {
            text-align: center
        }

        .whitespace-nowrap {
            white-space: nowrap
        }
    </style>
</head>

<body>
<table class="w-full table border-black text-black">

    <thead>
    <tr>
        {{ $thead }}
    </tr>
    </thead>


    <tbody>
    {{ $tbody }}
    </tbody>
</table>
</body>

</html>
