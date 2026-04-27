<x-layouts::admin>
    <div class="flex items-center justify-between mb-6">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.users.index') }}">Usuarios</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Nuevo</flux:breadcrumbs.item>

        </flux:breadcrumbs>

    </div>
    <div class="max-w-2xl mx-auto">
        <flux:card>
            <div>
                <flux:heading size="lg">Usuarios</flux:heading>
                <flux:subheading>Crea una nuevo usuario para acceder a tu blog y posteos.</flux:subheading>
            </div>

            <flux:separator variant="subtle" class="my-6" />

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <flux:field class="mb-4">
                    <flux:label>Nombre de usuario</flux:label>

                    <flux:input name="name" placeholder="Nombre de usuario..." required autofocus value="{{ old('name') }}"/>

                    <flux:error name="name" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:label>Correo electrónico</flux:label>

                    <flux:input name="email" placeholder="Correo electrónico..." required autofocus value="{{ old('email') }}"/>

                    <flux:error name="email" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:label>Password</flux:label>

                    <flux:input type="password" name="password" placeholder="Password..." required autofocus value="{{ old('password') }}"/>

                    <flux:error name="password" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:label>Confirmar contraseña</flux:label>

                    <flux:input type="password" name="password_confirmation" placeholder="Confirmar contraseña..." required autofocus value="{{ old('password_confirmation') }}"/>

                    <flux:error name="password_confirmation" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:heading size="lg" class="mt-4">Roles</flux:heading>

                    <flux:checkbox.group>
                        @foreach($roles as $role)
                            <flux:checkbox name="roles[]" value="{{ $role->id }}" label="{{ $role->name }}"></flux:checkbox>
                        @endforeach
                    </flux:checkbox.group>

                    <flux:error name="roles" />
                </flux:field>

                <div class="flex justify-end">
                    <flux:button type="submit" variant="primary" icon="plus">Crear usuario</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
</x-layouts::admin>


