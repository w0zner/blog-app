<x-layouts::admin>
    <flux:card class="space-y-8">
        <div>
            <flux:heading size="lg">Categorías</flux:heading>
            <flux:text class="mt-2"></flux:text>
        </div>
        <div class="space-y-6">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                
                <flux:field class=" mb-2">
                    <flux:label>Nombre</flux:label>

                    <flux:input name="name" required autofocus />

                    <flux:error name="username" />
                </flux:field>
                
                <flux:button type="submit" variant="primary" icon="plus">Crear Categoría</flux:button>
            </form>
        </div>
        
    </flux:card>

    
</x-layouts::admin>


