<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: url('https://wallpapers.com/images/hd/astronaut-4k-space-9w27dqmc4nrs3xwd.jpg') center center fixed; /* Latar belakang luar angkasa */
            background-size: cover;
            color: #ffffff; /* Warna teks putih */
            font-family: 'Arial', sans-serif;
            text-align: center;
        }
        h1 {
            font-size: 120px;
            margin: 0;
            color: #ff0000; /* Warna kuning untuk 404 */
            text-shadow: 0 0 20px rgba(0, 89, 255, 0.8);
            animation: spotlight 1.5s infinite alternate; /* Animasi spotlight */
        }
        h2 {
            font-size: 24px;
            margin: 20px 0;
        }
        p {
            font-size: 18px;
            margin: 10px 0;
        }
        .icon {
            font-size: 50px;
            color: #ffcc00; /* Warna kuning untuk icon */
        }
        footer {
            margin-top: 50px;
            font-size: 14px;
            color: #ffffff;
        }
        @keyframes spotlight {
            0% {
                text-shadow: 0 0 20px rgba(255, 204, 0, 0.8);
            }
            100% {
                text-shadow: 0 0 40px rgba(255, 204, 0, 1);
            }
        }
    </style>
</head>
<body>
    <div>
        <h1 id="error-code">404</h1>
        <h2>Mohon Maaf, Halaman Ini Sedang dalam Masa Pengembangan</h2>
        <p class="icon">👋</p> <!-- Icon salam -->
        <p>Mohon bersabar, kami sedang berusaha untuk menyajikan yang terbaik untuk Anda.</p>
        <a href="{{ url('/admin/dashboard') }}" style="display: inline-block; padding: 10px 20px; border-radius: 25px; background-color: #ffcc00; color: #000; text-decoration: none; font-weight: bold; text-align: center;">Kembali ke Beranda</a>
    </div>
    <footer>
        <p>Dinas Kominfo Kota Batu</p>
    </footer>
    <script>
        // Animasi lampu sorot untuk angka 404
        const errorCode = document.getElementById('error-code');
        let isBright = false;

        setInterval(() => {
            isBright = !isBright;
            errorCode.style.color = isBright ? '#ff0000' : '#ffff'; // Mengubah warna
        }, 500); // Interval 500ms
    </script>
</body>
</html>
