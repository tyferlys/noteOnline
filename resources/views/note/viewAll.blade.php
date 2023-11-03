@extends("layout.app")

@section("main")
    <main class="flex flex-col justify-start w-5/6 m-auto mb-16 min-h-[80vh]">
        <div class="md:text-4xl text-3xl font-light mt-16 md:text-left text-center mb-4">
            Все заметки, {{$user->login}}
        </div>
        <div class="flex flex-row md:justify-start justify-center">
            <a href="{{route("profile.view", $user->login)}}" class="block md:w-2/6 mb-10 bg-gray-600 text-white p-3 w-4/6 text-center rounded-lg">
                Вернуться к профилю
            </a>
        </div>

        <div class="grid md:grid-cols-2 grid-cols-1 gap-3">
            @foreach($user->notes as $note)
                @include("component.note", [
                    "note" => $note,
                ])
            @endforeach
        </div>
    </main>
@endsection
