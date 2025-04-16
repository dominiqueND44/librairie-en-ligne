<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-serif font-bold text-indigo-800">Bienvenue</h2>
                <p class="mt-3 text-gray-600">Veuillez vous connecter à votre compte</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-6 p-4 bg-blue-50 text-blue-700 rounded-lg text-sm" :status="session('status')" />

            <div class="bg-white py-8 px-6 shadow rounded-lg sm:px-10">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div class="space-y-3">
                        <x-input-label for="email" :value="__('Adresse Email')" class="block text-sm font-medium text-gray-700" />
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <x-text-input
                                id="email"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-md"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autofocus
                                placeholder="votre@email.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-3">
                        <x-input-label for="password" :value="__('Mot de passe')" class="block text-sm font-medium text-gray-700" />
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <x-text-input
                                id="password"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-md"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between pt-3">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-200 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                                <strong>{{ __('Se souvenir de moi') }}</strong>
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 hover:underline">
                                <strong>{{ __('Mot de passe oublié ?') }}</strong>
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <x-primary-button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="-ml-1 mr-3 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                            <strong>{{ __('Se connecter') }}</strong>
                        </x-primary-button>
                    </div>
                </form>

                <div class="mt-8 text-center text-md text-gray-500">
                    <p>Pas encore de compte ? <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 hover:underline"><strong>{{ __('Créer un compte') }}</strong></a></p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
