<!DOCTYPE html>
<html>

<head>

    <title>Connexion</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/auth.css">

</head>

<body>

    <div class="auth-container">

        <div class="auth-card">

            <h2 class="text-center mb-4">Connexion</h2>

            <form method="POST" action="/login">

                @csrf

                <div class="mb-3">

                    <input type="email" class="form-control custom-input" name="email" placeholder="Adresse email">
                    @error('email')<small class="text-danger">{{ $message }}</small>@enderror


                </div>

                <div class="mb-3">

                    <input type="password" class="form-control custom-input" name="password" placeholder="Mot de passe">
                    @error('password')<small class="text-danger">{{ $message }}</small>@enderror

                </div>

                <button class="btn login-btn w-100">

                    Se connecter

                </button>

            </form>

            <p class="text-center mt-3">

                Vous n'avez pas de compte ?

                <br><a href="/register">Créer un compte</a>

            </p>

        </div>

    </div>

</body>

</html>