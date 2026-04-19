<x-layouts::app>
    <ul class="space-y-4 mb-4">
        @foreach ($posts as $post)
            <li>
                <article class="p-4 bg-dark rounded-lg shadow-md">
                    <div class="items-center space-x-4 mb-4">
                        <img src="{{ $post->image }}" alt="" class="h-72 w-full object-cover object-center rounded">
                        <div class="px-6 py-2">
                             <h2 class="text-2xl font-bold">
                                <a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a>
                            </h2>
                        </div>

                        <div class="px-6 py-2">
                            {{ $post->excerpt }}
                        </div>

                        <p class="text-sm text-gray-500 px-6">
                            Publicado {{ $post->published_at->format('F j, Y') }}
                        </p>
                    </div>
                </article>
            </li>
        @endforeach
    </ul>
    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</x-layouts::app>
