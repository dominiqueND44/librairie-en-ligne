<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Modifier le livre : {{ $livre->titre }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-10 px-4">
        <div class="bg-white p-6 rounded-2xl shadow-md">
            <form action="{{ route('livres.update', $livre) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Titre --}}
                <div>
                    <label for="titre" class="block text-sm font-medium text-gray-700">Titre *</label>
                    <input type="text" id="titre" name="titre" value="{{ old('titre', $livre->titre) }}"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-200 @error('titre') border-red-500 @enderror" required>
                    @error('titre') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                {{-- Auteur --}}
                <div>
                    <label for="auteur" class="block text-sm font-medium text-gray-700">Auteur *</label>
                    <input type="text" id="auteur" name="auteur" value="{{ old('auteur', $livre->auteur) }}"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-200 @error('auteur') border-red-500 @enderror" required>
                    @error('auteur') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description *</label>
                    <textarea id="description" name="description" rows="3"
                              class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-200 @error('description') border-red-500 @enderror" required>{{ old('description', $livre->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                {{-- Stock disponible --}}
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock disponible *</label>
                    <input type="number" min="0" id="stock" name="stock" value="{{ old('stock', $livre->stock) }}"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-200 @error('stock') border-red-500 @enderror" required>
                    <p class="text-xs text-gray-500 mt-1">Stock actuel : {{ $livre->stock }}</p>
                    @error('stock') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                {{-- Prix --}}
                <div>
                    <label for="prix" class="block text-sm font-medium text-gray-700">Prix (en FCFA) *</label>
                    <input type="number" step="0.01" min="0" id="prix" name="prix" value="{{ old('prix', $livre->prix) }}"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-200 @error('prix') border-red-500 @enderror" required>
                    @error('prix') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                {{-- Catégorie --}}
                <div>
                    <label for="categorie_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
                    <select id="categorie_id" name="categorie_id"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-200 @error('categorie_id') border-red-500 @enderror">
                        <option value="">-- Sélectionnez une catégorie --</option>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ old('categorie_id', $livre->categorie_id) == $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->libelle }}
                            </option>
                        @endforeach
                    </select>
                    @error('categorie_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                {{-- Disponible --}}
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="disponible" name="disponible" value="1" {{ old('disponible', $livre->disponible) ? 'checked' : '' }}
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring focus:ring-blue-200">
                    <label for="disponible" class="text-sm text-gray-700">Disponible</label>
                </div>

                {{-- Image --}}
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Image du livre</label>
                    @if ($livre->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $livre->image) }}" alt="Image actuelle" class="w-20 h-20 object-cover rounded shadow">
                            <p class="text-sm text-gray-500 mt-1">Image actuelle</p>
                        </div>
                    @endif
                    <input type="file" name="image" id="image"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-200 @error('image') border-red-500 @enderror">
                    @error('image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                {{-- Boutons --}}
                <div class="flex justify-end gap-4 mt-4">
                    <button type="submit"
                            class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold">
                        Mettre à jour
                    </button>
                    <a href="{{ route('livres.index') }}"
                       class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm font-semibold">
                        Annuler
                    </a>
                </div>

            </form>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-2 rounded mb-4 mt-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-app-layout>
