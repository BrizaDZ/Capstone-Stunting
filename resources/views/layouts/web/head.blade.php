<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>StuntAIDS</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        section{
            min-height: 100dvh;
            align-content: center;
        }

        .full-width{
            width: -moz-available;
            width: -webkit-fill-available;
        }
    </style>

    <style>
    .navbar {
        transition: background-color 0.4s ease, box-shadow 0.4s ease;
    }

    .navbar-scrolled {
        background-color: rgba(255, 255, 255, 0.95) !important; /* agak transparan untuk kesan modern */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px); /* efek blur belakang, lebih modern */
    }
</style>

    @stack('style')
</head>
