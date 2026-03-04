`<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Estoque</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left">Produto</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Quantidade</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Localização</th>
                            <th class="border border-gray-300 px-4 py-2 text-right">Preço Custo</th>
                            <th class="border border-gray-300 px-4 py-2 text-right">Preço Venda</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Mínimo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($estoque as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{ $item->produto }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $item->quantidade }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->localizacao }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-right">R$ {{ number_format($item->preco_custo, 2, ',', '.') }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-right">R$ {{ number_format($item->preco_venda, 2, ',', '.') }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $item->estoque_minimo }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border border-gray-300 px-4 py-2 text-center text-gray-500">Nenhum item em estoque</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>`