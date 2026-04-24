<x-layouts::admin>
    <div class="flex items-center justify-between mb-6">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.permissions.index') }}">Permisos</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>

        </flux:breadcrumbs>

    </div>
    <div class="max-w-2xl mx-auto">
        <flux:card>
            <div>
                <flux:heading size="lg">Permisos</flux:heading>
                <flux:subheading>Editar un permiso existente.</flux:subheading>
            </div>

            <flux:separator variant="subtle" class="my-6" />

            <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
                @csrf
                @method('PUT')

                <flux:field class="mb-4">
                    <flux:label>Nombre del permiso</flux:label>

                    <flux:input name="name" placeholder="Nombre del permiso..." required autofocus value="{{ old('name', $permission->name) }}"/>

                    <flux:error name="name" />
                </flux:field>

                <div class="flex justify-end">
                    <flux:button type="submit" variant="primary" icon="plus">Editar permiso</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
</x-layouts::admin>


