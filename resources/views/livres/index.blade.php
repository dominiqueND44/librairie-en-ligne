<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des Livres') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Contenu de votre page -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">Liste des Livres</h1>
                        <a href="{{ route('livres.create') }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-150">
                            <i class="fas fa-plus mr-1"></i> Ajouter un livre
                        </a>
                    </div>

                    <!-- Tableau des livres -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <!-- En-têtes du tableau -->
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Auteur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                            </thead>
                            <!-- Corps du tableau -->
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($livres as $livre)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($livre->image)
                                            <img src="{{ asset('storage/'.$livre->image) }}" alt="{{ $livre->titre }}"
                                                 class="h-6 w-7 object-cover rounded-md shadow-sm">
                                        @else
                                            <div class="h-12 w-12 bg-gray-200 rounded-md flex items-center justify-center">
                                                <i class="fas fa-book text-gray-400"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                        {{ $livre->titre }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $livre->auteur }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($livre->prix, 2) }} FCFA</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs rounded-full {{ $livre->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $livre->stock }}
                                            </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('livres.edit', $livre->id) }}"
                                               class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                                <i class="fas fa-edit mr-1"></i> Modifier
                                            </a>
                                            <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-900 flex items-center"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">
                                                    <i class="fas fa-trash mr-1"></i> Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $livres->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
