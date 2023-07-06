<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- CSRF Token -->
    <meta name="csrf-token"
          content="{{ csrf_token() }}">
    <meta name="robots" content="noindex" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        #tableContainer {
            width: 100%;
            padding: 0.5em;
        }

        table {
            width: 100%;
            border: 1px black solid;
            margin: 0.5em;
            font-size: small;
        }

        table th {
            border: 1px black dashed;
            padding: 5px;
        }

        table td {
            border: 1px black dashed;
            padding: 5px;
        }

        table td.versionCompare {
            background: black;
            border: 1px white dotted;
        }

        tr:nth-child(even) {
            background: #CCC
        }

        tr:nth-child(odd) {
            background: #FFF
        }
    </style>

</head>

<body>
