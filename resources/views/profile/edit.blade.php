<x-app-layout>

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier mon profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Status Message -->
            @if (session('status') === 'profile-updated')
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
                    <p class="font-medium">{{ __('Profil mis à jour avec succès!') }}</p>
                </div>
            @endif

            <!-- Informations personnelles -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header class="border-b-4 border-orange-500 pb-4 mb-6">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Informations Personnelles') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Mettez à jour vos informations personnelles et votre adresse email.') }}
                            </p>
                        </header>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <!-- Nom -->
                            <div>
                                <x-input-label for="nom" :value="__('Nom')" class="text-green-700" />
                                <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full border-green-300 focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 rounded-md shadow-sm" :value="old('nom', $user->nom)" required autofocus autocomplete="nom" />
                                <x-input-error class="mt-2" :messages="$errors->get('nom')" />
                            </div>

                            <!-- Prénoms -->
                            <div>
                                <x-input-label for="prenoms" :value="__('Prénoms')" class="text-green-700" />
                                <x-text-input id="prenoms" name="prenoms" type="text" class="mt-1 block w-full border-green-300 focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 rounded-md shadow-sm" :value="old('prenoms', $user->prenoms)" required autocomplete="prenoms" />
                                <x-input-error class="mt-2" :messages="$errors->get('prenoms')" />
                            </div>

                            <!-- Date de naissance -->
                            <div>
                                <x-input-label for="date_naissance" :value="__('Date de naissance')" class="text-green-700" />
                                <x-text-input id="date_naissance" name="date_naissance" type="date" class="mt-1 block w-full border-green-300 focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 rounded-md shadow-sm" :value="old('date_naissance', $user->date_naissance)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('date_naissance')" />
                            </div>

                            <!-- Lieu de naissance -->
                            <div>
                                <x-input-label for="lieu_naissance" :value="__('Lieu de naissance')" class="text-green-700" />
                                <x-text-input id="lieu_naissance" name="lieu_naissance" type="text" class="mt-1 block w-full border-green-300 focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 rounded-md shadow-sm" :value="old('lieu_naissance', $user->lieu_naissance)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('lieu_naissance')" />
                            </div>

                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('Email')" class="text-green-700" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full border-green-300 focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 rounded-md shadow-sm" :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div>
                                        <p class="text-sm mt-2 text-gray-800">
                                            {{ __('Votre adresse email n\'est pas vérifiée.') }}

                                            <button form="send-verification" class="underline text-sm text-orange-600 hover:text-orange-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                                {{ __('Cliquez ici pour renvoyer l\'email de vérification.') }}
                                            </button>
                                        </p>

                                        @if (session('status') === 'verification-link-sent')
                                            <p class="mt-2 font-medium text-sm text-green-600">
                                                {{ __('Un nouveau lien de vérification a été envoyé à votre adresse email.') }}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Téléphone -->
                            <div>
                                <x-input-label for="telephone" :value="__('Téléphone')" class="text-green-700" />
                                <x-text-input id="telephone" name="telephone" type="text" class="mt-1 block w-full border-green-300 focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 rounded-md shadow-sm" :value="old('telephone', $user->telephone)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('telephone')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button class="bg-orange-500 hover:bg-orange-600">{{ __('Enregistrer') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Enregistré.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <!-- Modifier le mot de passe -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header class="border-b-4 border-green-500 pb-4 mb-6">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Modifier le mot de passe') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="update_password_current_password" :value="__('Mot de passe actuel')" class="text-orange-700" />
                                <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full border-orange-300 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm" autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="update_password_password" :value="__('Nouveau mot de passe')" class="text-orange-700" />
                                <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full border-orange-300 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="update_password_password_confirmation" :value="__('Confirmer le mot de passe')" class="text-orange-700" />
                                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full border-orange-300 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button class="bg-green-500 hover:bg-green-600">{{ __('Enregistrer') }}</x-primary-button>

                                @if (session('status') === 'password-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Enregistré.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <!-- Supprimer le compte -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section class="space-y-6">
                        <header class="border-b-4 border-red-500 pb-4 mb-6">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Supprimer le compte') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Avant de supprimer votre compte, veuillez télécharger les données ou informations que vous souhaitez conserver.') }}
                            </p>
                        </header>

                        <x-danger-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                        >{{ __('Supprimer le compte') }}</x-danger-button>

                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Êtes-vous sûr de vouloir supprimer votre compte ?') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Veuillez entrer votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.') }}
                                </p>

                                <div class="mt-6">
                                    <x-input-label for="password" value="{{ __('Mot de passe') }}" class="sr-only" />

                                    <x-text-input
                                        id="password"
                                        name="password"
                                        type="password"
                                        class="mt-1 block w-3/4"
                                        placeholder="{{ __('Mot de passe') }}"
                                    />

                                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Annuler') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ml-3">
                                        {{ __('Supprimer le compte') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </section>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>