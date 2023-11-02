@extends("layout.app")

@section("main")
    <main class="flex flex-col justify-start gap-8 w-5/6 m-auto mb-16 min-h-[80vh]">
        <div class="md:text-4xl text-2xl font-light mt-16 md:text-left text-center">
            Все заметки по заданному поиску
        </div>
        <form class="lg:w-3/6 w-full flex flex-row gap-3" action="{{route("notesAll.view")}}" method="get">
            @csrf
            @method("get")
            <input type="text" placeholder="Найти заметку" name="text"
                   class="hover:scale-105 focus:scale-105 block w-4/6 p-2 rounded-xl border-2 border-gray-400 outline-none"/>
            <input type="submit" value="Найти" class="block w-2/6 p-2 rounded-xl bg-gray-800 text-white"/>
        </form>

        <div class="grid md:grid-cols-2 grid-cols-1 gap-3">
            @if(count($notes) > 0)
                @foreach($notes as $note)
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
            @else
                <div class="text-3xl bold underline">
                    Мы ничего не нашли
                </div>
            @endif
        </div>
    </main>
@endsection
