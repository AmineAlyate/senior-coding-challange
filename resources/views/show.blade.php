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
{{ var_dump($repository) }}
<form action="{{ route('github.repositories.contributors') }}" method="POST">
  @csrf
  <input hidden value="{{ $repository->getContributorsUrl() }}" name="contributors_url">
  <button class="px-4 py-2 font-semibold text-sm bg-sky-500 text-white rounded-none shadow-sm ml-3">
    Contributors
  </button>
</form>
</body>
</html>
