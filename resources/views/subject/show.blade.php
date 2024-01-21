<x-layout>

  <x-title>{{$subject['name']}} </x-title>

  <div class="flex flex-col items-center justify-center">
    <form method="POST" action="/subjects/{{$subject['id']}}" enctype="multipart/form-data">
      @csrf
      @method('DELETE')
      <x-button class="bg-red-500">Delete</x-button>
    </form>
  </div>

  <x-title class="mt-20">Professors</x-title>

  @foreach($subject['professors'] as $professor)
  <x-item href="/professors/{{$professor['id']}}">{{$professor['name']}} {{$professor['surname']}}</x-item>
  @endforeach

</x-layout>