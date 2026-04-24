<x-layouts::admin>
    <div class="flex items-center justify-between mb-6">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Roles</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <flux:button href="{{ route('admin.roles.create') }}" variant="primary" icon="plus">Nueva rol</flux:button>
    </div>

    <flux:table :rows="$roles" class="p-2">
        <flux:table.columns>
            <flux:table.column>ID</flux:table.column>
            <flux:table.column>Nombre</flux:table.column>
            {{-- <flux:table.column>Fecha de Creación</flux:table.column> --}}
            <flux:table.column>Acciones</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($roles as $role)
                <flux:table.row :key="$role->id">
                    <flux:table.cell>{{ $role->id }}</flux:table.cell>
                    <flux:table.cell class="font-medium">{{ $role->name }}</flux:table.cell>
                    {{-- <flux:table.cell>{{ $role->created_at->format('d/m/Y H:i') }}</flux:table.cell> --}}
                    <flux:table.cell>
                        <div class="flex gap-2">
                            <flux:button :href="route('admin.roles.edit', $role)" size="sm" variant="subtle" icon="pencil-square" />

                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" onsubmit="confirmDelete(event)">
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
                text: "¿Estás seguro de eliminar el rol?",
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



