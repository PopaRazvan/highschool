@php
$students=$classroom['students']
@endphp

<x-layout>
    <div class="p-10 max-w-lg mx-auto  flex flex-col items-center justify-center">
        <x-title>{{$classroom['year']}} - {{$classroom['group']}}
            {{optional($classroom['masterClass'])['name']}}
            {{optional($classroom['masterClass'])['surname']}}
        </x-title>
        
        <form method="POST" action="/classrooms/{{$classroom['id']}}" enctype="multipart/form-data">
            @csrf
            @method('DELETE')
            <x-button class="bg-red-500">Delete</x-button>
        </form>
    </div>

<div class="p-10 max-w-lg mx-auto  flex flex-col items-center justify-center">
    <x-title>Students</x-title>
        @foreach ($students as $student)
        <h1>
            <x-item href="/students/{{$student['id']}}">{{$student['name']}} {{$student['surname']}}</x-item>
        </h1>

        @endforeach
    </div>
</x-layout>