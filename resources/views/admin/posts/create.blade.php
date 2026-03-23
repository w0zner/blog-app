<x-layouts::admin>
    <div class="flex items-center justify-between mb-6">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.posts.index') }}">Posts</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Nuevo</flux:breadcrumbs.item>

        </flux:breadcrumbs>

    </div>
    <div class="max-w-2xl mx-auto">
        <flux:card>
            <div>
                <flux:heading size="lg">Post</flux:heading>
                <flux:subheading>Crea un nuevo post para tu blog.</flux:subheading>
            </div>

            <flux:separator variant="subtle" class="my-6" />

            <form action="{{ route('admin.posts.store') }}" method="POST">
                @csrf

                <flux:field class="mb-4">
                    <flux:label>Titulo del post</flux:label>

                    <flux:input name="title" id="title" placeholder="Titulo del post..." oninput="string_to_slug(this.value, '#slug')" required autofocus value="{{ old('title') }}"/>

                    <flux:error name="title" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:label>Slug</flux:label>

                    <flux:input name="slug" id="slug" placeholder="Slug del post..." required autofocus value="{{ old('slug') }}"/>

                    <flux:error name="slug" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:label>Categoías</flux:label>

                    <flux:select size="sm" name="category_id" placeholder="Elige una categoría...">
                        @foreach ($categories as $category)
                            <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
                        @endforeach
                    </flux:select>

                    <flux:error name="slug" />
                </flux:field>

                <div class="flex justify-end">
                    <flux:button type="submit" variant="primary" icon="plus">Crear post</flux:button>
                </div>
            </form>
        </flux:card>
    </div>

    {{-- @push('js')
        <script>

        </script>
    @endpush --}}
</x-layouts::admin>


