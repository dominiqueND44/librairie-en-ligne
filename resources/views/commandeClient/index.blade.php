<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Commandes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold">Commandes passées</h1>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Commande #</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Montant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($commandes as $commande)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">#{{ $commande->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($commande->montant_total, 2) }} Francs</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($commande->statut) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('commande.show', $commande->id) }}" class="text-indigo-600 hover:text-indigo-900">Voir</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $commandes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
