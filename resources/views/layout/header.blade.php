<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | {{ $pageTitle }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <!-- Bootstrap Icons (if needed) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>


    <style>
        * {
            scrollbar-width: thin;
        }

        .sidebar {
            margin: 0;
            padding: 0;
            padding-top: 100px;
            width: 200px;
            background-color: #041f36bb;
            position: fixed;
            height: 100%;
            overflow: auto;
        }

        .sidebar a {
            display: block;
            color: black;
            padding: 16px;
            text-decoration: none;
        }

        .sidebar a.active {
            background-color: #ededed;
            color: rgb(0, 15, 69);
        }

        .sidebar a:hover:not(.active) {
            background-color: #555;
            color: white;
        }

        div.content {
            margin-left: 200px;
            padding: 1px 16px;
            height: 1000px;
        }

        @media screen and (max-width: 700px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .sidebar a {
                float: left;
            }

            div.content {
                margin-left: 0;
            }
        }

        @media screen and (max-width: 400px) {
            .sidebar a {
                text-align: center;
                float: none;
            }
        }


        .navbar {
            width: 100%;
            background-color: #ebebeb;
            padding: 15px;
            position: sticky;
            top: 0;
            left: 0;
        }

        .navbar a {
            float: right;
            text-align: center;
            padding: 8px;
            margin: 0;
            color: rgb(0, 0, 0);
            text-decoration: none;
            font-size: 17px;
        }

        .navbar a:hover {
            color: red;
        }

        .active {
            background-color: #04AA6D;
        }

        .main-content {
            padding-left: 200px;
        }

        @media screen and (max-width: 500px) {
            .navbar a {
                float: none;
                display: block;
            }

            .main-content {
                padding: 8px;
            }
        }
    </style>

    @stack('css')

    <ul class="nav d-none shadow-lg d-md-block sidebar flex-column">
        @include('layout.sidebar')
    </ul>
</head>
