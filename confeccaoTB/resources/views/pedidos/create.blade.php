<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cadastrar Pedido</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('pedidos.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Nome do Cliente</label>
                            <input type="text" name="nome_cliente" class="form-input mt-1 w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Produto</label>
                            <input type="text" name="produto_pedido" class="form-input mt-1 w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Quantidade</label>
                            <input type="number" name="quantidade_pedido" class="form-input mt-1 w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Data</label>
                            <input type="date" name="data" class="form-input mt-1 w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Preço</label>
                            <input type="number" step="0.01" name="preco_pedido" class="form-input mt-1 w-full" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
