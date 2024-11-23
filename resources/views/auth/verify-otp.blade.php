@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Verify Your Email</h1>
    <form action="{{ route('verify.otp.submit') }}" method="POST">
        @csrf
        <input type="hidden" name="email" value="{{ session('email') }}">
        <div>
            <label for="otp">Enter OTP</label>
            <input type="text" name="otp" required>
        </div>
        @error('otp')
            <p>{{ $message }}</p>
        @enderror
        <button type="submit">Verify</button>
    </form>
</div>
@endsection
