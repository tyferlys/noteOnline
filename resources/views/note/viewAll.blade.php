@extends("layout.app")

@section("main")
    <main class="flex flex-col justify-start gap-8 w-5/6 m-auto mb-16 min-h-[80vh]">
        <div class="md:text-4xl text-3xl font-light mt-16 md:text-left text-center">
            Все заметки, {{$user->login}}
        </div>

        <div class="grid md:grid-cols-2 grid-cols-1 gap-3">
            @foreach($user->notes as $note)
                <a href="{{route("note.view", $note->id)}}" class="block min-w-full p-6 rounded-lg bg-gray-600 text-white">
                    <div class="md:text-xl text-lg">
                        <b>Название</b>: {{$note->title}}
                    </div>
                    <div class="md:text-xl text-lg">
                        <b>Текст</b>: {{implode(" ", array_slice(explode(" ", $note->text), 0, 15))}}
                    </div>
                    <div class="md:text-xl text-lg">
                        <b>Дата создания</b>: {{$note->updated_at}}
                    </div>
                </a>
            @endforeach
        </div>
    </main>
@endsection
