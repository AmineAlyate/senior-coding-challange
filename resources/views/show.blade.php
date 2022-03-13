@extends('layouts.app')
@section('content')
  {{ var_dump($repository) }}
  <form action="{{ route('github.repositories.contributors') }}" method="POST">
    @csrf
    <input hidden value="{{ $repository->getContributorsUrl() }}" name="contributors_url">
    <button class="px-4 py-2 font-semibold text-sm bg-sky-500 text-white rounded-none shadow-sm ml-3">
      Contributors
    </button>
  </form>
@endsection