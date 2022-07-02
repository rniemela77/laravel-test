<x-layout>
    <h1>{{$post->title}}</h1>

    <p>
        <a href="/categories/{{$post->category->id}}">{{ $post->category->name }}</a>
    </p>

    <p>{!!$post->body!!}</p>

    <a href="/">Go Back</a>
</x-layout>
