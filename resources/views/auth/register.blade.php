<!DOCTYPE html>
<html>

<head>

    <title>Inscription</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/auth.css">

</head>

<body>

    <div class="auth-container">

        <div class="auth-card">

            <h2 class="text-center mb-4">Créer un compte</h2>

            <form method="POST" action="/register">

                @csrf

                <div class="mb-3">

                    <input type="text" class="form-control custom-input" name="name" placeholder="Nom complet">
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror


                </div>

                <div class="mb-3">

                    <input type="email" class="form-control custom-input" name="email" placeholder="Adresse email">
                    @error('email')<small class="text-danger">{{ $message }}</small>@enderror


                </div>

                <div class="mb-3">

                    <input type="password" class="form-control custom-input" name="password" placeholder="Mot de passe">
                    @error('password')<small class="text-danger">{{ $message }}</small>@enderror

                </div>

                <button class="btn register-btn w-100">

                    S'inscrire

                </button>

            </form>

            <p class="text-center mt-3">

                Vous avez déjà un compte ?

                <br><a href="/login">Se connecter</a>

            </p>

        </div>

    </div>

</body>

</html>