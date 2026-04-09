<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
    <head> <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <title>{{ config('app.name', 'Laravel') }}</title> 
        <!-- Fonts --> <link rel="preconnect" href="https://fonts.bunny.net"> 
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> 
        <!-- Scripts --> @vite(['resources/css/app.css', 'resources/js/app.js']) 
    </head> 
    <body class="font-sans antialiased bg-blue-50"> 
        <main class="flex-1 min-w-0"> 
            <nav class="bg-gray-900 shadow-lg h-16 items-center justify-between px-4">
                <div class="relative flex items-center justify-between h-16 px-4"> 
                    <div class="flex items-center"> <!-- Mobile button --> 
                        <button  button type="button" onclick="window.location='{{ url('/dashboard') }}'" class="inline-flex items-center justify-center p-2 rounded-md text-blue-100 hover:bg-gray-700 focus:outline-none"> 
                            <!--<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6"> <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg> -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                        </button> 
                    </div> 
                    <!--Admin Profile--> 
                    <div class="flex items-center"> 
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger"><!-- Trigger -->
                                <button class="flex items-center text-sm font-medium text-blue-100 hover:text-white focus:outline-none transition">
                                    <div>{{ Auth::user()->name }}</div> 
                                    <div class="ml-1"> 
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                                        </svg> 
                                    </div> 
                                </button> 
                            </x-slot> 
                            <!-- Dropdown Content --> 
                            <x-slot name="content"> 
                                <!--<x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }} 
                                </x-dropdown-link> -->
                                <!-- Logout --> 
                                <form method="POST" action="{{ route('logout') }}"> 
                                    @csrf 
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }} 
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div> 
                </div> 
            </nav>
            <div class="p-6"> {{$slot}} </div> 
        </main>
    </body> 
</html>