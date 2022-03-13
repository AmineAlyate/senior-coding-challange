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
<div class="flex justify-center">
  <form action="{{ Route('github.auth') }}" method="POST"
        class="px-12 py-4 bg-gray-50 flex flex-col justify-center items-center">
    @csrf
    <input class="form-control my-4" name="user_name" placeholder="Username" autocomplete="off">
    <input class="form-control mb-4" name="user_token" placeholder="token" autocomplete="off">
    <button class="px-4 py-2 font-semibold text-sm bg-sky-500 text-white rounded-none shadow-sm">Save</button>
  </form>
</div>
<a href="{{ Route('github.list.repositories') }}" class="px-4 py-2 font-semibold text-sm bg-blue-500 text-white rounded-none shadow-sm">
  Get repositories
</a>
<a href="{{ Route('github.list.users') }}" class="px-4 py-2 font-semibold text-sm bg-blue-500 text-white rounded-none shadow-sm">
  Users
</a>
</body>
</html>
