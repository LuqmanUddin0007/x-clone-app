@extends('layouts.app')
@section('title', 'Edit Profile')

@section('content')
<div class="container mt-4">
  <h3>Edit Profile</h3>
  <form id="editProfileForm">
    <input type="text" id="editName" class="form-control mb-2" placeholder="Name" required>
    <input type="email" id="editEmail" class="form-control mb-2" placeholder="Email" required>
    <input type="file" id="editPicture" class="form-control mb-2" accept="image/*">
    <img id="editPreview" width="100" height="100" class="mb-2" style="object-fit: cover; border-radius: 8px;">
    <button class="btn btn-success" type="submit">Save Changes</button>
  </form>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/profile-edit.js') }}"></script>
@endpush