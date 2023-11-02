@extends("auth.app")

@section("mainAuth")
    <main class="min-w-full flex flex-col my-6">
        <div class="lg:w-2/6 w-5/6 m-auto bg-white rounded-xl flex flex-col gap-0 p-5 box">
            <div class="text-center text-2xl p-2">Регистрация</div>

            <form class="flex flex-col md:p-8 p-3 gap-8" action="{{route("login.store")}}" method="post">
                @csrf
                @method("post")

                <div class="min-w-full flex flex-col gap-2">
                    <div class="text-lg">Логин:</div>
                    <input type="text" name="login" placeholder="Введите логин" value="{{old("login")}}"
                           class="transition min-w-full border-gray-600 border-2 rounded-lg outline-none p-1 hover:scale-105 focus:scale-105"/>
                    <span class="text-red-500 text-md">
                        @error("login")
                        {{ $errors->first('login') }}
                        @enderror
                    </span>
                </div>

                <div class="min-w-full flex flex-col gap-2">
                    <div class="text-lg">Пароль:</div>
                    <input type="password" name="password" placeholder="Введите пароль"
                           class="transition min-w-full border-gray-600 border-2 rounded-lg outline-none p-1 hover:scale-105 focus:scale-105"/>

                    <span class="text-red-500 text-md">
                        @error("password")
                        {{ $errors->first('password') }}
                        @enderror
                    </span>
                </div>

                <div class="min-w-full flex flex-col gap-2">
                    <div class="text-lg">Повторите пароль:</div>
                    <input type="password" name="passwordRepeat" placeholder="Введите пароль"
                           class="transition min-w-full border-gray-600 border-2 rounded-lg outline-none p-1 hover:scale-105 focus:scale-105"/>

                    <span class="text-red-500 text-md">
                        @error("passwordRepeat")
                        {{ $errors->first('passwordRepeat') }}
                        @enderror
                    </span>

                    <div class="flex flex-row justify-between">
                        <a href="{{route("login.index")}}" class="underline transition hover:text-gray-600">Есть аккаунт?</a>
                    </div>
                </div>

                <input type="submit" value="Зарегистрироваться" class="transition md:text-lg bg-gray-800 w-2/3 m-auto hover:bg-gray-600 text-white p-2 rounded-lg"/>
            </form>
        </div>
    </main>
@endsection
