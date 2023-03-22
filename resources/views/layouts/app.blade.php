<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/js/app.js'])

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">


    <style>
        .sidebar {
        position: fixed;
        left: 0;
        top: 55px;
        bottom: 0;
        padding: 20px;
        background-color: #45748b;
        border-right: 1px solid #dee2e6;
        overflow-y: auto;
        width: 20%;
    }

        .layout-container .container {
        margin-right: 0 !important;
        margin-top: 55px !important;
        width: 80% !important;
        }


        /* Optional styling for the form elements */
        .form-group {
            margin-bottom: 1rem;
        }

        .input-group-text {
            background-color: #e9ecef;
            border-color: #ced4da;
        }

        .btn-primary {
            width: 100%;
        }
        
    </style>





    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    
    {!! Toastr::message() !!}   
    

</head>
<body>

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">

        <div class="container">
            <a class="navbar-brand" href="/market">
                Market
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto"><li class="nav-item active">
                    <li>
                        <a class="nav-link"  href="{{route('lot.index')}}">
                            <span class="dropdown-item">
                                Lots
                            </span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link"  href="{{route('category.index')}}">
                            <span class="dropdown-item">
                                Categories
                            </span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link"  href="{{route('bid.show')}}">
                            <span class="dropdown-item">
                                Bids
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




    <main>
        
        <div class="layout-container">
            @yield('content')
        </div>
    </main>




        
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>




</body>
</html>
