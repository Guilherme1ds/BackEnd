`<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pedidos</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left">Cliente</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Produto</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Quantidade</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Data</th>
                            <th class="border border-gray-300 px-4 py-2 text-right">Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pedidos as $pedido)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{ $pedido->nome_cliente }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $pedido->produto_pedido }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $pedido->quantidade_pedido }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $pedido->data->format('d/m/Y') }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-right font-bold">R$ {{ number_format($pedido->preco_pedido, 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="border border-gray-300 px-4 py-2 text-center text-gray-500">Nenhum pedido encontrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>`