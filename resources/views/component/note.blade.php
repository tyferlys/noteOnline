<a href="{{route("note.view", $note->id)}}" class="hover:bg-gray-500 transition min-w-full flex flex-col gap-5 bg-gray-600 hover:scale-105 text-white p-6 rounded-lg">
    <div class="text-center text-xl font-bold underline">{{$note->user->login}}</div>
    <div class="text-center text-xl">{{$note->title}}</div>
    <div class="text-center text-md">{{$note->updated_at}}</div>
    <div class="text-center text-sm">Лайков - {{count($note->likes)}}</div>
</a>
