<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🛒 Mon panier
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('panier') && count(session('panier')) > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Livre</th>
                            <th class="px-4 py-2">Prix</th>
                            <th class="px-4 py-2">Quantité</th>
                            <th class="px-4 py-2">Total</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $total = 0; @endphp
                        @foreach(session('panier') as $id => $item)
                            @php $total += $item['prix'] * $item['quantite']; @endphp
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $item['titre'] }}</td>
                                <td class="px-4 py-2">{{ number_format($item['prix'], 0, ',', ' ') }} FCFA</td>
                                <td class="px-4 py-2">{{ $item['quantite'] }}</td>
                                <td class="px-4 py-2">{{ number_format($item['prix'] * $item['quantite'], 0, ',', ' ') }} FCFA</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('panier.retirer', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Retirer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="mt-6 text-right">
                        <p class="text-lg font-bold">Total : {{ number_format($total, 0, ',', ' ') }} FCFA</p>

                        <!-- Formulaire pour passer à la commande -->
                        <form action="{{ route('commande.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="total" value="{{ $total }}">
                            <button type="submit" class="inline-block mt-4 px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                Valider la commande
                            </button>
                        </form>

                    </div>
                </div>
            @else
                <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                    <p class="text-gray-600">Votre panier est vide.</p>
                    <a href="{{ route('catalogue.index') }}" class="text-indigo-600 hover:underline mt-4 inline-block">Voir le catalogue</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
