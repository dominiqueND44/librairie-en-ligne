<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catalogue des Livres') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Filtres -->
                    <div class="bg-white rounded-lg shadow p-6 mb-8">
                        <form action="{{ route('catalogue.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Filtre par catégorie -->
                            <div>
                                <label for="categorie" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                                <select name="categorie" id="categorie" class="w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">Toutes catégories</option>
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}" {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                                            {{ $categorie->libelle }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filtre par auteur -->
                            <div>
                                <label for="auteur" class="block text-sm font-medium text-gray-700 mb-1">Auteur</label>
                                <input type="text" name="auteur" id="auteur" value="{{ request('auteur') }}"
                                       class="w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <!-- Filtre par prix max -->
                            <div>
                                <label for="prix_max" class="block text-sm font-medium text-gray-700 mb-1">Prix max</label>
                                <input type="number" step="0.01" name="prix_max" id="prix_max"
                                       value="{{ request('prix_max') }}" class="w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <!-- Bouton de recherche -->
                            <div class="flex items-end">
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                    Filtrer
                                </button>
                            </div>
                        </form>
                    </div>
                    @if(session('message'))
                        <div class="bg-green-100 text-green-800 p-4 rounded-md mb-4">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 text-red-800 p-4 rounded-md mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
                    <!-- Liste des livres -->
                    @if($livres->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-gray-500 text-lg">Aucun livre ne correspond à votre recherche.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach($livres as $livre)
                                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
                                    <!-- Image du livre -->
                                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                                        @if($livre->image)
                                            <img src="{{ asset('storage/' . $livre->image) }}" alt="{{ $livre->titre }}" class="h-full object-cover">
                                        @else
                                            <span class="text-gray-400">Pas d'image</span>
                                        @endif
                                    </div>

                                    <!-- Détails du livre -->
                                    <div class="p-4">
                                        <h3 class="font-bold text-lg mb-1">{{ $livre->titre }}</h3>
                                        <p class="text-gray-600 text-sm mb-2">{{ $livre->auteur }}</p>
                                        <p class="text-indigo-600 font-bold mb-3">{{ number_format($livre->prix, 2) }} €</p>

                                        <!-- Bouton d'action -->
                                        <div class="flex justify-between items-center">
                                            <a href="{{ route('catalogue.show', $livre) }}"
                                               class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                                Voir détails
                                            </a>

                                            @if($livre->estEnStock())
                                                <form action="{{ route('panier.ajouter') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                                                    <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                                                        Ajouter au panier
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-red-500 text-sm">Rupture de stock</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $livres->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
