<x-layouts::admin>
    <div class="flex items-center justify-between mb-6">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Permisos</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <flux:button href="{{ route('admin.permissions.create') }}" variant="primary" icon="plus">Nuevo Permiso</flux:button>
    </div>`

        <flux:table :rows="$permissions" class="p-2">
        <flux:table.columns>
            <flux:table.column>ID</flux:table.column>
            <flux:table.column>Nombre</flux:table.column>
            {{-- <flux:table.column>Fecha de Creación</flux:table.column> --}}
            <flux:table.column>Acciones</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($permissions as $permission)
                <flux:table.row :key="$permission->id">
                    <flux:table.cell>{{ $permission->id }}</flux:table.cell>
                    <flux:table.cell class="font-medium">{{ $permission->name }}</flux:table.cell>
                    {{-- <flux:table.cell>{{ $permission->created_at->format('d/m/Y H:i') }}</flux:table.cell> --}}
                    <flux:table.cell>
                        <div class="flex gap-2">
                            <flux:button :href="route('admin.permissions.edit', $permission)" size="sm" variant="subtle" icon="pencil-square" />

                            <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" onsubmit="confirmDelete(event)">
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

    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Evita el envío del formulario

             Swal.fire({
                title: "Confirmación",
                text: "¿Estás seguro de eliminar este permiso?",
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
