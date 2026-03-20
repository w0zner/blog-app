<x-layouts::admin>
    <div class="flex items-center justify-between mb-6">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Posts</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <flux:button href="{{ route('admin.posts.create') }}" variant="primary" icon="plus">Nuevo Post</flux:button>
    </div>

    <flux:table class="p-2">
        <flux:table.columns>
            <flux:table.column>ID</flux:table.column>
            <flux:table.column>Nombre</flux:table.column>
            <flux:table.column>Publicado</flux:table.column>
            {{-- <flux:table.column>Fecha de Creación</flux:table.column> --}}
            <flux:table.column>Acciones</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($posts as $post)
                <flux:table.row :key="$post->id">
                    <flux:table.cell>{{ $post->id }}</flux:table.cell>
                    <flux:table.cell class="font-medium">{{ $post->title }}</flux:table.cell>
                    <flux:table.cell>
                        @if ($post->is_published)
                            {{-- <flux:badge color="green">Sí</flux:badge> --}}
                            <flux:button type="submit" size="sm" variant="primary" color="emerald">
                                Si
                            </flux:button>
                        @else
                            {{-- <flux:badge color="red">No</flux:badge> --}}
                            <flux:button type="submit" size="sm" variant="filled" color="red">
                                No
                            </flux:button>
                        @endif
                    </flux:table.cell>
                    {{-- <flux:table.cell>{{ $post->created_at->format('d/m/Y H:i') }}</flux:table.cell> --}}
                    <flux:table.cell>
                        <div class="flex gap-2">
                            <flux:button :href="route('admin.posts.edit', $post)" size="sm" variant="subtle" icon="pencil-square" />

                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="confirmDelete(event)">
                                @csrf
                                @method('DELETE')
                                <flux:button type="submit" size="sm" variant="subtle" icon="trash" color="danger"/>
                            </form>
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
        <x-slot name="footer">
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </x-slot>
    </flux:table>

    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Evita el envío del formulario

             Swal.fire({
                title: "Confirmación",
                text: "¿Estás seguro de eliminar este post?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Sí, eliminar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit(); // Envía el formulario si se confirma


                }
            });
        }

    </script>

</x-layouts::admin>



