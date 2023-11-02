@extends("layout.app")

@section("main")
    <main class="flex flex-col justify-center gap-8 w-5/6 m-auto mb-16 min-h-[80vh]">

        @if($status == 0)
            <div class="mt-16 w-full mx-auto font-light md:text-4xl text-2xl text-center">
                Создатель заметки - <a class = "font-bold underline text-gray-800" href="{{route("profile.view", $note->user->login)}}">{{$note->user->login}}</a>
            </div>
        @else
            <div class="mt-16 w-full mx-auto font-light md:text-4xl text-2xl text-center">
                Редактирование заметки
            </div>
        @endif

        <div class="flex flex-col">
            <div class="md:w-5/6 w-full m-auto bg-white rounded-lg p-5">
                <form class="min-w-full" action="{{route("note.update", $note->id)}}" method="post">
                    @csrf
                    @method("patch")
                    <input type="text" name="title" placeholder="Название заметки" value="{{$note->title}}" {{$status==0?"disabled":""}}
                    class="mb-6 outline-none block md:w-3/6 w-full m-auto text-center border-b-2 border-gray-800 md:text-2xl text-xl"/>

                    <div class="w-5/6 m-auto mb-2 text-xl underline md:text-left text-center">Текст заметки:</div>
                    <textarea {{$status==0?"disabled":""}} name="text" class="rounded-lg min-h-[40vh] resize-y md:text-lg outline-none p-4 block bg-gray-200 md:w-5/6 w-full m-auto">{{$note->text}}</textarea>

                    @if($status == 1)
                        <div class="flex flex-row justify-center gap-5 mt-4 md:w-5/6 m-auto">
                            <input type="submit" value="Сохранить" class="md:w-2/6 w-3/6 text-lg p-2 bg-gray-800 text-white rounded-lg"/>
                            <button type="reset" class="md:w-2/6 w-3/6 text-lg p-2 bg-gray-800 text-white rounded-lg">
                                Очистить
                            </button>
                        </div>
                    @endif
                </form>

                @if($status == 1)
                    <form action="{{route("note.delete", $note->id)}}" class="w-5/6 m-auto" method="post">
                        @csrf
                        @method("delete")
                        <input type="submit" class="text-center block md:w-2/6 w-3/6 m-auto mt-5 text-lg p-2 bg-gray-800 text-white rounded-lg" value="Удалить"/>
                    </form>
                @endif

                <div class="w-full text-center m-auto md:text-md text-sm underline mt-5">
                    Дата последнего изменения: {{$note->updated_at}}
                </div>
            </div>
        </div>
    </main>
@endsection
