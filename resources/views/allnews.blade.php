<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .user-profile-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }

        .mb-0 {
            margin-bottom: 0;
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <h2>News</h2>


        <!-- Tombol Add News (tampilkan hanya jika pengguna sudah login) -->
@if(Auth::check())
    <div class="container mt-4 text-center main-content">
        <a href="{{ route('news.create') }}" class="btn btn-primary">Add News</a>
    </div>
@endif

        @if($news->count() > 0)
            <ul class="list-group">
                @foreach($news as $item)
                    <li class="list-group-item">
                        <!-- Display User's Name, Profile Picture, and Created At Timestamp -->
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('path/to/your/images/' . $item->user->image) }}" alt="User Profile" class="user-profile-image mr-2">
                            <p class="mb-0">{{ $item->user->name }} | {{ $item->created_at }}</p>
                        </div>

                        <h5>{{ $item->title }}</h5>
                        <p>{{ $item->content }}</p>

                        <!-- Bagian Komentar -->
                        <div class="mt-3">
                            <h6>Komentar:</h6>
                            @if($item->comments)
                                @foreach($item->comments as $comment)
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('path/to/your/images/' . $comment->user->image) }}" alt="Profil Pengguna" class="user-profile-image mr-2">
                                        <p class="mb-0">{{ $comment->user->name }} | {{ $comment->created_at }}</p>
                                    </div>
                                    <p>{{ $comment->comment }}</p>
                                @endforeach
                            @else
                                <p>Belum ada komentar.</p>
                            @endif

                            <!-- Formulir Komentar -->
                            @auth
                                <form action="{{ route('comment.store', $item->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    <div class="form-group">
                                        <textarea name="content" class="form-control" placeholder="Tambahkan komentar"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Tambahkan Komentar</button>
                                </form>
                            @else
                                <p>Silakan <a href="{{ route('login') }}">login</a> untuk menambahkan komentar.</p>
                            @endauth
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No news found.</p>
        @endif

        <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Back to Home</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
