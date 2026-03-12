<!DOCTYPE html>
<html>

<head>
    <title>Mini Social</title>
    <link rel="stylesheet" href="/css/posts.css">
</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <h2>Mini Social</h2>

        <div class="user-info">
            <!-- Ghi smiya dyal user connecté -->
            <span><strong>{{ session('user_name') }}</strong></span>

            <!-- Bouton Logout -->
            <a href="/logout" class="logout">Déconnexion</a>
        </div>
    </div>

    <!-- CONTAINER -->
    <div class="container">

        <!-- Formulaire post -->
        <div class="post-form">
            <form action="/post" method="POST">
                @csrf
                <textarea name="content" placeholder="Quoi de neuf ?"></textarea>
                <button class="post-btn">Poster</button>
            </form>
        </div>

        <!-- Tous les posts -->
        @foreach($posts as $post)
            <div class="post">
                <div class="post-user">{{ $post->user->name }}</div>
                <div class="post-content">{{ $post->content }}</div>
                <div class="actions">

                    <!-- Like -->
                    <form action="/like/{{$post->id}}" method="POST">
                        @csrf
                        <button class="like-btn">❤️ {{ $post->likes->count() }}</button>
                    </form>

                    <!-- Modifier -->
                    @if(session('user_id') == $post->user_id)
                        <a href="/post/{{$post->id}}/edit" class="edit-btn">Modifier</a>
                        <!-- Delete -->
                        <form action="/post/{{$post->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="delete-btn">Supprimer</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach

    </div>

</body>

</html>