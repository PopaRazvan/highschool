<x-layout>
    <x-title>Students</x-title>
    @foreach ($students as $student)
    <h1>
        <x-item href="/students/{{$student['id']}}">{{$student['name']}} {{$student['surname']}}</x-item>
    </h1>

    @endforeach
    <div class="p-10 max-w-lg mx-auto mt-24 flex flex-col items-center justify-center">
        <x-title> Add student </x-title>

        <form method="POST" action="/students" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">Name</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                    value="{{old('name')}}" />

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

            <div class="mb-6">
                <label for="scholarship" class="inline-block text-lg mb-2">scholarship</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="scholarship" />

                @error('scholarship')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="birthDate" class="inline-block text-lg mb-2">
                    BirthDate
                </label>
                <input type="date" class="border border-gray-200 rounded p-2 w-full" name="birthDate"
                    value="{{old('email')}}" />

                @error('birthDate')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="birthDate" class="inline-block text-lg mb-2">
                    Classroom
                </label>
                <select name="idClassroom">
                    @foreach ($classrooms as $classroom)
                    <option value="{{$classroom['id']}}">{{$classroom['year']}} - {{$classroom['group']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Add Student
                </button>
            </div>
        </form>
    </div>
</x-layout>