@extends('layouts.app')
@section('title', 'Register')

@section('content')
<h2>Register</h2>
<form id="registerForm">
  <input type="text" id="registerName" class="form-control mb-2" placeholder="Name" required>
  <input type="text" id="registerUsername" class="form-control mb-2" placeholder="Username" required>
  <input type="email" id="registerEmail" class="form-control mb-2" placeholder="Email" required>
  <input type="password" id="registerPassword" class="form-control mb-2" placeholder="Password" required>
  <input type="password" id="registerPasswordConfirm" class="form-control mb-2" placeholder="Confirm Password" required>
  <button class="btn btn-success">Register</button>
</form>
<p class="mt-3">Already have an account? <a href="{{ url('/') }}">Login here</a></p>
@endsection

@push('scripts')
<script src="{{ asset('js/register.js') }}"></script>
@endpush