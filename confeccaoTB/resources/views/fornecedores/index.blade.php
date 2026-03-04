<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Fornecedores</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left">Nome</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">CNPJ</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Telefone</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Endereço</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fornecedores as $fornecedor)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{ $fornecedor->nome }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $fornecedor->cnpj }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $fornecedor->email }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $fornecedor->telefone }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $fornecedor->endereco }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="border border-gray-300 px-4 py-2 text-center text-gray-500">Nenhum fornecedor encontrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>