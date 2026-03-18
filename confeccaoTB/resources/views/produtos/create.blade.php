<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cadastrar Produto</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('produtos.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Nome</label>
                            <input type="text" name="nome" class="form-input mt-1 w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Descrição</label>
                            <input type="text" name="descricao" class="form-input mt-1 w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Preço</label>
                            <input type="number" step="0.01" name="preco" class="form-input mt-1 w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Quantidade em Estoque</label>
                            <input type="number" name="quantidade_estoque" class="form-input mt-1 w-full" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
