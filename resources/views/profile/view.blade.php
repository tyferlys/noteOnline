@extends("layout.app")

@section("main")
    <main class="flex flex-col gap-8 w-5/6 m-auto mb-16 min-h-[80vh]">
        <div class="mt-16 min-w-full flex md:flex-row flex-col gap-5 justify-between md:items-start items-center">
            <form class="md:w-2/6 w-full bg-white p-6 rounded-xl flex flex-col gap-3" action="{{route("profile.update")}}" method="post">
                @csrf
                @method("patch")

                <div class="text-center text-2xl underline mb-2">Данные {{$user->login}}</div>
                <div class="flex flex-col gap-2">
                    <div class="text-lg">Логин:</div>
                    <div class="text-center block min-w-full p-1 rounded-xl border-2 border-gray-400 outline-none">
                        {{$user->login}}
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="text-lg">Имя:</div>
                    <div class="text-center block min-w-full p-1 rounded-xl border-2 border-gray-400 outline-none">
                        {{$user->name == ""?"Неизвестно":$user->name}}
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="text-lg">Фамилия:</div>
                    <div class="text-center block min-w-full p-1 rounded-xl border-2 border-gray-400 outline-none">
                        {{$user->surname == ""?"Неизвестно":$user->surname}}
                    </div>
                </div>

                <div class="flex flex-row justify-center">
                    Количество поставленных лайков - {{count($user->likes)}}
                </div>
            </form>

            <div class="md:w-3/6 w-full flex flex-col gap-5">
                <div class="text-4xl font-light md:w-3/6 w-full md:text-left text-center">
                    Заметки
                </div>

                @if(count($user->notes) == 0)
                    <div class="text-2xl text-center underline">Заметок еще нет</div>
                    @else
                    <a href="{{route("note.view.all", $user->id)}}" class="transition hover:scale-105 block min-w-full p-6 rounded-lg bg-white md:text-2xl text-xl text-center">
                        Посмотреть все заметки
                    </a>
                @endif

                @foreach(array_slice(array_reverse(iterator_to_array($user->notes)), 0, 3) as $note)
                    @include("component.note", [
                        "note" => $note,
                    ])
                @endforeach
            </div>
        </div>
    </main>
@endsection
