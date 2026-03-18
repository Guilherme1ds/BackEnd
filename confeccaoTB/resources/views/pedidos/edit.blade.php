<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Editar Pedido</h2></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nome do Cliente</label>
                        <input type="text" name="nome_cliente" value="{{ old('nome_cliente', $pedido->nome_cliente) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('nome_cliente') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Produto</label>
                        <input type="text" name="produto_pedido" value="{{ old('produto_pedido', $pedido->produto_pedido) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('produto_pedido') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Quantidade</label>
                            <input type="number" name="quantidade_pedido" value="{{ old('quantidade_pedido', $pedido->quantidade_pedido) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('quantidade_pedido') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Data</label>
                            <input type="date" name="data" value="{{ old('data', $pedido->data->format('Y-m-d')) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('data') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Preço</label>
                        <input type="number" step="0.01" name="preco_pedido" value="{{ old('preco_pedido', $pedido->preco_pedido) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('preco_pedido') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md uppercase text-xs font-bold">Atualizar Pedido</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
