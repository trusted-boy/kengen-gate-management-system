<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KenGen Gate Management System</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

<!-- Navigation -->
<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-center justify-between h-20">

            <div class="flex items-center space-x-4">

                <img
                    src="{{ asset('images/kengen-logo.png') }}"
                    alt="KenGen Logo"
                    class="h-14 w-auto">

                <div>

                    <h1 class="text-xl font-bold text-green-700">
                        KenGen Gate Management System
                    </h1>

                    <p class="text-sm text-gray-500">
                        Secure Access Control Platform
                    </p>

                </div>

            </div>

            <div class="space-x-4">

                @auth

                    <a href="{{ url('/dashboard') }}"
                       class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg">

                        Dashboard

                    </a>

                @else

                    <a href="{{ route('login') }}"
                       class="text-gray-700 hover:text-green-700 font-medium">

                        Login

                    </a>

                    @if(Route::has('register'))

                        <a href="{{ route('register') }}"
                           class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg">

                            Register

                        </a>

                    @endif

                @endauth

            </div>

        </div>

    </div>
</nav>

<!-- Hero -->

<section class="bg-gradient-to-r from-green-800 via-green-700 to-green-600">

<div class="max-w-7xl mx-auto px-6 py-24">

<div class="grid lg:grid-cols-2 gap-12 items-center">

<div>

<h1 class="text-5xl font-bold text-white leading-tight">

KenGen Gate Management System

</h1>

<p class="mt-8 text-lg text-green-100 leading-8">

A secure digital platform for managing visitors,
employees, contractors and vehicles entering
KenGen facilities.

Improve accountability, enhance security,
and streamline gate operations from one
centralized dashboard.

</p>

<div class="mt-10 flex gap-4">

<a href="{{ route('login') }}"
class="bg-white text-green-700 font-semibold px-8 py-4 rounded-lg shadow">

Login

</a>

@if(Route::has('register'))

<a href="{{ route('register') }}"
class="border border-white text-white px-8 py-4 rounded-lg">

Request Access

</a>

@endif

</div>

</div>

<div class="flex justify-center">

@if(file_exists(public_path('images/hero.jpg')))

<img
src="{{ asset('images/hero.jpg') }}"
class="rounded-2xl shadow-2xl w-full">

@else

<div class="bg-white rounded-2xl shadow-2xl p-10 w-full">

<h2 class="text-2xl font-bold text-green-700">

System Overview

</h2>

<ul class="mt-6 space-y-4 text-gray-600">

<li>✓ Visitor Registration</li>

<li>✓ Vehicle Tracking</li>

<li>✓ Staff Verification</li>

<li>✓ Security Reports</li>

<li>✓ QR Code Access</li>

<li>✓ Gate Pass Management</li>

</ul>

</div>

@endif

</div>

</div>

</div>

</section>

<!-- Features -->

<section class="py-20 bg-white">

<div class="max-w-7xl mx-auto px-6">

<h2 class="text-4xl font-bold text-center text-gray-800">

Core Features

</h2>

<p class="text-center text-gray-500 mt-4 mb-14">

Designed to improve security and operational efficiency.

</p>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

<div class="bg-gray-50 rounded-xl p-8 shadow">
<h3 class="text-xl font-semibold text-green-700">Visitor Management</h3>
<p class="mt-3 text-gray-600">
Digital registration and approval of visitors.
</p>
</div>

<div class="bg-gray-50 rounded-xl p-8 shadow">
<h3 class="text-xl font-semibold text-green-700">Vehicle Access</h3>
<p class="mt-3 text-gray-600">
Track vehicle entry and exit with complete logs.
</p>
</div>

<div class="bg-gray-50 rounded-xl p-8 shadow">
<h3 class="text-xl font-semibold text-green-700">Employee Verification</h3>
<p class="mt-3 text-gray-600">
Secure authentication before granting access.
</p>
</div>

<div class="bg-gray-50 rounded-xl p-8 shadow">
<h3 class="text-xl font-semibold text-green-700">Reports</h3>
<p class="mt-3 text-gray-600">
Generate daily, weekly and monthly reports.
</p>
</div>

<div class="bg-gray-50 rounded-xl p-8 shadow">
<h3 class="text-xl font-semibold text-green-700">QR Code Gate Passes</h3>
<p class="mt-3 text-gray-600">
Fast and secure verification at the gate.
</p>
</div>

<div class="bg-gray-50 rounded-xl p-8 shadow">
<h3 class="text-xl font-semibold text-green-700">Role Management</h3>
<p class="mt-3 text-gray-600">
Administrator, Security and Reception access levels.
</p>
</div>

</div>

</div>

</section>

<!-- CTA -->

<section class="bg-green-700 py-20">

<div class="max-w-4xl mx-auto text-center px-6">

<h2 class="text-4xl font-bold text-white">

Ready to Access the System?

</h2>

<p class="text-green-100 mt-6">

Sign in to continue managing visitors and gate operations.

</p>

<div class="mt-10">

<a href="{{ route('login') }}"
class="bg-white text-green-700 font-semibold px-8 py-4 rounded-lg shadow">

Login to System

</a>

</div>

</div>

</section>

<!-- Footer -->

<footer class="bg-gray-900 text-gray-300">

<div class="max-w-7xl mx-auto px-6 py-12">

<div class="flex flex-col md:flex-row justify-between items-center">

<div>

<h3 class="text-white text-xl font-bold">

KenGen Gate Management System

</h3>

<p class="mt-2 text-gray-400">

ICT Department • Industrial Attachment Project

</p>

</div>

<p class="mt-6 md:mt-0 text-gray-500">

© {{ date('Y') }} Kenya Electricity Generating Company PLC

</p>

</div>

</div>

</footer>

</body>
</html>