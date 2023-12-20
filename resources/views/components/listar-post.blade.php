<div>
    @if($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach($posts as $post)
                <div class="">
                    <a href="{{ route('post.show', [$post->user, $post ]) }}" class="">
                        <img src="{{ asset('uploads/' . $post->image) }}"
                             alt="Image post {{ $post->title }}">
                    </a>
                </div>
            @endforeach
        </div>

        <div class="">
{{--            {{ $posts->links('pagination::tailwind') }}--}}
        </div>

    @else
        <p class="">No hay post</p>
    @endif
</div>
