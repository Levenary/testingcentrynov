<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Set background color to Bootstrap light gray */
        }

        .container {
            background-color: #ffffff; /* Set container background color to white */
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Add a subtle box shadow to the container */
            padding: 20px; /* Add some padding to the container */
            border-radius: 10px; /* Add rounded corners to the container */
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-top: 20px; /* Increase top margin for spacing */
            transition: transform 0.3s ease-in-out;
            cursor: pointer;
        }

        img:hover {
            transform: scale(1.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .lead {
            font-size: 1.5rem; /* Increase font size for lead text */
            font-weight: bold;
            color: #007bff;
        }

        h1 {
            color: #28a745;
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <h1 class="mb-4">Profil Pengguna</h1>
        <p class="lead">Selamat datang, {{ $user->name }}!</p>
        <!-- <p>Email: {{ $user->email }}</p> -->
        
        <!-- Tampilkan gambar profil dengan animasi -->
        @if($user->image)
            <img src="{{ asset('path/to/your/images/' . $user->image) }}" alt="Profil Image" class="img-fluid" data-toggle="modal" data-target="#imageModal">
        @else
            <p>Belum ada gambar profil.</p>
        @endif

        <!-- Formulir untuk pembaruan profil -->
        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password (kosongkan jika tidak diubah):</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password:</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Perbarui Profil</button>
        </form>
        
        <!-- Tambahkan tombol kembali ke halaman utama -->
        <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Kembali ke Halaman Utama</a>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('path/to/your/images/' . $user->image) }}" alt="Profil Image" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
