<x-layouts::admin>
    <div class="flex items-center justify-between mb-6">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.users.index') }}">Usuarios</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar usuario {{ $user->name }}</flux:breadcrumbs.item>

        </flux:breadcrumbs>

    </div>
    <div class="max-w-2xl mx-auto">
        <flux:card>
            <div>
                <flux:heading size="lg">Usuarios</flux:heading>
                <flux:subheading>Editar el usuario {{ $user->name }} para acceder al panel de administración.</flux:subheading>
            </div>

            <flux:separator variant="subtle" class="my-6" />

            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <flux:field class="mb-4">
                    <flux:label>Nombre del usuario</flux:label>

                    <flux:input name="name" placeholder="Nombre de usuario..." required autofocus value="{{ old('name', $user->name) }}"/>

                    <flux:error name="name" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:label>Correo electrónico</flux:label>

                    <flux:input name="email" placeholder="Correo electrónico..." required autofocus value="{{ old('email', $user->email) }}"/>

                    <flux:error name="email" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:label>Password</flux:label>

                    <flux:input type="password" name="password" placeholder="Password..." autofocus value="{{ old('password') }}"/>

                    <flux:error name="password" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:label>Confirmar contraseña</flux:label>

                    <flux:input type="password" name="password_confirmation" placeholder="Confirmar contraseña..." autofocus value="{{ old('password_confirmation') }}"/>

                    <flux:error name="password_confirmation" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:heading size="lg" class="mt-4">Roles</flux:heading>

                    <flux:checkbox.group>
                        @foreach($roles as $role)
                            <flux:checkbox name="roles[]" value="{{ $role->id }}" label="{{ $role->name }}" 
                                :checked="in_array($role->id, old('roles', $userRoles))"></flux:checkbox>
                        @endforeach
                    </flux:checkbox.group>

                    <flux:error name="roles" />
                </flux:field>

                <div class="flex justify-end">
                    <flux:button type="submit" variant="primary" icon="plus">Editar usuario</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
</x-layouts::admin>


