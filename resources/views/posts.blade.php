@foreach ($posts as $post)
    @dd()
    <article>
        <h1>
            <a href="/posts/{{$post->slug}}">
                {{$post->title}}
            </a>
        </h1>

        <p>
            {{ $post->excerpt }}
        </p>
    </article>
@endforeach
