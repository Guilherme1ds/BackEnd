<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Estoque</h2>
            <a href="{{ route('estoque.create') }}" class="btn btn-primary text-xs uppercase tracking-widest">
                + Novo Item
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
                    @forelse ($estoque as $item)
                        <div class="card p-5 hover:shadow-xl transition">
                            <div>
                                <h3 class="font-bold text-xl text-gray-900 mb-2">{{ $item->produto }}</h3>
                                <p class="text-sm text-gray-600 mb-1">
                                    <span class="font-semibold text-gray-800">Quantidade:</span> {{ $item->quantidade }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold text-gray-800">Preço custo:</span> R$ {{ number_format($item->preco_custo, 2, ',', '.') }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold text-gray-800">Preço venda:</span> R$ {{ number_format($item->preco_venda, 2, ',', '.') }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold text-gray-800">Mínimo:</span> {{ $item->estoque_minimo }}
                                </p>
                            </div>

                            <div class="flex items-center justify-end mt-6 pt-4 border-t border-gray-200 space-x-4">
                                <a href="{{ route('estoque.edit', $item->id) }}" class="btn btn-secondary text-sm">
                                    Editar
                                </a>

                                <form action="{{ route('estoque.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger text-sm font-semibold btn-excluir" data-item-name="{{ $item->produto }}">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-400 text-lg italic">Nenhum item em estoque até o momento.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>