<x-layouts::admin>
    <div class="flex items-center justify-between mb-6">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Categorías</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <flux:button href="{{ route('admin.categories.create') }}" variant="primary" icon="plus">Nueva Categoría</flux:button>
    </div>

    <flux:table :rows="$categories" class="p-2">
        <flux:table.columns>
            <flux:table.column>ID</flux:table.column>
            <flux:table.column>Nombre</flux:table.column>
            {{-- <flux:table.column>Fecha de Creación</flux:table.column> --}}
            <flux:table.column>Acciones</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($categories as $category)
                <flux:table.row :key="$category->id">
                    <flux:table.cell>{{ $category->id }}</flux:table.cell>
                    <flux:table.cell class="font-medium">{{ $category->name }}</flux:table.cell>
                    {{-- <flux:table.cell>{{ $category->created_at->format('d/m/Y H:i') }}</flux:table.cell> --}}
                    <flux:table.cell>
                        <div class="flex gap-2">
                            <flux:button :href="route('admin.categories.edit', $category)" size="sm" variant="subtle" icon="pencil-square" />

                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')">
                                @csrf
                                @method('DELETE')
                                <flux:button type="submit" size="sm" variant="subtle" icon="trash" color="danger"/>
                            </form>
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</x-layouts::admin>



