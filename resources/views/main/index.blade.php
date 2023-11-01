@extends("layout.app")

@section("main")
    <main class="flex flex-col w-5/6 m-auto mb-16">
        <div class="flex flex-col gap-6 justify-between mt-16 items-center min-w-full">
            <div class="text-3xl font-light underline">
                Добро пожаловать, {{$login}}
            </div>
            <form class="w-3/6 flex flex-row gap-3" action="{{route("notesAll.view")}}" method="get">
                @csrf
                @method("get")
                <input type="text" placeholder="Найти заметку" name="text"
                       class="hover:scale-105 focus:scale-105 block w-4/6 p-2 rounded-xl border-2 border-gray-400 outline-none"/>
                <input type="submit" value="Найти" class="block w-2/6 p-2 rounded-xl bg-gray-800 text-white"/>
            </form>
        </div>

        <div class="flex flex-col gap-10 mt-16 min-w-full">
            <div class="flex flex-col min-w-full">
                <div class="text-4xl font-light">
                    Последние заметки:
                </div>

                <div class="grid grid-cols-3 gap-5 min-w-full m-auto mt-6">
                    @foreach($notes as $note)
                        <a href="{{route("note.view", $note->id)}}" class="block min-w-full flex flex-col gap-5 bg-gray-600 text-white p-6 rounded-lg">
                            <div class="text-center text-xl font-bold underline">{{$note->user->login}}</div>
                            <div class="text-center text-xl">{{$note->title}}</div>
                            <div class="text-center text-md">{{$note->updated_at}}</div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col gap-10 min-w-full">
                <div class="text-4xl font-light">
                    Пользователи:
                </div>

                <div class="min-w-full bg-white rounded-xl p-5 flex flex-row items-start gap-10">
                    <form class="w-2/6 flex flex-col items-stretch gap-5">
                        <div class="text-xl min-w-full text-center underline">Поиск пользователей:</div>

                        <div class="w-5/6 m-auto flex flex-col gap-2">
                            <div class="">Логин:</div>
                            <input type="text" placeholder="Никнейм пользователя" name="login"
                                   class="hover:scale-105 focus:scale-105 text-center block min-w-full  p-1 rounded-xl border-2 border-gray-400 outline-none"/>
                        </div>

                        <div class="w-5/6 m-auto flex flex-col gap-2">
                            <div class="">Имя:</div>
                            <input type="text" placeholder="Имя" name="name"
                                   class="hover:scale-105 focus:scale-105 text-center block min-w-full  p-1 rounded-xl border-2 border-gray-400 outline-none"/>
                        </div>

                        <div class="w-5/6 m-auto flex flex-col gap-2">
                            <div class="">Фамилия:</div>
                            <input type="text" placeholder="Фамилия" name="surname"
                                   class="hover:scale-105 focus:scale-105 text-center block min-w-full  p-1 rounded-xl border-2 border-gray-400 outline-none"/>
                        </div>

                        <div class="flex flex-row gap-2 w-5/6 m-auto">
                            <input type="button" id="findUsers" value="Найти" class="block w-3/6 p-2 rounded-xl bg-gray-800 text-white hover:bg-black"/>
                            <input type="reset" value="Очистить" class="block w-3/6 p-2 rounded-xl bg-gray-800 text-white hover:bg-black"/>
                        </div>
                    </form>

                    <div class="w-4/6 flex flex-col gap-5">
                        <div class="text-xl min-w-full text-center underline">Результат поиска:</div>

                        <div class="flex flex-col gap-5" id="blocks">
                            <div class="text-center underline font-bold text-2xl">
                                Попробуйте найти!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        let page = -1;
        let isFind = false;

        let login, name ,surname = null;


        const getUsersNext = async (isNew) => {
            if (isNew){
                if (!isFind){
                    page++;

                    await getUsers(page).then(() => {isFind = false})
                }
            }
            else{
                if (!isFind){
                    page = 0;

                    login = document.getElementsByName("login")[0].value;
                    name = document.getElementsByName("name")[0].value;
                    surname = document.getElementsByName("surname")[0].value;

                    await getUsers(page).then(() => {isFind = false})
                }
            }
        }

        const getUsersLast = async () => {
            if (!isFind){
                if (page - 1 <= 0)
                    page = 0
                else
                    page--

                await getUsers(page).then(() => {isFind = false})
            }
        }


        const getUsers = async (pageNew = 0) => {

            if (pageNew === 0)
                page = 0

            isFind = true;

            login = login === ""?"none":login;
            name = name === ""?"none":name;
            surname = surname === ""?"none":surname;

            let result = await fetch(`/findPerson/${login}/${name}/${surname}/${pageNew}`);
            let jsonResult = await result.json();
            console.log(jsonResult.data);

            if (pageNew != 0 && jsonResult.data.length == 0){
                page -= 1;
                result = await fetch(`/findPerson/${login}/${name}/${surname}/${pageNew-1}`);
                jsonResult = await result.json();
            }

            let stringHtml = "";

            if (jsonResult.data.length !== 0){
                for (let item of jsonResult.data){
                    let block = `
                        <a href="/profile/${item.login}" class="block min-w-full bg-gray-600 p-5 rounded-md hover:scale-105 hover:bg-gray-500" href="/login">
                            <div class="text-left text-white text-lg">
                                Логин: <b>${item.login}</b>
                            </div>
                            <div class="text-left text-white text-lg">
                                Имя: <b>${item.name !== null?item.name:"Неизвестно"}</b>
                            </div>
                                <div class="text-left text-white text-lg">
                                Фамилия: <b>${item.surname !== null?item.surname:"Неизвестно"}</b>
                            </div>
                        </a>
                    `;
                    stringHtml += block;
                }

                stringHtml += `
                    <div class="flex flex-row justify-between gap-3">
                        <button class="bg-gray-600 w-1/2 rounded-lg p-2 text-white hover:bg-black" onclick="getUsersLast()">
                            Назад
                        </button>
                        <button class="bg-gray-600 w-1/2 rounded-lg text-white hover:bg-black" onclick="getUsersNext(1)">
                            Вперед
                        </button>
                    </div>
                `

            }
            else{
                stringHtml = `
                    <div class="text-center font-bold underline text-2xl">
                        По запросу ничего не найдено
                    </div>
                `
            }

            document.getElementById("blocks").innerHTML = stringHtml;
        }

        document.getElementById("findUsers").addEventListener("click", async () => { await getUsersNext(0) });
    </script>
@endsection
