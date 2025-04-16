<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de Bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- En-tête avec badge de rôle -->
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Bonjour {{ $user_name }} !</h1>
                            <p class="text-gray-600">{{ __('Bienvenue sur votre espace personnel') }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-sm font-medium
                            {{ $is_manager ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $is_manager ? 'Gestionnaire' : 'Client' }}
                        </span>
                    </div>

                    <!-- Contenu différentié par rôle -->
                    @if($is_manager)
                        <!-- ============================================== -->
                        <!-- SECTION GESTIONNAIRE -->
                        <!-- ============================================== -->
                        <div class="space-y-8">
                            <!-- Cartes de fonctionnalités -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Fonctionnalités de gestion</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <!-- Gestion des livres -->
                                    <a href="{{ route('livres.index') }}" class="group transition-transform hover:scale-[1.02]">
                                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-lg border border-green-200 hover:border-green-300 transition-colors h-full">
                                            <div class="flex items-center">
                                                <div class="p-2 bg-green-100 rounded-lg mr-3">
                                                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <span class="font-medium text-gray-800 group-hover:text-green-600">Gérer les livres</span>
                                                    <p class="text-xs text-gray-500 mt-1">Ajout, modification et suppression</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- Gestion des commande -->
                                    <a href="{{ route('commande.index') }}" class="group transition-transform hover:scale-[1.02]">
                                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-lg border border-blue-200 hover:border-blue-300 transition-colors h-full">
                                            <div class="flex items-center">
                                                <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <span class="font-medium text-gray-800 group-hover:text-blue-600">Commandes clients</span>
                                                    <p class="text-xs text-gray-500 mt-1">Suivi et traitement</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- Gestion des paiements -->
                                    <a href="{{ route('admin.paiements.index') }}" class="group transition-transform hover:scale-[1.02]">
                                        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-4 rounded-lg border border-yellow-200 hover:border-yellow-300 transition-colors h-full">
                                            <div class="flex items-center">
                                                <div class="p-2 bg-yellow-100 rounded-lg mr-3">
                                                    <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <span class="font-medium text-gray-800 group-hover:text-yellow-600">Paiements</span>
                                                    <p class="text-xs text-gray-500 mt-1">Suivi des transactions</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- Statistiques -->
                                    <a href="{{ route('statistiques') }}" class="group transition-transform hover:scale-[1.02]">
                                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-lg border border-purple-200 hover:border-purple-300 transition-colors h-full">
                                            <div class="flex items-center">
                                                <div class="p-2 bg-purple-100 rounded-lg mr-3">
                                                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <span class="font-medium text-gray-800 group-hover:text-purple-600">Statistiques</span>
                                                    <p class="text-xs text-gray-500 mt-1">Analyse des performances</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!-- Statistiques rapides -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Aperçu des statistiques</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <!-- Commandes en cours -->
                                    <div class="bg-white p-4 rounded-lg shadow border border-blue-200 hover:shadow-md transition-shadow">
                                        <div class="flex items-center">
                                            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-gray-500 text-sm">Commandes en cours</div>
                                                <div class="text-2xl font-bold mt-1 text-blue-600">{{ $stats['commandes_en_cours'] }}</div>
                                                <div class="text-xs text-gray-400 mt-1">A traiter aujourd'hui</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Commandes validées -->
                                    <div class="bg-white p-4 rounded-lg shadow border border-green-200 hover:shadow-md transition-shadow">
                                        <div class="flex items-center">
                                            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-gray-500 text-sm">Commandes validées</div>
                                                <div class="text-2xl font-bold mt-1 text-green-600">{{ $stats['commandes_validees'] }}</div>
                                                <div class="text-xs text-gray-400 mt-1">Aujourd'hui</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Recettes journalières -->
                                    <div class="bg-white p-4 rounded-lg shadow border border-yellow-200 hover:shadow-md transition-shadow">
                                        <div class="flex items-center">
                                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-gray-500 text-sm">Recettes journalières</div>
                                                <div class="text-2xl font-bold mt-1 text-yellow-600">{{ number_format($stats['recettes_journalieres'], 2) }} Francs</div>
                                                <div class="text-xs text-gray-400 mt-1">Chiffre d'affaires</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Graphiques -->
                            <div class="mt-6">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <!-- Commandes par mois -->
                                    <div class="bg-white p-5 rounded-lg shadow">
                                        <div class="flex items-center justify-between mb-4">
                                            <h4 class="text-md font-medium text-gray-700">Commandes par mois</h4>
                                            <span class="text-xs bg-gray-100 px-2 py-1 rounded text-gray-500">30 derniers jours</span>
                                        </div>
                                        <!-- Ajuster la hauteur si nécessaire -->
                                        <div class="h-80">
                                            <canvas id="commandesParMoisChart"></canvas>
                                        </div>
                                    </div>

                                    <!-- Livres vendus par catégorie -->
                                    <div class="bg-white p-5 rounded-lg shadow">
                                        <div class="flex items-center justify-between mb-4">
                                            <h4 class="text-md font-medium text-gray-700">Livres vendus par catégorie</h4>
                                            <span class="text-xs bg-gray-100 px-2 py-1 rounded text-gray-500">Ce mois-ci</span>
                                        </div>
                                        <!-- Ajuster la hauteur si nécessaire -->
                                        <div class="h-80">
                                            <canvas id="livresVendusParCategorieChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @else
                        <!-- ============================================== -->
                        <!-- SECTION CLIENT -->
                        <!-- ============================================== -->
                        <div class="space-y-8">
                            <!-- Cartes de fonctionnalités -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Espace Client</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <!-- Catalogue -->
                                    <a href="{{ route('catalogue.index') }}" class="group transition-transform hover:scale-[1.02]">
                                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-lg border border-blue-200 hover:border-blue-300 transition-colors h-full">
                                            <div class="flex items-center">
                                                <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <span class="font-medium text-gray-800 group-hover:text-blue-600">Catalogue des livres</span>
                                                    <p class="text-xs text-gray-500 mt-1">Parcourir notre collection</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- Commandes -->
                                    <a href="{{ route('commande.index') }}" class="group transition-transform hover:scale-[1.02]">
                                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-lg border border-green-200 hover:border-green-300 transition-colors h-full">
                                            <div class="flex items-center">
                                                <div class="p-2 bg-green-100 rounded-lg mr-3">
                                                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <span class="font-medium text-gray-800 group-hover:text-green-600">Mes commandes</span>
                                                    <p class="text-xs text-gray-500 mt-1">Historique et suivi</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- Factures -->
                                    <a href="{{ route('facture.index') }}" class="group transition-transform hover:scale-[1.02]">
                                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-lg border border-purple-200 hover:border-purple-300 transition-colors h-full">
                                            <div class="flex items-center">
                                                <div class="p-2 bg-purple-100 rounded-lg mr-3">
                                                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <span class="font-medium text-gray-800 group-hover:text-purple-600">Mes factures</span>
                                                    <p class="text-xs text-gray-500 mt-1">Téléchargement PDF</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!-- Dernières commande -->
                            <div>
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-medium text-gray-900">Mes dernières commandes</h3>
                                    <a href="{{ route('commande.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Voir tout</a>
                                </div>

                                @if($commandes->isEmpty())

                                    <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        <h4 class="mt-2 text-sm font-medium text-gray-900">Aucune commande</h4>
                                        <p class="mt-1 text-sm text-gray-500">Vous n'avez pas encore passé de commande.</p>
                                        <div class="mt-6">
                                            <a href="{{ route('catalogue.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Parcourir le catalogue
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                        <ul class="divide-y divide-gray-200">
                                            @foreach($commandes as $commande)
                                                <li>
                                                    <a href="{{ route('commande.show', $commande->id) }}">


                                                        <div class="px-4 py-4 sm:px-6">
                                                            <div class="flex items-center justify-between">
                                                                <p class="text-sm font-medium text-indigo-600 truncate">
                                                                    Commande #{{ $commande->id }}
                                                                </p>
                                                                <div class="ml-2 flex-shrink-0 flex">
                                                                    <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $commande->statut === 'expediee' ? 'bg-green-100 text-green-800' :
                               ($commande->statut === 'annulee' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                                        {{ ucfirst($commande->statut) }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="mt-2 sm:flex sm:justify-between">
                                                                <div class="sm:flex">
                                                                    <p class="flex items-center text-sm text-gray-500">
                                                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                                                        </svg>
                                                                        {{ $commande->created_at->format('d/m/Y H:i') }}
                                                                    </p>
                                                                </div>
                                                                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                                                    </svg>
                                                                    {{ number_format($commande->montant_total, 2) }} Francs
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($is_manager)
            @push('scripts')
                <!-- Charger correctement Chart.js en version UMD -->
                <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        console.log("SCRIPT LANCÉ !");

                        const Chart = window.Chart; // Pour éviter l'erreur "Chart is not defined"

                        // === Commandes par mois ===
                        const commandesCtx = document.getElementById('commandesParMoisChart').getContext('2d');
                        console.log('Commandes context:', commandesCtx);
                        console.log('Commandes par mois data:', @json($stats['commandes_par_mois']));

                        new Chart(commandesCtx, {
                            type: 'line',
                            data: {
                                labels: @json($stats['commandes_par_mois']['labels']),
                                datasets: [{
                                    label: 'Commandes',
                                    data: @json($stats['commandes_par_mois']['data']),
                                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                                    borderColor: 'rgba(79, 70, 229, 1)',
                                    borderWidth: 2,
                                    tension: 0.3,
                                    fill: true
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        grid: {
                                            drawBorder: false
                                        }
                                    },
                                    x: {
                                        grid: {
                                            display: false
                                        }
                                    }
                                }
                            }
                        });

                        // === Livres vendus par catégorie ===
                        const livresCtx = document.getElementById('livresVendusParCategorieChart').getContext('2d');
                        console.log('Livres par catégorie data:', @json($stats['livres_par_categorie']));

                        new Chart(livresCtx, {
                            type: 'doughnut',
                            data: {
                                labels: @json($stats['livres_par_categorie']['labels']),
                                datasets: [{
                                    data: @json($stats['livres_par_categorie']['data']),
                                    backgroundColor: [
                                        'rgba(79, 70, 229, 0.8)',  // Couleur 1
                                        'rgba(255, 99, 132, 0.8)', // Couleur 2
                                        'rgba(54, 162, 235, 0.8)', // Couleur 3
                                        'rgba(255, 206, 86, 0.8)', // Couleur 4
                                        'rgba(75, 192, 192, 0.8)', // Couleur 5
                                        'rgba(153, 102, 255, 0.8)', // Couleur 6
                                        'rgba(255, 159, 64, 0.8)'  // Couleur 7
                                    ],
                                    borderWidth: 0
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'right'
                                    }
                                },
                                cutout: '70%' // Remplace cutoutPercentage
                            }
                        });

                    });
                </script>
    @endpush
    @endif
</x-app-layout>
