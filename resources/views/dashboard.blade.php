@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between">
  <div>
    <h3>Welcome, <span id="dashboardName"></span></h3>
    <p>Email: <span id="dashboardEmail"></span></p>
    <img id="dashboardAvatar" src="" width="100" class="rounded" />
  </div>
  <div>
    <a href="/profile" class="btn btn-secondary">Profile</a>
    <button id="logoutBtn" class="btn btn-danger">Logout</button>
  </div>
</div>

<hr>

<div>
  <h4>My Posts</h4>
  <button id="btnCreatePost" class="btn btn-info mb-3">Create Post</button>
  <div id="postFormSection" class="d-none">
    <form id="postForm">
      <textarea id="postContent" class="form-control mb-2" maxlength="280" required></textarea>
      <button class="btn btn-primary">Submit</button>
    </form>
  </div>
  <ul id="postsList" class="list-group"></ul>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/dashboard.js') }}"></script>
@endpush
