@extends("layout.app")

@section("main")
    <main class="flex flex-col gap-8 w-5/6 m-auto mb-16">
        <div class="flex flex-row gap-5 justify-between">
            <div class="text-4xl font-light mt-16 w-2/6">
                Профиль
            </div>
            <div class="text-4xl font-light mt-16 w-3/6">
                Заметки
            </div>
        </div>

        <div class="min-w-full flex flex-row gap-5 justify-between items-start">
            <form class="w-2/6 bg-white p-6 rounded-xl flex flex-col gap-3" action="{{route("profile.update")}}" method="post">
                @csrf
                @method("patch")

                <div class="text-center text-2xl underline mb-2">Ваши данные</div>
                <div class="flex flex-col gap-2">
                    <div class="text-lg">Логин:</div>
                    <input type="text" placeholder="Ваш логин" name="login" value="{{$user->login}}" disabled
                           class="text-center bg-gray-200 block min-w-full p-1 rounded-xl border-2 border-gray-400 outline-none"/>

                    @error("login")
                    {{ $errors->first('login') }}
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <div class="text-lg">Пароль:</div>
                    <input type="text" placeholder="Ваш пароль" name="password" value="{{$user->password}}"
                           class="hover:scale-105 focus:scale-105 text-center block min-w-full p-1 rounded-xl border-2 border-gray-400 outline-none"/>

                    @error("password")
                    {{ $errors->first('password') }}
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <div class="text-lg">Имя:</div>
                    <input type="text" placeholder="Ваше имя" name="name" value="{{$user->name}}"
                           class="hover:scale-105 focus:scale-105 text-center block min-w-full p-1 rounded-xl border-2 border-gray-400 outline-none"/>

                    @error("name")
                    {{ $errors->first('name') }}
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <div class="text-lg">Фамилия:</div>
                    <input type="text" placeholder="Ваша фамилия" name="surname" value="{{$user->surname}}"
                           class="hover:scale-105 focus:scale-105 text-center block min-w-full p-1 rounded-xl border-2 border-gray-400 outline-none"/>

                    @error("surname")
                    {{ $errors->first('surname') }}
                    @enderror
                </div>

                <div class="flex flex-row gap-2 mt-3">
                    <input type="submit" value="Сохранить" class="hover:bg-black block w-1/2 p-2 rounded-xl bg-gray-800 text-white"/>
                    <a type="button" class="hover:bg-black text-center block w-1/2 p-2 rounded-xl bg-gray-800 text-white" href="{{route("profile.exit")}}">
                        Выйти
                    </a>
                </div>
            </form>

            <div class="w-3/6 flex flex-col gap-5">
                @if(count($user->notes) == 0)
                    <a href="{{route("note.index")}}" class="hover:scale-105 block min-w-full p-6 rounded-lg bg-white text-2xl text-center">
                        Создать заметку
                    </a>
                @else
                    <a href="{{route("note.index")}}" class="hover:scale-105 block min-w-full p-6 rounded-lg bg-white text-2xl text-center">
                        Посмотреть все заметки
                    </a>
                    <a href="{{route("note.index")}}" class="hover:scale-105 block min-w-full p-6 rounded-lg bg-white text-2xl text-center">
                        Создать заметку
                    </a>
                @endif

                @foreach(array_slice(array_reverse(iterator_to_array($user->notes)), 0, 3) as $note)
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
        </div>
    </main>
@endsection