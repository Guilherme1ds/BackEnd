<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Editar Item de Estoque</h2></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('estoque.update', $estoque->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Produto</label>
                        <input type="text" name="produto" value="{{ old('produto', $estoque->produto) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('produto') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Quantidade</label>
                            <input type="number" name="quantidade" value="{{ old('quantidade', $estoque->quantidade) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('quantidade') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Preço de Custo</label>
                            <input type="number" step="0.01" name="preco_custo" value="{{ old('preco_custo', $estoque->preco_custo) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('preco_custo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Preço de Venda</label>
                            <input type="number" step="0.01" name="preco_venda" value="{{ old('preco_venda', $estoque->preco_venda) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('preco_venda') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Estoque Mínimo</label>
                        <input type="number" name="estoque_minimo" value="{{ old('estoque_minimo', $estoque->estoque_minimo) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('estoque_minimo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md uppercase text-xs font-bold">Atualizar Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
