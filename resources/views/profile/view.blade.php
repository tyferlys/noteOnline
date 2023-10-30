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
            </form>

            <div class="w-3/6">

            </div>
        </div>
    </main>
@endsection
