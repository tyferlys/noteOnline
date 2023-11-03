@extends("layout.app")

@section("main")
    <main class="flex flex-col justify-start gap-8 w-5/6 m-auto mb-16 min-h-[80vh]">
        <div class="md:text-4xl text-2xl font-light mt-16 md:text-left text-center">
            Все заметки по заданному поиску
        </div>
        <form class="lg:w-3/6 w-full flex flex-row gap-3" action="{{route("notesAll.view", 1)}}" method="get">
            @csrf
            @method("get")
            <input type="text" placeholder="Найти заметку" name="text"
                   class="hover:scale-105 focus:scale-105 block w-4/6 p-2 rounded-xl border-2 border-gray-400 outline-none"/>
            <input type="submit" value="Найти" class="block w-2/6 p-2 rounded-xl bg-gray-800 text-white"/>
        </form>

            @if(count($notes) > 0)
                <div class="grid md:grid-cols-2 grid-cols-1 gap-3">
                    @foreach($notes as $note)
                        @include("component.note", [
                            "note" => $note,
                        ])
                    @endforeach
                </div>

                <div class="flex md:flex-row flex-col justify-center items-center gap-4">
                    @if(!($page <= 1))
                        <a class="transition hover:bg-gray-600 block md:w-2/6 w-5/6 bg-gray-800 font-bold text-center text-white p-4 rounded-lg " href="{{"?page=" . $page-1 ."&text=$text"}}">Предыдущая страница</a>
                    @endif
                    @if($page < $max)
                        <a class="transition hover:bg-gray-600 block md:w-2/6 w-5/6 bg-gray-800 font-bold text-center text-white p-4 rounded-lg " href="{{"?page=" . $page+1 ."&text=$text"}}">Следующая страница</a>
                    @endif
                </div>
            @else
                <div class="text-3xl bold underline">
                    Мы ничего не нашли
                </div>
            @endif
    </main>
@endsection
