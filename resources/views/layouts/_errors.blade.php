@if ($errors->any())
  <div class="w-full">
    <div class="text-center text-red-800 bg-red-100 p-2">
      @foreach ($errors->getMessages()  as $errorMessages)
        {!! $errorMessages[0] !!}
      @endforeach
    </div>
  </div>
@endif

@if (session('success'))
  <div class="w-full">
    <div class="text-center text-green-800 bg-green-100 p-2">
      <p>{{ session('success') }}</p>
    </div>
  </div>
@endif

@if (session('error'))
  <div class="w-full">
    <div class="text-center text-red-800 bg-red-100 p-2">
      <p>{{ session('error') }}</p>
    </div>
  </div>
@endif
