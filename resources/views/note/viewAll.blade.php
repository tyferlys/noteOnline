@extends("layout.app")

@section("main")
    <main class="flex flex-col justify-start gap-8 w-5/6 m-auto mb-16 min-h-[80vh]">
        <div class="text-4xl font-light mt-16 w-2/6">
            Все заметки, {{$user->login}}
        </div>

        <div class="grid grid-cols-2 gap-3">
            @foreach($user->notes as $note)
                <a href="{{route("note.view", $note->id)}}" class="block min-w-full p-6 rounded-lg bg-gray-600 text-white">
                    <div class="text-xl">
                        <b>Название</b>: {{$note->title}}
                    </div>
                    <div class="text-xl">
                        <b>Текст</b>: {{implode(" ", array_slice(explode(" ", $note->text), 0, 15))}}
                    </div>
                    <div class="text-xl">
                        <b>Дата создания</b>: {{$note->updated_at}}
                    </div>
                </a>
            @endforeach
        </div>
    </main>
@endsection
