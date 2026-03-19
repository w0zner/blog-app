<x-layouts::admin>
    <div class="max-w-2xl mx-auto">
        <flux:card>
            <div>
                <flux:heading size="lg">Categorías</flux:heading>
                <flux:subheading>Crea una nueva categoría para organizar tus posteos.</flux:subheading>
            </div>

            <flux:separator variant="subtle" class="my-6" />

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <flux:field class="mb-4">
                    <flux:label>Nombre de la categoría</flux:label>

                    <flux:input name="name" placeholder="Nombre de la categoría..." required autofocus value="{{ old('name') }}"/>

                    <flux:error name="name" />
                </flux:field>

                <div class="flex justify-end">
                    <flux:button type="submit" variant="primary" icon="plus">Crear categoría</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
</x-layouts::admin>


