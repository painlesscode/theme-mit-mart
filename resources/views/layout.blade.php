<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('vendor/mit-mart/css/output.css') }}" />
</head>
<body class="font-sans antialiased">
<div class="relative flex min-h-screen w-full flex-col">
    <div class="z-10 flex w-full bg-gray-200 lg:justify-between">
        <div class="p-4 hover:bg-gray-800 lg:hidden">M</div>
        <div class="flex flex-grow items-center justify-center lg:flex-grow-0">
            <div class="lg:shadow-r flex w-auto items-center justify-center self-stretch text-xl font-semibold lg:w-64 lg:bg-white">logo</div>
        </div>
        <div class="p-4 hover:bg-gray-800">M</div>
    </div>
    <div class="mobile:-left-64 fixed top-0 left-0 bottom-0 z-0 flex w-64 flex-col bg-white pt-16 font-semibold text-gray-600 lg:left-0">
        <div class="w-full cursor-pointer p-3 hover:text-gray-800">Dashboard</div>
        <div class="w-full cursor-pointer p-3 hover:text-gray-800">Dashboard</div>
        <div class="w-full cursor-pointer p-3 hover:text-gray-800">Dashboard</div>
        <div class="w-full cursor-pointer hover:text-gray-800">
            <div class="mr-8 rounded-r-full bg-gradient-to-r from-blue-700 to-sky-600 p-3 text-white">Dashboard</div>
        </div>
        <div class="w-full cursor-pointer p-3 hover:text-gray-800">Dashboard</div>
        <div class="flex w-full cursor-pointer flex-wrap justify-between hover:text-gray-800">
            <div class="flex w-full justify-between">
                <div class="p-3">Menu</div>
                <div class="p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <div class="ml-4 w-full border-l-2">
                <div class="w-full cursor-pointer p-3 hover:text-gray-800">Dashboard</div>
                <div class="w-full cursor-pointer p-3 hover:text-gray-800">Dashboard</div>
                <div class="w-full cursor-pointer hover:text-gray-800">
                    <div class="mr-8 rounded-r-full bg-gradient-to-r from-blue-700 to-sky-600 p-3 text-white">Dashboard</div>
                </div>
                <div class="w-full cursor-pointer p-3 hover:text-gray-800">Dashboard</div>
            </div>
        </div>
    </div>
    <div class="ml-0 flex-grow bg-green-600 lg:ml-64">content</div>
</div>
{{ $script ?? '' }}
</body>
</html>
