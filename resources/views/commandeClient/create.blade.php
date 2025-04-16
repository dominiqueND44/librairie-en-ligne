<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📝 Passer la commande
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('panier') && count(session('panier')) > 0)
                <form action="{{ route('commande.store') }}" method="POST">
                    @csrf

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="space-y-6">
                            <div class="mb-4">
                                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                                <input type="text" name="nom" id="nom" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                            </div>

                            <div class="mb-4">
                                <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse de livraison</label>
                                <input type="text" name="adresse" id="adresse" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">Confirmer la commande</button>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                    <p class="text-gray-600">Votre panier est vide, vous ne pouvez pas passer une commande.</p>
                    <a href="{{ route('catalogue.index') }}" class="text-indigo-600 hover:underline mt-4 inline-block">Voir le catalogue</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
