<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du Livre') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="md:flex">
                        <!-- Image du livre -->
                        <div class="md:w-1/3 bg-gray-200 flex items-center justify-center p-8">
                            @if($livre->image)
                                <img src="{{ asset('storage/' . $livre->image) }}" alt="{{ $livre->titre }}" class="max-h-96 object-contain">
                            @else
                                <span class="text-gray-400 text-lg">Pas d'image disponible</span>
                            @endif
                        </div>

                        <!-- Détails du livre -->
                        <div class="md:w-2/3 p-8">
                            <h1 class="text-3xl font-bold mb-2">{{ $livre->titre }}</h1>
                            <p class="text-gray-600 text-xl mb-4">par {{ $livre->auteur }}</p>

                            <div class="flex items-center mb-6">
                                <span class="text-2xl font-bold text-indigo-600">{{ number_format($livre->prix, 2) }} €</span>
                                <span class="ml-4 px-3 py-1 rounded-full text-sm font-medium
                                {{ $livre->estEnStock() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $livre->estEnStock() ? 'En stock' : 'Rupture de stock' }}
                                </span>
                            </div>

                            <div class="mb-6">
                                <h3 class="font-semibold text-lg mb-2">Description</h3>
                                <p class="text-gray-700">{{ $livre->description ?? 'Aucune description disponible.' }}</p>
                            </div>

                            <div class="mb-6">
                                <h3 class="font-semibold text-lg mb-2">Catégorie</h3>
                                <p class="text-gray-700">{{ $livre->categorie->libelle }}</p>
                            </div>

                            <!-- Options de commande -->
                            <div class="border-t pt-6">
                                @if($livre->estEnStock())
                                    <form action="{{ route('panier.ajouter') }}" method="POST" class="flex items-center">
                                        @csrf
                                        <input type="hidden" name="livre_id" value="{{ $livre->id }}">

                                        <div class="mr-4">
                                            <label for="quantite" class="block text-sm font-medium text-gray-700 mb-1">Quantité</label>
                                            <select name="quantite" id="quantite" class="rounded-md border-gray-300 shadow-sm">
                                                @for($i = 1; $i <= min(10, $livre->stock); $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700">
                                            Ajouter au panier
                                        </button>
                                    </form>
                                @else
                                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-yellow-700">
                                                    Ce livre est actuellement en rupture de stock.
                                                    <a href="#" class="font-medium underline text-yellow-700 hover:text-yellow-600">
                                                        Me prévenir quand il sera disponible
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Livres similaires -->
                    @if($livresSimilaires->isNotEmpty())
                        <div class="mt-12">
                            <h2 class="text-2xl font-bold mb-6">Vous pourriez aussi aimer</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                                @foreach($livresSimilaires as $livreSimilaire)
                                    <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
                                        <div class="h-48 bg-gray-200 flex items-center justify-center">
                                            @if($livreSimilaire->image)
                                                <img src="{{ asset('storage/' . $livreSimilaire->image) }}" alt="{{ $livreSimilaire->titre }}" class="h-full object-cover">
                                            @else
                                                <span class="text-gray-400">Pas d'image</span>
                                            @endif
                                        </div>
                                        <div class="p-4">
                                            <h3 class="font-bold text-lg mb-1">{{ $livreSimilaire->titre }}</h3>
                                            <p class="text-gray-600 text-sm mb-2">{{ $livreSimilaire->auteur }}</p>
                                            <p class="text-indigo-600 font-bold mb-3">{{ number_format($livreSimilaire->prix, 2) }} €</p>
                                            <a href="{{ route('catalogue.show', $livreSimilaire) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                                Voir détails
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
