<!DOCTYPE html>
<html>

<head>
    <title>Mini Social</title>
    <link rel="stylesheet" href="/css/posts.css">
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <audio id="notifSound">
        <source src="https://assets.mixkit.co/active_storage/sfx/2571/2571-preview.mp3">
    </audio>
    <!-- NAVBAR -->
    <div class="navbar">
        <h2><i class="fab fa-facebook-messenger"></i> Mini Social</h2>

        <div class="user-info">
            <!-- Profil avec icône et nom -->
            <span>
                <i class="fas fa-user-circle"></i>
                <span><strong>{{ session('user_name') }}</strong></span>
            </span>

            <!-- Bouton Logout avec icône -->
            <a href="/logout" class="logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Déconnexion</span>
            </a>
        </div>
    </div>

    <!-- CONTAINER -->
    <div class="container">

        <div class="post-form">
            <form id="create-post-form">
                @csrf
                <textarea name="content" placeholder="Quoi de neuf ?" required></textarea>
                <button type="submit" class="post-btn">
                    <i class="fas fa-paper-plane"></i> Poster
                </button>
            </form>
        </div>

        <div id="posts-container">
            @foreach($posts as $post)
                <div class="post" id="post-{{ $post->id }}">
                    <div class="post-header">
                        <div class="post-user">
                            <i class="fas fa-user-circle"></i> {{ $post->user->name }}
                        </div>
                        <div class="post-date">
                            <i class="far fa-clock"></i> {{ $post->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                    <div class="post-content">{{ $post->content }}</div>
                    <div class="actions">
                        <button
                            class="like-btn {{ $post->likes->where('user_id', session('user_id'))->count() ? 'liked' : '' }}"
                            data-id="{{ $post->id }}">
                            ❤️ <span class="like-count">{{ $post->likes->count() }}</span>
                        </button>


                        @if(session('user_id') == $post->user_id)
                            <a href="/post/{{$post->id}}/edit" class="edit-btn">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <button class="delete-btn" data-id="{{ $post->id }}">
                                <i class="fas fa-trash-alt"></i> Supprimer
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <div class="footer-content">
            <div>
                <i class="far fa-copyright"></i> 2026 Mini Social - Tous droits réservés
            </div>
            <div class="footer-icons">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function () {

            // Ajouter post
            $('#create-post-form').submit(function (e) {

                e.preventDefault();

                var content = $('textarea[name="content"]').val();

                $.ajax({
                    url: '/post',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        content: content
                    },

                    success: function (post) {

                        $('#posts-container').prepend(`
                <div class="post" id="post-${post.id}">
                    <div class="post-user">
                        <i class="fas fa-user-circle"></i> ${post.user_name}
                    </div>

                    <div class="post-content">${post.content}</div>

                    <div class="actions">
                        <button class="like-btn" data-id="${post.id}">
                            ❤️ <span class="like-count">0</span>
                        </button>

                        <a href="/post/${post.id}/edit" class="edit-btn">
                            <i class="fas fa-edit"></i> Modifier
                        </a>

                        <button class="delete-btn" data-id="${post.id}">
                            <i class="fas fa-trash"></i> Supprimer
                        </button>
                    </div>
                </div>
            `);

                        $('textarea[name="content"]').val('');

                        toastr.success("Post ajouté avec succès");

                        document.getElementById("notifSound").play();
                    },

                    error: function () {
                        toastr.error("Erreur lors de l'ajout du post");
                    }

                });

            });
            // Liker post
            $(document).on('click', '.like-btn', function () {
                var btn = $(this);
                var postId = btn.data('id');

                $.ajax({
                    url: '/like/' + postId,
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function () {
                        // juste toggle compteur localement
                        var count = parseInt(btn.find('.like-count').text());
                        if (btn.hasClass('liked')) {
                            count--;
                            btn.removeClass('liked');
                        } else {
                            count++;
                            btn.addClass('liked');
                        }
                        btn.find('.like-count').text(count);
                    },
                    error: function () {
                        alert('Erreur, essayez encore');
                    }
                });
            });
            // Supprimer post
            $(document).on('click', '.delete-btn', function () {
                var btn = $(this);
                var id = btn.data('id');
                $.ajax({
                    url: '/post/' + id,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function () {
                        $('#post-' + id).remove();

                        toastr.error("Post supprimé !");
                        document.getElementById("notifSound").play();
                    }
                });
            });

        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @if(session('success'))
        <script>
            toastr.success("{{ session('success') }}");
            document.getElementById("notifSound").play();
        </script>
    @endif
</body>

</html>