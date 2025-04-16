<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détail de la Commande') }} #{{ $commande->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium">Statut: <span class="font-semibold">{{ ucfirst($commande->statut) }}</span></h3>
                    <h4 class="mt-2">Montant total: {{ number_format($commande->montant_total, 2) }} Francs</h4>

                    <div class="mt-6">
                        <h4 class="text-lg font-semibold">Détails :</h4>
                        <ul class="list-disc list-inside">

                            @foreach($commande->ligneCommandes as $ligne)
                            <li>{{ $ligne->livre->titre }} - {{ $ligne->quantite }} x {{ number_format($ligne->prix_unitaire, 2) }} Francs</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
