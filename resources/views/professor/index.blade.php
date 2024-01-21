<x-layout>


  <x-title>Professors</x-title>

  @foreach ($professors as $professor)
  <x-item href="/professors/{{$professor['id']}}">
      {{$professor['name']}} {{$professor['surname']}}</x-item >


  @endforeach
  <div class="p-10 max-w-lg mx-auto mt-24 flex flex-col items-center justify-center">
    <x-title>Add professor</x-title>

    <form method="POST" action="/professors" enctype="multipart/form-data">
      @csrf

      <div class="mb-6">
        <label for="name" class="inline-block text-lg mb-2">Name</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{old('name')}}" />

        @error('name')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="surname" class="inline-block text-lg mb-2">Surname</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="surname" />

        @error('surname')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>
      <label for="classroom" class="inline-block text-lg mb-2">Classroom</label>
      
      <select name="idClassroom">

        @foreach ($classrooms as $classroom)
        <option value="{{$classroom['id']}}">{{$classroom['year']}} - {{$classroom['group']}}</option>
        @endforeach
        <option value="{{null}}"> - </option>
      </select>


      <fieldset>
        <label for="subjects" class="inline-block text-lg mb-2">Subjects</label>
       
        @foreach ($subjects as $subject)

        <input type="checkbox" name="selectedSubjects[]" value="{{$subject['id']}}" /> {{$subject['name']}}
        @endforeach


      </fieldset>

      <div class="mb-6">
        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          Add Professor
        </button>

      </div>
    </form>
  </div>
</x-layout>