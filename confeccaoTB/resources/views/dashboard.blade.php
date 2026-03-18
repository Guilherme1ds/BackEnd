<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="flex justify-center mb-2">
                        <!-- Ícone de usuário para clientes -->
                        <svg class="h-8 w-8 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div class="text-3xl font-bold text-indigo-600">{{ $clientesCount }}</div>
                    <div class="mt-2 text-gray-700">Clientes cadastrados</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="flex justify-center mb-2">
                        <!-- Ícone de caixa para produtos -->
                        <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4a2 2 0 001-1.73z"/><path stroke-linecap="round" stroke-linejoin="round" d="M3.27 6.96L12 12.01l8.73-5.05"/></svg>
                    </div>
                    <div class="text-3xl font-bold text-green-600">{{ $produtosCount }}</div>
                    <div class="mt-2 text-gray-700">Produtos cadastrados</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="flex justify-center mb-2">
                        <!-- Ícone de prateleira/estoque -->
                        <svg class="h-8 w-8 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect width="20" height="8" x="2" y="4" rx="2"/><rect width="20" height="8" x="2" y="12" rx="2"/></svg>
                    </div>
                    <div class="text-3xl font-bold text-yellow-600">{{ $estoqueCount }}</div>
                    <div class="mt-2 text-gray-700">Itens em estoque</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="flex justify-center mb-2">
                        <!-- Ícone de handshake para fornecedores -->
                        <svg class="h-8 w-8 text-pink-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15l-3.5-3.5a2.121 2.121 0 010-3l3.5-3.5a2.121 2.121 0 013 0l3.5 3.5a2.121 2.121 0 010 3L15 15a2.121 2.121 0 01-3 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M8.5 8.5l7 7"/></svg>
                    </div>
                    <div class="text-3xl font-bold text-pink-600">{{ $fornecedoresCount }}</div>
                    <div class="mt-2 text-gray-700">Fornecedores cadastrados</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="flex justify-center mb-2">
                        <!-- Ícone de documento para pedidos -->
                        <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8H6a2 2 0 01-2-2V6a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div class="text-3xl font-bold text-blue-600">{{ $pedidosCount }}</div>
                    <div class="mt-2 text-gray-700">Pedidos cadastrados</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
