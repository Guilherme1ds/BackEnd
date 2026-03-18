<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cadastrar Item de Estoque</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('estoque.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Produto</label>
                            <input type="text" name="produto" class="form-input mt-1 w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Quantidade</label>
                            <input type="number" name="quantidade" class="form-input mt-1 w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Preço de Custo</label>
                            <input type="number" step="0.01" name="preco_custo" class="form-input mt-1 w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Preço de Venda</label>
                            <input type="number" step="0.01" name="preco_venda" class="form-input mt-1 w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Estoque Mínimo</label>
                            <input type="number" name="estoque_minimo" class="form-input mt-1 w-full" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
