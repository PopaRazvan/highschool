<x-layout>

    <x-title>{{$professor['name']}} {{$professor['surname']}}
        {{ optional($professor['classroom'])['year']}} - {{ optional($professor['classroom'])['group']}}
    </x-title>
    <div class="flex flex-col items-center justify-center">
        <form method="POST" action="/professors/{{$professor['id']}}" enctype="multipart/form-data">
            @csrf
            @method('DELETE')

            <x-button class="bg-red-500">Delete</x-button>
        </form>


        <div class="">
            <form method="POST" action="/professors/{{$professor['id']}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <select name="idClassroom" class="mt-6">
                    @foreach ($classrooms as $classroom)
                    <option value="{{$classroom['id']}}">{{$classroom['year']}} - {{$classroom['group']}}</option>
                    @endforeach
                    <option value="{{null}}">-</option>
                </select>

                <div class="mt-2">
                    <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black" type="submit">
                        Move professor
                    </button>
                </div>
            </form>
        </div>
        <x-title class="mt-20">Subjects</x-title>
        @foreach ($professor['subjects'] as $subject)
        <x-item href="/subjects/{{$subject['id']}}">{{$subject['name']}}</x-item>

        @endforeach
    </div>
</x-layout>