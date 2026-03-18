<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Editar Fornecedor</h2></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('fornecedores.update', $fornecedor->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" name="nome" value="{{ old('nome', $fornecedor->nome) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('nome') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">CNPJ</label>
                        <input type="text" name="cnpj" value="{{ old('cnpj', $fornecedor->cnpj) }}" data-mask="cnpj" inputmode="numeric" maxlength="18" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <span class="text-xs text-gray-500">Formato: 00.000.000/0000-00</span>
                        @error('cnpj') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $fornecedor->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Telefone</label>
                        <input type="text" name="telefone" value="{{ old('telefone', $fornecedor->telefone) }}" data-mask="phone" inputmode="tel" maxlength="15" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <span class="text-xs text-gray-500">Formato: (99) 99999-9999</span>
                        @error('telefone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Endereço</label>
                        <input type="text" name="endereco" value="{{ old('endereco', $fornecedor->endereco) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('endereco') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md uppercase text-xs font-bold">Atualizar Fornecedor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
