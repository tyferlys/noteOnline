@extends("layout.app")

@section("main")
    <main class="flex flex-col w-5/6 m-auto mb-16">
        <div class="flex flex-col gap-6 justify-between mt-16 items-center min-w-full">
            <div class="md:text-3xl text-2xl font-light underline">
                Добро пожаловать, {{$login}}
            </div>
            <form class="md:w-3/6 w-full flex flex-row gap-3" action="{{route("notesAll.view", 1)}}" method="get">
                @csrf
                @method("get")
                <input type="text" placeholder="Найти заметку" name="text"
                       class="transition hover:scale-105 focus:scale-105 block w-4/6 p-2 rounded-xl border-2 border-gray-400 outline-none"/>
                <input type="submit" value="Найти" class="transition block w-2/6 p-2 rounded-xl bg-gray-800 hover:bg-gray-600 text-white"/>
            </form>
        </div>

        <div class="flex flex-col gap-10 mt-16 min-w-full">
            <div class="flex flex-col min-w-full">
                <div class="md:text-4xl text-3xl md:text-left text-center font-light">
                    Последние заметки:
                </div>

                <div class="grid md:grid-cols-3 grid-cols-1 gap-5 min-w-full m-auto mt-6">
                    @foreach($notes as $note)
                        <a href="{{route("note.view", $note->id)}}" class="hover:bg-gray-500 transition min-w-full flex flex-col gap-5 bg-gray-600 hover:scale-105 text-white p-6 rounded-lg">
                            <div class="text-center text-xl font-bold underline">{{$note->user->login}}</div>
                            <div class="text-center text-xl">{{$note->title}}</div>
                            <div class="text-center text-md">{{$note->updated_at}}</div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col gap-10 min-w-full">
                <div class="md:text-4xl text-3xl md:text-left text-center font-light">
                    Пользователи:
                </div>

                <div class="min-w-full bg-white rounded-xl p-5 flex md:flex-row flex-col md:items-start items-center gap-10">
                    <form class="md:w-2/6 w-5/6 flex flex-col items-stretch gap-5">
                        <div class="text-xl min-w-full text-center underline">Поиск пользователей:</div>

                        <div class="md:w-5/6 w-full m-auto flex flex-col gap-2">
                            <div class="">Логин:</div>
                            <input type="text" placeholder="Никнейм пользователя" name="login"
                                   class="transition hover:scale-105 focus:scale-105 text-center block min-w-full  p-1 rounded-xl border-2 border-gray-400 outline-none"/>
                        </div>

                        <div class="md:w-5/6 w-full m-auto flex flex-col gap-2">
                            <div class="">Имя:</div>
                            <input type="text" placeholder="Имя" name="name"
                                   class="transition hover:scale-105 focus:scale-105 text-center block min-w-full  p-1 rounded-xl border-2 border-gray-400 outline-none"/>
                        </div>

                        <div class="md:w-5/6 w-full m-auto flex flex-col gap-2">
                            <div class="">Фамилия:</div>
                            <input type="text" placeholder="Фамилия" name="surname"
                                   class="transition hover:scale-105 focus:scale-105 text-center block min-w-full  p-1 rounded-xl border-2 border-gray-400 outline-none"/>
                        </div>

                        <div class="flex flex-row gap-2 md:w-5/6 w-full m-auto">
                            <input type="button" id="findUsers" value="Найти" class="transition block w-3/6 p-2 rounded-xl bg-gray-800 text-white hover:bg-gray-600"/>
                            <input type="reset" value="Очистить" class="transition block w-3/6 p-2 rounded-xl bg-gray-800 text-white hover:bg-gray-600"/>
                        </div>
                    </form>

                    <div class="md:w-4/6 w-5/6 flex flex-col gap-5">
                        <div class="text-xl min-w-full text-center underline">Результат поиска:</div>

                        <div class="flex flex-col gap-5" id="blocks">
                            <div class="text-center underline font-bold md:text-2xl text-xl">
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
                        <a href="/profile/${item.login}" class="transition block min-w-full bg-gray-600 p-5 rounded-md hover:scale-105 hover:bg-gray-500" href="/login">
                            <div class="text-left text-white md:text-lg">
                                Логин: <b>${item.login}</b>
                            </div>
                            <div class="text-left text-white md:text-lg">
                                Имя: <b>${item.name !== null?item.name:"Неизвестно"}</b>
                            </div>
                                <div class="text-left text-white md:text-lg">
                                Фамилия: <b>${item.surname !== null?item.surname:"Неизвестно"}</b>
                            </div>
                        </a>
                    `;
                    stringHtml += block;
                }

                stringHtml += `
                    <div class="flex flex-row justify-between gap-3">
                        <button class="transition bg-gray-800 w-1/2 rounded-lg p-2 text-white hover:bg-gray-600" onclick="getUsersLast()">
                            Назад
                        </button>
                        <button class="transition bg-gray-800 w-1/2 rounded-lg text-white hover:bg-gray-600" onclick="getUsersNext(1)">
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
