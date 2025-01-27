<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Home page</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Navbar -->
    @auth
        @if(auth()->user()->is_admin)
            @include('layouts.admin-navigation')
        @else
            @include('layouts.user-navigation')
        @endif
    @else
        @include('layouts.guest-navigation')
    @endauth

    <!-- Page Content -->
    <!--
    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="container mx-auto my-8">
                <section class="text-center">
                <img src="/img/enlargers_cmy.png" alt="Three enlargers on CMY background" class="mx-auto rounded-xl shadow-lg max-w-full h-auto">
                <h1>Welcome to Our Darkroom!</h1>
                <p>We offer two professionally equipped darkrooms for all your photographic needs:</p>
                </section>

                <section class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                <div class="p-6 bg-white rounded-xl shadow-lg">
                <h3 class="text-xl font-semibold">Black & White Darkroom</h3>
                <p class="mt-2 text-gray-600">Our black & white darkroom is perfect for classic monochrome prints. Equipped with top-quality enlargers and everything you need to bring your photographs to life.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-lg">
                <h3 class="text-xl font-semibold">Color Printing Darkroom</h3>
                <p class="mt-2 text-gray-600">Our color printing darkroom features state-of-the-art equipment for vibrant, accurate color prints. Perfect for professionals and enthusiasts alike.</p>
                </div>
                </section>

                <section class="mt-8 text-center">
                <a href="/reservations" class="inline-block px-6 py-3 bg-blue-600 text-white text-lg font-medium rounded-lg shadow hover:bg-blue-700">Book Your Darkroom Now</a>
                </section>
                </div>
                </div>
                </div>
                </div>
                </div>
                </main> -->

    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-100">
                        <div class="container mx-auto my-8">
                            <section class="text-center">
                                <div class="flex justify-center items-center">
                                    <div class="justify-center w-1/3">
                                        <img src="/img/enlargers_cmy.png" alt="Three enlargers on CMY background" class="mx-auto rounded-xl h-auto">
                                    </div>
                                </div>
                                <h1 class="text-2xl font-bold mt-6 text-white">Welcome to Our Darkroom!</h1>
                                <p class="mt-4 text-lg text-gray-300">We offer two professionally equipped darkrooms for all your photographic needs:</p>
                            </section>
                            <!-- Darkrooms info cards -->
                            <section class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                                <div class="p-6 bg-gray-600 rounded-xl shadow-lg">
                                    <h3 class="text-xl font-semibold text-gray-300">Black & White Darkroom</h3>
                                    <p class="mt-2 text-gray-300">
                                        Our black & white darkroom is equipped with two professional enlargers: one for 35mm and medium format (up to 6x9) and the other for large format (4x5). You'll find everything needed for classic monochrome prints and film developing, including contrast filters for variable-contrast papers, chemicals, and high-quality papers. Perfect for both beginners and experienced photographers looking to develop their black-and-white film with precision and care.
                                </div>
                                <div class="p-6 bg-gray-600 rounded-xl shadow-lg">
                                    <h3 class="text-xl font-semibold text-gray-300">Color Printing Darkroom</h3>
                                    <p class="mt-2 text-gray-300">
                                    In our color darkroom, we offer more than just enlargers with color heads. It also features a semi-automatic film processor for consistent C-41 and E-6 process developing, automatic RA-4 print processing machine with builtin drier and color analyzer for easy work. Ideal for photographers working with color film or those looking to create vibrant prints. We provide all the necessary tools, chemicals, and papers for color processing, making it a great choice for both professionals and hobbyists.
                                    </p>
                                </div>
                            </section>

                            <!-- Booking button -->
                            <section class="mt-8 text-center">
                                <x-primary-button href="/reservations" class="inline-block px-6 py-3 text-white text-lg font-medium rounded-lg shadow hover:bg-blue-600">
                                    Book Your Darkroom Now
                                </x-primary-button>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
