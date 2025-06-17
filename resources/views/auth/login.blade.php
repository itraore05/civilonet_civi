<x-app-layout>


@section('content')
<div class="auth-container">
    <div class="auth-header">
        <div class="logo">
            <img src="{{ asset('./photos/logoe.jpg') }}" alt="Logo État Civil CI">
           
        </div>
        <h1 class="auth-title">Connexion</h1>
        <p class="auth-subtitle">Accédez à votre espace personnel</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="form-label">Mot de passe</label>
            <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password">
            @error('password')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-checkbox-group">
            <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
            <label for="remember_me" class="form-checkbox-label">Se souvenir de moi</label>
        </div>

        <button type="submit" class="btn-auth">Se connecter</button>

        <div class="auth-footer">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="auth-link">Mot de passe oublié ?</a>
            @endif
            <a href="{{ route('register') }}" class="auth-link">Créer un compte</a>
        </div>
    </form>
</div>
@endsection
</x-app-layout>