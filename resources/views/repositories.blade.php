@php
  use App\Models\DTO\Repository;
  /** @var Repository $repository */
@endphp
        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            clifford: '#da373d',
          }
        }
      }
    }
  </script>
  <style>
    body {
      font-family: 'Nunito', sans-serif;
    }
  </style>
</head>
<body class="antialiased">
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
</body>
</html>
