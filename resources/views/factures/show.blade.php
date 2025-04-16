<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Facture') }} #{{ $facture->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Détails de la facture -->
                    <h3 class="text-xl font-semibold mb-4">Client : {{ $facture->user->name }}</h3>
                    <p class="text-lg mb-2"><strong>Date :</strong> {{ $facture->created_at->format('d/m/Y') }}</p>

                    <!-- Tableau des produits -->
                    <table class="min-w-full bg-white border-collapse table-auto mb-4">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Produit</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Quantité</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Prix</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($facture->ligneCommandes as $ligne)
                            <tr class="border-t">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $ligne->livre->titre }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $ligne->quantite }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($ligne->prix_unitaire, 2) }} Fcfa</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($ligne->quantite * $ligne->prix_unitaire, 2) }} Fcfa</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Total de la facture -->
                    <div class="text-right">
                        <p class="text-lg font-semibold">Total : {{ number_format($facture->montant_total, 2) }} Fcfa</p>
                    </div>

                    <!-- Bouton de téléchargement -->
                    <div class="mt-6 text-right">
                        <a href="{{ route('facture.telecharger', $facture) }}"
                           class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            📄 Télécharger PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
