@extends('layouts.app')
@section('content')
  <table class="table">
    <thead>
    <tr>
      <th>Name</th>
      <th>Visibility</th>
      <th>Description</th>
      <th>watchers</th>
      <th>Created At</th>
      <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($repositories as $repository)
      <tr>
        <td>{{ $repository->getName() }}</td>
        <td>{{ $repository->getVisibility() }}</td>
        <td>{{ $repository->getDescription() }}</td>
        <td>{{ $repository->getWatchers() }}</td>
        <td>{{ $repository->getCreatedAt() }}</td>
        <td>
          <form action="{{ route('github.repositories.show') }}" method="POST">
            @csrf
            <input hidden value="{{ $repository->getUrl() }}" name="url">
            <button class="px-4 py-2 font-semibold text-sm bg-sky-500 text-white rounded-none shadow-sm ml-3">
              Details
            </button>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection