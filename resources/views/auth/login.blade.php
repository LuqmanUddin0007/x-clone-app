@extends('layouts.app')
@section('title', 'Login')

@section('content')
<h2>Login</h2>
<form id="loginForm">
  <input type="email" class="form-control mb-2" id="loginEmail" placeholder="Email" required>
  <input type="password" class="form-control mb-2" id="loginPassword" placeholder="Password" required>
  <button class="btn btn-primary">Login</button>
</form>
<p class="mt-3">Don't have an account? <a href="{{ url('/register') }}">Register here</a></p>
@endsection

@push('scripts')
<script src="{{ asset('js/login.js') }}"></script>
@endpush
