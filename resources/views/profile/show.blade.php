@extends('layouts.app')
@section('title', 'My Profile')

@section('content')
<div class="container mt-4">
  <h3>My Profile</h3>
  <p><strong>Name:</strong> <span id="username"></span></p>
  <p><strong>Email:</strong> <span id="useremail"></span></p>
  <img id="avatar" width="100" height="100" class="mb-3" style="object-fit: cover; border-radius: 8px;">
  <br>
  <a href="/profile/edit" class="btn btn-primary">Edit Profile</a>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/profile.js') }}"></script>
@endpush