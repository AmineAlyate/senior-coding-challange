@extends('layouts.app')
@section('content')
  <div class="flex justify-center">
    <form action="{{ Route('github.auth') }}" method="POST"
          class="px-12 py-4 bg-gray-50 flex flex-col justify-center items-center">
      @csrf
      <input class="form-control my-4" name="user_name" placeholder="Username" autocomplete="off">
      <input class="form-control mb-4" name="user_token" placeholder="token" autocomplete="off">
      <button class="px-4 py-2 font-semibold text-sm bg-sky-500 text-white rounded-none shadow-sm">Save</button>
    </form>
  </div>
  <a href="{{ Route('github.list.repositories') }}"
     class="px-4 py-2 font-semibold text-sm bg-blue-500 text-white rounded-none shadow-sm">
    Get repositories
  </a>
  <a href="{{ Route('github.list.users') }}"
     class="px-4 py-2 font-semibold text-sm bg-blue-500 text-white rounded-none shadow-sm">
    Users
  </a>
@endsection
