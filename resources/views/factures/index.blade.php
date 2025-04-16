<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Factures') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Liste des factures -->
                    @if($factures->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-gray-500 text-lg">Aucune facture disponible.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border-collapse table-auto">
                                <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">#</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Date</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Montant total</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($factures as $facture)
                                    <tr class="border-t">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $facture->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $facture->created_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($facture->montant_total, 2) }} FCFA</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('facture.show', $facture) }}" class="text-blue-600 hover:text-blue-800">Voir</a> |
                                            <a href="{{ route('facture.telecharger', $facture) }}" class="text-green-600 hover:text-green-800">Télécharger</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $factures->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
