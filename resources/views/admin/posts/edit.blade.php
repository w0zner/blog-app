<x-layouts::admin>
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
                        label="Resumen del post"
                        name="excerpt"
                        rows="3"
                        placeholder="Resumen del post..."
                    >{{ old('excerpt', $post->excerpt) }}</flux:textarea>

                    <flux:error name="excerpt" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:textarea
                        label="Contenido"
                        name="content"
                        rows="10"
                        placeholder="Contenido del post..."
                    >{{ old('content', $post->content) }}</flux:textarea>

                    <flux:error name="content" />
                </flux:field>

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
            </form>
        </flux:card>
    </div>
</x-layouts::admin>


