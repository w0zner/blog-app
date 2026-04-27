<x-layouts::admin>
    <div class="flex items-center justify-between mb-6">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.roles.index') }}">Roles</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Nuevo</flux:breadcrumbs.item>

        </flux:breadcrumbs>

    </div>
    <div class="max-w-2xl mx-auto">
        <flux:card>
            <div>
                <flux:heading size="lg">Roles</flux:heading>
                <flux:subheading>Crea un nuevo rol para gestionar los accesos.</flux:subheading>
            </div>

            <flux:separator variant="subtle" class="my-6" />

            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf

                <flux:field class="mb-4">
                    <flux:label>Nombre del rol</flux:label>

                    <flux:input name="name" placeholder="Nombre del rol..." required autofocus value="{{ old('name') }}"/>

                    <flux:error name="name" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:heading size="lg" class="mt-4">Permisos</flux:heading>

                    <flux:checkbox.group>
                        @foreach($permissions as $permission)
                            <flux:checkbox name="permissions[]" value="{{ $permission->id }}" label="{{ $permission->name }}"></flux:checkbox>
                        @endforeach
                    </flux:checkbox.group>

                    <flux:error name="permissions" />
                </flux:field>

                <div class="flex justify-end">
                    <flux:button type="submit" variant="primary" icon="plus">Crear rol</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
</x-layouts::admin>


{{-- <flux:table>
                            <flux:table.columns>
                                <flux:table.column>Nombre Permiso</flux:table.column>
                                <flux:table.column>Acción</flux:table.column>
                            </flux:table.columns>

                            <flux:table.rows>
                                @foreach($permissions as $permission)
                                <flux:table.row>
                                    <flux:table.cell>{{ $permission->name }}</flux:table.cell>
                                    <flux:table.cell><flux:badge color="green" size="sm" inset="top bottom">Paid</flux:badge></flux:table.cell>
                                </flux:table.row>
                            @endforeach


                            </flux:table.rows>
                        </flux:table> --}}

                        {{-- <flux:select name="permissions[]" multiple>
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </flux:select> --}}
