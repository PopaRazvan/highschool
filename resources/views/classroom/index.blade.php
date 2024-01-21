<x-layout>

    <x-title>Classrooms</x-title>
    @foreach ($classrooms as $classroom)

    <div class="flex justify-items-start flex-row space-x-4">
        <x-item href="/classrooms/{{$classroom['id']}}">{{$classroom['year']}} - {{$classroom['group']}}

        </x-item>
        @if ($classroom['masterClass'] !== null)
        <div>
            <a href="/professors/{{ $classroom['masterClass']['id'] }}">
                {{ $classroom['masterClass']['name'] }}
                {{ $classroom['masterClass']['surname'] }}
            </a>
        </div>
        @endif
    </div>

    @endforeach

    <div class="p-10 max-w-lg mx-auto mt-24 flex flex-col items-center justify-center">
        <x-title> Add Classrooms </x-title>

        <form method="POST" action="/classrooms" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label for="year" class="inline-block text-lg mb-2">year</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="year"
                    value="{{old('year')}}" />

                @error('year')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="group" class="inline-block text-lg mb-2">group</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="group" />

                @error('group')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div>
            <label for="classroom" class="inline-block text-lg mb-2">Professor</label>

            <select name="idProfessor">

                @foreach ($professors as $professor)
                <option value="{{$professor['id']}}">{{$professor['name']}} {{$professor['surname']}}</option>
                @endforeach
                <option value="{{null}}"> - </option>
            </select>
            </div>

            <x-button>
                Add Classroom
            </x-button>

    </div>
    </form>
    </div>
</x-layout>