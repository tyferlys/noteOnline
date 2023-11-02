    @extends("layout.app")

    @section("main")
        <main class="flex flex-col justify-center gap-8 w-5/6 m-auto mb-16 min-h-[80vh]">
            <div class="mt-16 w-5/6 mx-auto font-light md:text-4xl text-3xl text-center">
                Создание заметки
            </div>

            <div class="flex flex-col">
                <form class="md:w-5/6 w-full m-auto bg-white rounded-lg p-5" action="{{route("note.store", $user->id)}}" method="post">
                    @csrf
                    @method("post")
                    <input type="text" name="title" placeholder="Название заметки"
                           class="mb-6 outline-none block md:w-3/6 w-full m-auto text-center border-b-2 border-gray-800 md:text-2xl text-xl"/>

                    <div class="w-5/6 m-auto mb-2 text-xl underline md:text-left text-center">Текст заметки:</div>
                    <textarea name="text" class="rounded-lg min-h-[40vh] resize-y md:text-lg outline-none p-4 block bg-gray-200 md:w-5/6 w-full m-auto"></textarea>

                    <div class="flex flex-row justify-center gap-5 mt-4">
                        <input type="submit" value="Сохранить" class="md:w-2/6 w-3/6 text-lg p-2 bg-gray-800 text-white rounded-lg"/>
                        <button type="reset" class="md:w-2/6 w-3/6 text-lg p-2 bg-gray-800 text-white rounded-lg">
                            Очистить
                        </button>
                    </div>
                </form>
            </div>
        </main>
    @endsection
