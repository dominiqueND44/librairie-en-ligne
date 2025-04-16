<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Commande #') . $commande->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif


                    <p class="mb-4"><strong>Client :</strong> {{ $commande->user->name }}</p>
                    <p class="mb-4"><strong>Montant :</strong> {{ number_format($commande->montant_total, 2) }} Francs</p>

                    @if($commande->statut !== 'payee')
                    <form method="POST" action="{{ route('commande.statut', $commande) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="statut" class="block text-sm font-medium text-gray-700">Statut :</label>
                            <select name="statut" id="statut" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="en_attente" {{ $commande->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="en_preparation" {{ $commande->statut == 'en_preparation' ? 'selected' : '' }}>En préparation</option>
                                <option value="expediee" {{ $commande->statut == 'expediee' ? 'selected' : '' }}>Expédiée</option>
                                <option value="payee" {{ $commande->statut == 'payee' ? 'selected' : '' }}>Payée</option>
                            </select>
                        </div>

                        <button type="submit"
                                class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold">
                            Mettre à jour
                        </button>
                    </form>
                        @else
                            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                               <p> Commande deja payee !</p>
                            </div>
                        @endif


                    @if($commande->statut !== 'payee' && $commande->statut !== 'annulee')
                        <form method="POST" action="{{ route('commande.annuler', $commande) }}" class="mt-4">
                            @csrf
                            <button type="submit"
                                    onclick="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?')"
                                    class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm font-semibold">
                                ❌ Annuler la commande
                            </button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
