<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar-nav {
            display: flex;
            align-items: center;
        }

        .nav-item {
            margin-right: 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
        }

        .user-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
            cursor: pointer; /* Add cursor style to indicate it's clickable */
        }

        .user-name {
            display: flex;
            align-items: center;
            margin-right: 10px;
            cursor: pointer; /* Add cursor style to indicate it's clickable */
        }

        .welcome {
            color: blue; /* Change to the desired color */
        }

        .logout {
            color: red; /* Change to the desired color */
        }

        /* Added styles for Main Content Container */
        .container-content {
            background-color: #f8f9fa; /* Light gray background color */
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .title {
            color: #4285f4;
            font-size: 2em;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">SPONSOR KAMI JIKA MENANG</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @if(Auth::check())
                    <li class="nav-item">
                        <a href="{{ route('profile') }}" class="nav-link">
                            <img src="{{ asset('path/to/your/images/' . Auth::user()->image) }}" alt="Profil Image" class="user-image">
                            <span class="welcome">Welcome {{ Auth::user()->name }}!</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link logout">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <p class="nav-link">Silakan login untuk mengakses halaman ini.</p>
                    </li>
                @endif
            </ul>
        </div>
    </nav>

    <!-- Main Content Container -->
    <div class="container container-content text-center">
        <!-- Welcome Section -->
        <h1 class="title">Selamat Datang di Sponsor Kami Jika Menang!</h1>
        <h4 style="color: black;">website ini bertujuan untuk mengajari para semut bermain</h4>

        <!-- Create an empty container for the cover image -->
        <div id="coverImageContainer">
            <img src="https://64.media.tumblr.com/ae7d1165360abb511968c66f8d960e54/378eb43144f5fb84-54/s540x810/36d72c55a09147990858716683a5c950bc091fa2.gifv" alt="Cover Image" class="cover-image" id="dynamicCoverImage">
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            // An array of image URLs to cycle through
            var imageUrls = [
                "https://th.bing.com/th/id/OIP.FSiejbSy6P_eAJnm--lWRgHaEL?pid=ImgDet&rs=1",
                "https://th.bing.com/th/id/OIF.t2T1oD6OTuMFuS4gSiQEVg?pid=ImgDet&rs=1",
                "https://64.media.tumblr.com/ae7d1165360abb511968c66f8d960e54/378eb43144f5fb84-54/s540x810/36d72c55a09147990858716683a5c950bc091fa2.gifv",
                // Add more image URLs as needed
            ];

            // Function to change the cover image
            function changeCoverImage() {
                var dynamicCoverImage = $("#dynamicCoverImage");
                var currentImageIndex = imageUrls.indexOf(dynamicCoverImage.attr("src"));
                var nextImageIndex = (currentImageIndex + 1) % imageUrls.length;
                var nextImageUrl = imageUrls[nextImageIndex];

                // Fade out the current image
                dynamicCoverImage.fadeOut(500, function () {
                    // Set the new image source
                    dynamicCoverImage.attr("src", nextImageUrl);
                    // Fade in the new image
                    dynamicCoverImage.fadeIn(500);
                });
            }

            // Change the cover image every 5 seconds (5000 milliseconds)
            setInterval(changeCoverImage, 5000);
        </script>

        <!-- Divider -->
        <hr>

        <!-- Judul News -->
        <div class="container mt-4 text-center main-content">
            <h1 style="color: #4285f4; font-size: 2em;">NEWS</h1>
        </div>

        <!-- Tombol Add News (tampilkan hanya jika pengguna sudah login) -->
        @if(Auth::check())
            <div class="container mt-4 text-center main-content">
                <a href="{{ route('news.create') }}" class="btn btn-primary">Add News</a>
            </div>
        @endif

        <div class="container mt-4 text-center main-content">
            <a href="{{ route('news.index') }}" class="btn btn-primary">all news</a>
        </div>

        <!-- Hak Cipta -->
        <div class="container mt-4 text-center">
            <p>Copyright © 2023 Sponsor Kami Jika Menang. All rights reserved.</p>
        </div>

        <!-- Divider -->
        <hr>

    </div>

</body>

</html>
