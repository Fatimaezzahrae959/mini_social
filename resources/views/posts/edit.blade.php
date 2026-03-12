<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier Post - Mini Social</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/css/posts.css">

    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <h2><i class="fab fa-facebook-messenger"></i> Mini Social</h2>

        <div class="user-info">
            <span>
                <i class="fas fa-user-circle"></i>
                <strong>{{ session('user_name') }}</strong>
            </span>

            <a href="/logout" class="logout">
                <i class="fas fa-sign-out-alt"></i>
                Déconnexion
            </a>
        </div>
    </div>

    <!-- CONTAINER -->
    <div class="container">

        <div class="post">
            <h3><i class="fas fa-edit"></i> Modifier votre post</h3>

            <form action="/post/{{$post->id}}" method="POST">
                @csrf
                @method('PUT')

                <textarea name="content" required>{{ $post->content }}</textarea>

                <button type="submit" class="update-btn">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </form>

            <a href="/posts" class="back-btn">
                <i class="fas fa-arrow-left"></i> Retour aux posts
            </a>
        </div>

    </div>

</body>

</html>
```