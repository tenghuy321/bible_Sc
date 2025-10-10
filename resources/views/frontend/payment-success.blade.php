@extends('layouts.master')

@section('content')
<div class="container py-5 text-center">
    <h1 class="text-success mb-3">✅ Payment Successful</h1>
    <p>{{ $message }}</p>

    <a href="{{ route('home') }}" class="btn btn-primary mt-4">Return to Home</a>
</div>
@endsection
