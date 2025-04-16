<!-- Utilisation du layout principal de l'application -->
<x-app-layout>
    <!-- Définition du slot "header" pour le titre de la page -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un nouveau livre') }}
        </h2>
    </x-slot>

    <!-- Section principale de la page -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Titre et bouton de retour -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">Formulaire d'ajout</h1>
                        <a href="{{ route('livres.index') }}"
                           class="bg-gray-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded">
                            Retour à la liste
                        </a>
                    </div>

                    <!-- Formulaire de création -->
                    <form method="POST" action="{{ route('livres.store') }}" enctype="multipart/form-data">
                        @csrf <!-- Protection CSRF -->

                        <!-- Champ Titre -->
                        <div class="mb-4">
                            <label for="titre" class="block text-gray-700 text-sm font-bold mb-2">
                                Titre du livre *
                            </label>
                            <input type="text" id="titre" name="titre" value="{{ old('titre') }}"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('titre') border-red-500 @enderror"
                                   required>
                            @error('titre')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Champ Auteur -->
                        <div class="mb-4">
                            <label for="auteur" class="block text-gray-700 text-sm font-bold mb-2">
                                Auteur *
                            </label>
                            <input type="text" id="auteur" name="auteur" value="{{ old('auteur') }}"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('auteur') border-red-500 @enderror"
                                   required>
                            @error('auteur')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Champ Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                                Description *
                            </label>
                            <textarea id="description" name="description" rows="3"
                                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror"
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Champs Prix et Quantité (sur la même ligne) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- Prix -->
                            <div>
                                <label for="prix" class="block text-gray-700 text-sm font-bold mb-2">
                                    Prix (Francs) *
                                </label>
                                <input type="number" step="0.01" min="0" id="prix" name="prix" value="{{ old('prix') }}"
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('prix') border-red-500 @enderror"
                                       required>
                                @error('prix')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Quantité -->
                            <div>
                                <label for="stock" class="block text-gray-700 text-sm font-bold mb-2">
                                    Quantité en stock
                                </label>
                                <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}"
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('stock') border-red-500 @enderror">
                                @error('stock')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Champ Catégorie -->
                        <div class="mb-4">
                            <label for="categorie_id" class="block text-gray-700 text-sm font-bold mb-2">
                                Catégorie
                            </label>
                            <select id="categorie_id" name="categorie_id"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('categorie_id') border-red-500 @enderror">
                                <option value="">-- Sélectionnez une catégorie --</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->libelle }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categorie_id')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Champ Disponible (checkbox) -->
                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" id="disponible" name="disponible" value="1"
                                       class="form-checkbox h-5 w-5 text-blue-600 @error('disponible') border-red-500 @enderror"
                                    {{ old('disponible') ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700">Disponible</span>
                            </label>
                            @error('disponible')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Champ Image -->
                        <div class="mb-6">
                            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">
                                Image du livre
                            </label>
                            <input type="file" id="image" name="image"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('image') border-red-500 @enderror">
                            @error('image')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Boutons de soumission -->
                        <div class="flex items-center justify-end">
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
