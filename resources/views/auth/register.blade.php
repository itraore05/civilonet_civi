<x-app-layout>

@section('content')
<div class="auth-container">
        <div class="auth-header">
            <div class="logo">
                <img src="{{ asset('./photos/logoe.jpg') }}" alt="Logo État Civil CI">
                <span class="logo-text">État Civil CI</span>
            </div>
            <h1 class="auth-title">Créer un compte</h1>
            <p class="auth-subtitle">Rejoignez la plateforme d'État Civil CI</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Première ligne: Nom et Prénoms -->
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <label for="nom" class="form-label">Nom</label>
                        <input id="nom" class="form-input" type="text" name="nom" value="{{ old('nom') }}" required>
                        @error('nom')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="prenoms" class="form-label">Prénoms</label>
                        <input id="prenoms" class="form-input" type="text" name="prenoms" value="{{ old('prenoms') }}" required>
                        @error('prenoms')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Deuxième ligne: Date et Lieu de Naissance -->
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <label for="date_naissance" class="form-label">Date de Naissance</label>
                        <input id="date_naissance" class="form-input" type="date" name="date_naissance" value="{{ old('date_naissance') }}" required>
                        @error('date_naissance')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="lieu_naissance" class="form-label">Lieu de Naissance</label>
                        <input id="lieu_naissance" class="form-input" type="text" name="lieu_naissance" value="{{ old('lieu_naissance') }}" required>
                        @error('lieu_naissance')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Troisième ligne: Email et Téléphone -->
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input id="telephone" class="form-input" type="tel" name="telephone" value="{{ old('telephone') }}" required>
                        @error('telephone')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Quatrième ligne: Mot de passe et Confirmation -->
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <label for="password" class="form-label">Mot de passe (minimum 8 caractères)</label>
                        <input id="password" 
                               class="form-input @error('password') border-red-500 @enderror" 
                               type="password" 
                               name="password" 
                               required
                               minlength="8"
                               autocomplete="new-password">
                        
                        <div class="password-strength mt-2">
                            <div class="password-strength-meter" id="password-strength-meter"></div>
                        </div>
                        <div class="password-strength-text text-xs mt-1" id="password-strength-text">Force du mot de passe</div>
                        
                        @error('password')
                            <span class="form-error text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirmation du mot de passe</label>
                        <input id="password_confirmation" 
                               class="form-input @error('password') border-red-500 @enderror" 
                               type="password" 
                               name="password_confirmation" 
                               required
                               minlength="8"
                               autocomplete="new-password">
                               
                        @error('password_confirmation')
                            <span class="form-error text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Type de compte (caché pour les citoyens) -->
            <input type="hidden" name="role" value="citoyen">

            <div class="form-checkbox-group">
                <input id="terms" type="checkbox" class="form-checkbox" name="terms" required>
                <label for="terms" class="form-checkbox-label">J'accepte les <a href="#" class="auth-link">conditions d'utilisation</a></label>
                @error('terms')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-auth">S'inscrire</button>

            <div class="auth-footer">
                <p>Vous avez déjà un compte ? <a href="{{ route('login') }}" class="auth-link">Se connecter</a></p>
            </div>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const strengthMeter = document.getElementById('password-strength-meter');
        const strengthText = document.getElementById('password-strength-text');
        
        passwordInput.addEventListener('input', function() {
            const value = passwordInput.value;
            let strength = 0;
            
            if (value.length >= 8) strength += 1;
            if (value.match(/[A-Z]/)) strength += 1;
            if (value.match(/[0-9]/)) strength += 1;
            if (value.match(/[^A-Za-z0-9]/)) strength += 1;
            
            switch (strength) {
                case 0:
                    strengthMeter.className = 'password-strength-meter';
                    strengthText.textContent = 'Force du mot de passe';
                    break;
                case 1:
                case 2:
                    strengthMeter.className = 'password-strength-meter weak';
                    strengthText.textContent = 'Faible';
                    break;
                case 3:
                    strengthMeter.className = 'password-strength-meter medium';
                    strengthText.textContent = 'Moyen';
                    break;
                case 4:
                    strengthMeter.className = 'password-strength-meter strong';
                    strengthText.textContent = 'Fort';
                    break;
            }
        });

        // Validation de la date de naissance
        const dateNaissance = document.getElementById('date_naissance');
        dateNaissance.addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const today = new Date();
            const minAgeDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
            
            if (selectedDate > minAgeDate) {
                this.setCustomValidity('Vous devez avoir au moins 18 ans');
            } else {
                this.setCustomValidity('');
            }
        });
    });
    </script>
    
    @endsection
</x-app-layout>