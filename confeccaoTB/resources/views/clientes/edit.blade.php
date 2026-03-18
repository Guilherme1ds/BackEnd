<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Editar Cliente</h2></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT') <!-- OBRIGATÓRIO PARA EDIÇÃO -->

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" name="nome" value="{{ old('nome', $cliente->nome) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('nome') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">CPF</label>
                            <input type="text" name="cpf" value="{{ old('cpf', $cliente->cpf) }}" data-mask="cpf" inputmode="numeric" maxlength="14" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <span class="text-xs text-gray-500">Formato: 000.000.000-00</span>
                            @error('cpf') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input type="text" name="telefone" value="{{ old('telefone', $cliente->telefone) }}" data-mask="phone" inputmode="tel" maxlength="15" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <span class="text-xs text-gray-500">Formato: (99) 99999-9999</span>
                            @error('telefone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="text" name="email" value="{{ old('email', $cliente->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Endereço</label>
                            <input type="text" name="endereco" value="{{ old('endereco', $cliente->endereco) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('endereco') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md uppercase text-xs font-bold">Atualizar Dados</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>