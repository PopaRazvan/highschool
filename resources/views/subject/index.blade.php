<x-layout>
  <x-title>Subjects</x-title>
  @foreach ($subjects as $subject)
  <x-item href="/subjects/{{$subject['id']}}">{{$subject['name']}}</x-item>
  @endforeach

  <div class="p-10 max-w-lg mx-auto mt-24 flex flex-col items-center justify-center">
    <x-title> Add Subject </x-title>

    <form method="POST" action="/subjects" enctype="multipart/form-data">
      @csrf

      <div class="mb-6">
        <label for="name" class="inline-block text-lg mb-2">Name</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{old('name')}}" />

        @error('name')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          Add Subject
        </button>

      </div>
    </form>
  </div>
</x-layout>