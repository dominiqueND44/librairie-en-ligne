<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des Paiements') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold">Liste des Paiements</h1>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Commande</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Montant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Méthode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($paiements as $paiement)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">#{{ $paiement->commande_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paiement->commande->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($paiement->montant, 2) }} €</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($paiement->methode) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paiement->date_paiement->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $paiements->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
