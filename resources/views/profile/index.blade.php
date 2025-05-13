@extends('layouts.app')
@section('title', 'Profile')

@section('content')
<h3>Profile</h3>
<form id="updateProfileForm" enctype="multipart/form-data">
  <input type="text" class="form-control mb-2" id="profileNameInput" placeholder="Name" required>
  <input type="email" class="form-control mb-2" id="profileEmailInput" placeholder="Email" required>

  <label for="profilePicture" class="form-label">Profile Picture</label>
  <input type="file" class="form-control mb-2" id="profilePicture" accept="image/*">
  <img id="profilePicturePreview" src="" width="100" class="rounded mb-2">

  <button class="btn btn-warning">Update Profile</button>
</form>
@endsection

@push('scripts')
<script src="{{ asset('js/profile.js') }}"></script>
@endpush
