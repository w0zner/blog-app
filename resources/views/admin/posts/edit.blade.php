<x-layouts::admin>

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        {{-- <style>
            .ql-toolbar.ql-snow, .ql-container.ql-snow {
            background-color: #232323;
            color: #fff;
            border: 1px solid #444;
            }
            .ql-snow .ql-stroke { stroke: #fff; }
            .ql-snow .ql-fill { fill: #fff; }
            .ql-snow .ql-picker { color: #fff; }
            .ql-snow .ql-picker-options {
                background-color: #050607 !important;
                border-color: #555555 !important;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5);
            }

            .ql-snow .ql-picker-item {
                color: #d1d5db !important;
            }

            .ql-snow .ql-picker-item:hover {
                color: #ffffff !important;
                background-color: #5c5c5c;
            }

        </style> --}}
    @endpush

    <div class="flex items-center justify-between mb-6">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.posts.index') }}">Posts</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>

        </flux:breadcrumbs>

    </div>
    <div class="max-w-5xl mx-auto">
        <flux:card>
            <div>
                <flux:heading size="lg">Post</flux:heading>
                <flux:subheading>Editar un post existente para tu blog.</flux:subheading>
            </div>

            <flux:separator variant="subtle" class="my-6" />

            <form action="{{ route('admin.posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="relative flex justify-center mb-2">
                    <img src="https://t3.ftcdn.net/jpg/10/22/24/80/360_F_1022248039_7LDxHRi3Mlt9BK3wzLBUGZp9XAO1gt2s.jpg" id="imgPreview"  alt="" class="w-full h-100 object-cover rounded object-centermb-6">

                    <div class="absolute top-8 right-8">
                        <label class="text-black bg-white px-4 py-2 rounded-lg cursor-pointer">
                            Cambiar imagen
                            <input class="hidden" type="file" name="image" accept="image/*" onchange="preview_image(event, '#imgPreview')">
                        </label>
                    </div>
                </div>

                <div>
                    <flux:field class="mb-4">
                        <flux:label>Titulo del post</flux:label>

                        <flux:input name="title" id="title" placeholder="Titulo del post..." oninput="string_to_slug(this.value, '#slug')" required autofocus value="{{ old('title', $post->title) }}"/>

                        <flux:error name="title" />
                    </flux:field>

                    <flux:field class="mb-4">
                        <flux:label>Slug</flux:label>

                        <flux:input name="slug" id="slug" placeholder="Slug del post..." required autofocus value="{{ old('slug', $post->slug) }}"/>

                        <flux:error name="slug" />
                    </flux:field>

                    <flux:field class="mb-4">
                        <flux:label>Categoías</flux:label>

                        <flux:select size="sm" name="category_id" placeholder="Elige una categoría...">
                            @foreach ($categories as $category)
                                <flux:select.option value="{{ $category->id }}" :selected="$category->id == old('category_id', $post->category_id)">{{ $category->name }}</flux:select.option>
                            @endforeach
                        </flux:select>

                        <flux:error name="slug" />
                    </flux:field>

                    <flux:field class="mb-4">
                        <flux:textarea
                            label="Resumen"
                            name="excerpt"
                            rows="3"
                            placeholder="Resumen del post..."
                        >{{ old('excerpt', $post->excerpt) }}</flux:textarea>

                        <flux:error name="excerpt" />
                    </flux:field>

                    {{-- <flux:field class="mb-4">
                        <flux:textarea
                            label="Contenido"
                            name="content"
                            rows="10"
                            placeholder="Contenido del post..."
                        >{{ old('content', $post->content) }}</flux:textarea>

                        <flux:error name="content" />
                    </flux:field> --}}

                    <div class="mb-4">
                        <p class="font-medium text-sm mb-1">Etiquetas</p>

                        <select id="tags" name="tags[]" class="w-full rounded border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" multiple="multiple">
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}" >
                                    {{$tag->name}}
                                </option>    
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <p class="font-medium text-sm mb-1">Contenido</p>
                        <div id="editor" class="mb-4">
                            {!! old('content', $post->content) !!}
                        </div>
                        <textarea name="content" id="content" class="hidden">{{ old('content', $post->content) }}</textarea>
                    </div>

                    <div>
                        <p class="text-sm font-semibold">Estado</p>

                        <label>
                            <input type="radio" name="is_published" value="1" @checked(old('is_published', $post->is_published) == 1)>
                            Publicado
                        </label>
                        <label>
                            <input type="radio" name="is_published" value="0" @checked(old('is_published', $post->is_published) == 0)>
                            No publicado
                        </label>
                    </div>

                    <div class="flex justify-end">
                        <flux:button type="submit" variant="primary" icon="plus">Guardar post</flux:button>
                    </div>
                </div>
            </form>
        </flux:card>
    </div>

    @push("js")
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

        <script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous">
        </script>

        <script>
             $(document).ready(function() {
                $('#tags').select2({
                    tags: true
                });
            });

            $('#mySelect').select2({
    theme: 'bootstrap-5' // This will inherit colors if your wrapper is dark
});


        </script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            const quill = new Quill('#editor', {
                theme: 'snow'
            });

            quill.on('text-change', function() {
                document.querySelector('#content').value = quill.root.innerHTML;
            });
        </script>
    @endpush

</x-layouts::admin>


