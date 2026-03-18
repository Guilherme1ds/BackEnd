<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Fornecedores</h2>
            <a href="{{ route('fornecedores.create') }}" class="btn btn-primary text-xs uppercase tracking-widest">
                + Novo Fornecedor
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm rounded-r">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($fornecedores as $fornecedor)
                        <div class="card p-5 hover:shadow-xl transition">
                            <div>
                                <h3 class="font-bold text-xl text-gray-900 mb-2">{{ $fornecedor->nome }}</h3>
                                <p class="text-sm text-gray-600 mb-1">
                                    <span class="font-semibold text-gray-800">CNPJ:</span> {{ $fornecedor->cnpj }}
                                </p>
                                <p class="text-sm text-indigo-600 font-medium">
                                    <span class="font-semibold text-gray-800">Email:</span> {{ $fornecedor->email }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold text-gray-800">Telefone:</span> {{ $fornecedor->telefone }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold text-gray-800">Endereço:</span> {{ $fornecedor->endereco }}
                                </p>
                            </div>

                            <div class="flex items-center justify-end mt-6 pt-4 border-t border-gray-200 space-x-4">
                                <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="btn btn-secondary text-sm">
                                    Editar
                                </a>

                                <form action="{{ route('fornecedores.destroy', $fornecedor->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger text-sm font-semibold btn-excluir" data-item-name="{{ $fornecedor->nome }}">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-400 text-lg italic">Nenhum fornecedor cadastrado até o momento.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>