<x-layouts::admin>
    <div class="flex items-center justify-between mb-6">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.roles.index') }}">Roles</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>

        </flux:breadcrumbs>

    </div>
    <div class="max-w-2xl mx-auto">
        <flux:card>
            <div>
                <flux:heading size="lg">Roles</flux:heading>
                <flux:subheading>Editar un rol existente.</flux:subheading>
            </div>

            <flux:separator variant="subtle" class="my-6" />

            <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')

                <flux:field class="mb-4">
                    <flux:label>Nombre del rol</flux:label>

                    <flux:input name="name" placeholder="Nombre del rol..." required autofocus value="{{ old('name', $role->name) }}"/>

                    <flux:error name="name" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:heading size="lg" class="mt-4">Permisos</flux:heading>

                     <flux:checkbox.group  class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($permissions as $permission)
                            <flux:checkbox name="permissions[]" value="{{ (string) $permission->id }}" label="{{ $permission->name }}"
                                :checked="in_array($permission->id, old('permissions', $rolePermissions))"></flux:checkbox>
                        @endforeach
                    </flux:checkbox.group>
                    <flux:error name="permissions" />
                </flux:field>

                <div class="flex justify-end">
                    <flux:button type="submit" variant="primary" icon="plus">Editar rol</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
</x-layouts::admin>


