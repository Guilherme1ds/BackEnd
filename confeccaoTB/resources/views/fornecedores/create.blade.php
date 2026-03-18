<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cadastrar Fornecedor</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('fornecedores.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Nome</label>
                            <input type="text" name="nome" class="form-input mt-1 w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">CNPJ</label>
                            <input type="text" name="cnpj" value="{{ old('cnpj') }}" data-mask="cnpj" inputmode="numeric" maxlength="18" class="form-input mt-1 w-full" required>
                            <span class="text-xs text-slate-500">Formato: 00.000.000/0000-00</span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Email</label>
                            <input type="email" name="email" class="form-input mt-1 w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Telefone</label>
                            <input type="text" name="telefone" value="{{ old('telefone') }}" data-mask="phone" inputmode="tel" maxlength="15" class="form-input mt-1 w-full" required>
                            <span class="text-xs text-slate-500">Formato: (99) 99999-9999</span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700">Endereço</label>
                            <input type="text" name="endereco" class="form-input mt-1 w-full">
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
