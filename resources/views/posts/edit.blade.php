<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier Post - Mini Social</title>
    <link rel="stylesheet" href="/css/posts.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: #1877f2;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
        }

        .navbar .logout {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 6px 12px;
            background: #f02849;
            border-radius: 5px;
        }

        .navbar .logout:hover {
            background: #c82333;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            resize: none;
            height: 100px;
        }

        .update-btn {
            margin-top: 10px;
            background: #ffc107;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .update-btn:hover {
            background: #e0a800;
        }

        .back-btn {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #1877f2;
            font-weight: bold;
        }

        .back-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h2>Mini Social</h2>
        <span><strong>{{ session('user_name') }}</strong></span>
        <a href="/logout" class="logout">Déconnexion</a>
    </div>

    <div class="container">
        <h3>Modifier votre post</h3>

        <form action="/post/{{$post->id}}" method="POST">
            @csrf
            @method('PUT')
            <textarea name="content" required>{{ $post->content }}</textarea>
            <button type="submit" class="update-btn">Modifier</button>
        </form>

        <a href="/posts" class="back-btn">← Retour aux posts</a>
    </div>
</body>

</html>