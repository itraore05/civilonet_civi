<x-app-layout>

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon Profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Profil Header -->
                    <div class="flex items-center justify-between mb-8 border-b-4 border-green-500 pb-4">
                        <div>
                            <h1 class="text-3xl font-bold text-orange-500">{{ $user->prenoms }} {{ $user->nom }}</h1>
                            <p class="text-gray-600">{{ __('Citoyen') }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                            {{ __('Modifier le profil') }}
                        </a>
                    </div>

                    <!-- Information Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informations Personnelles -->
                        <div class="bg-green-50 p-6 rounded-lg shadow">
                            <h2 class="text-xl font-semibold text-green-700 mb-4 border-b-2 border-green-200 pb-2">{{ __('Informations Personnelles') }}</h2>
                            
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">{{ __('Nom complet') }}</p>
                                    <p class="font-medium">{{ $user->prenoms }} {{ $user->nom }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">{{ __('Date de naissance') }}</p>
                                    <p class="font-medium">{{ \Carbon\Carbon::parse($user->date_naissance)->format('d/m/Y') }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">{{ __('Lieu de naissance') }}</p>
                                    <p class="font-medium">{{ $user->lieu_naissance }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">{{ __('Rôle') }}</p>
                                    <p class="font-medium">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Informations de Contact -->
                        <div class="bg-orange-50 p-6 rounded-lg shadow">
                            <h2 class="text-xl font-semibold text-orange-700 mb-4 border-b-2 border-orange-200 pb-2">{{ __('Informations de Contact') }}</h2>
                            
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">{{ __('Email') }}</p>
                                    <p class="font-medium">{{ $user->email }}</p>
                                    @if(!$user->email_verified_at)
                                        <span class="text-xs text-orange-500">{{ __('Non vérifié') }}</span>
                                    @else
                                        <span class="text-xs text-green-500">{{ __('Vérifié') }}</span>
                                    @endif
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">{{ __('Téléphone') }}</p>
                                    <p class="font-medium">{{ $user->telephone }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">{{ __('Inscrit depuis') }}</p>
                                    <p class="font-medium">{{ $user->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>