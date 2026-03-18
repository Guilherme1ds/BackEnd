<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Nossa Confecção') }}
            </h2>
            <a href="{{ route('clientes.create') }}" class="btn btn-primary text-xs uppercase tracking-widest">
                + Novo Cliente
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            

            <!-- Mensagem de Sucesso -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm rounded-r">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($clientes as $cliente)
                        <div class="flex flex-col justify-between border border-gray-200 p-5 rounded-lg hover:shadow-lg transition bg-gray-50">
                            <div>
                                <h3 class="font-bold text-xl text-gray-900 mb-2">{{ $cliente->nome }}</h3>
                                <p class="text-sm text-gray-600 mb-1">
                                    <span class="font-semibold text-gray-800">CPF:</span> {{ $cliente->cpf }}
                                </p>
                                <p class="text-sm text-gray-600 mb-1">
                                    <span class="font-semibold text-gray-800">Email:</span> {{ $cliente->email }}
                                </p>
                                <p class="text-sm text-indigo-600 font-medium mb-1">
                                    <span class="font-semibold text-gray-800">Telefone:</span> {{ $cliente->telefone }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold text-gray-800">Endereço:</span> {{ $cliente->endereco ?? '—' }}
                                </p>
                            </div>

                            <div class="flex items-center justify-end mt-6 pt-4 border-t border-gray-200 space-x-4">
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-semibold flex items-center">
                                    Editar
                                </a>

                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger text-sm font-semibold btn-excluir" data-item-name="{{ $cliente->nome }}">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-400 text-lg italic">Nenhum cliente cadastrado até o momento.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>