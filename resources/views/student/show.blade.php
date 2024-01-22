@php
$grades = $student['grades'];
$classroom = $student['classroom']
@endphp

<x-layout>
  <x-title>{{$student['name']}} {{$student['surname']}}
    {{$classroom['year']}} - {{$classroom['group']}}</x-title>

  <div class="flex flex-col items-center justify-center">
    <form method="POST" action="/students/{{$student['id']}}" enctype="multipart/form-data">
      @csrf
      @method('DELETE')

      <input type="hidden" name="idClassroomDELETE" value="{{$classroom['id']}}">
      <x-button class="bg-red-500">Delete</x-button>
    </form>

    <div class="mt-6">
      <form method="POST" action="/students/{{$student['id']}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <select name="idClassroom">
          @foreach ($classrooms as $classroom)
          <option value="{{$classroom['id']}}">{{$classroom['year']}} - {{$classroom['group']}}</option>
          @endforeach
        </select>

        <div class="mb-6">
          <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black" type="submit">
            Move student
          </button>
        </div>
      </form>
    </div>
  </div>

  <x-title>Grades</x-title>

  @foreach ($subjects as $subject)
  <x-item> {{$subject['name']}}</x-item>
  @foreach ($grades as $grade)
  @if ($grade['subject']['name'] == $subject['name'])
  <h1>
    {{$grade['value']}}
  </h1>
  @endif
  @endforeach
  @endforeach

  <div class="p-10 max-w-lg mx-auto mt-24 flex flex-col items-center justify-center">
    <x-title> Add grade </x-title>

    <form method="POST" action="/grades" enctype="multipart/form-data">
      @csrf

      <input type="hidden" name="idStudent" value="{{$student['id']}}">

      <div class="mb-6">
        <label for="value" class="inline-block text-lg mb-2">Value</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="value" value="{{old('value')}}" />

        @error('value')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>


      <div class="mb-6">
        <label for="subject" class="inline-block text-lg mb-2">Subject</label>

        <select name="idSubject">

          @foreach ($subjects as $subject)
          <option value="{{$subject['id']}}">{{$subject['name']}}</option>
          @endforeach
        </select>


        <div class="mb-6">
          <x-button >
            Add Grade
          </x-button>
        </div>
      </div>

    </form>
  </div>
</x-layout>