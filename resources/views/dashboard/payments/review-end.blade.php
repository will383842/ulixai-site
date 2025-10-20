@extends('dashboard.layouts.master')

@section('title', 'Thanks You')

@section('content')

  <!-- Layout Wrapper -->
  <div class="flex flex-col lg:flex-row min-h-screen">
    <!-- Main Content -->
    <main class="flex-1 p-4 sm:p-6 lg:p-10 flex items-center justify-center">
      <div class="bg-white rounded-2xl shadow-xl px-6 py-12 w-full max-w-xl text-center space-y-4">
        <h1 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-blue-900 tracking-wide">
          THANK YOU FOR YOUR INFORMATION
        </h1>
        <p class="text-gray-600 text-sm sm:text-base">
          We have received your input and will process it shortly.
        </p>
      </div>
    </main>

  </div>
  @endsection