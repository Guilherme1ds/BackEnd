<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Produtos</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left">Nome</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Descrição</th>
                            <th class="border border-gray-300 px-4 py-2 text-right">Preço</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Estoque</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Ativo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produtos as $produto)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{ $produto->nome }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $produto->descricao }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-right">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $produto->quantidade_estoque }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $produto->ativo ? 'Sim' : 'Não' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="border border-gray-300 px-4 py-2 text-center text-gray-500">Nenhum produto encontrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>