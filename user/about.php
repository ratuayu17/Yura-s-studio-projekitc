<?php
session_start();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yura's Studio</title>
    <link rel="stylesheet" href="style2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg py-3 " style="background-color: black;">
        <div class="container-fluid">
            <a class="navbar-brand ms-3" href="#" style="color: white;">Yura's Studio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php
            if (!isset($_SESSION['email'])) {
                echo
                '<div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="tampilan2.php" style="color: white;">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="about.php" style="color: white;">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="studio.php" style="color: white;">Studio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="kontak.php" style="color: white;">Kontak</a>
                    </li>
                </ul>
                <a class="btn btn-dark rounded-pill me-3" href="../login/login.php" style="color: white; background-color: #EA168E;">
                    Login | Register
                </a>
                </div>';
            } else {
                $role = $_SESSION['role_akun'];
                if ($role == 2) {
                    echo
                    '<div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="tampilan2.php" style="color: white;">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="about.php" style="color: white;">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="list_tiket.php" style="color: white;">Tiket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="studio.php" style="color: white;">Studio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="kontak.php" style="color: white;">Kontak</a>
                        </li>
                    </ul>
                    <a class="btn btn-dark rounded-pill me-3" href="../login/log_out.php" style="color: white; background-color: #EA168E;">
                        Log Out
                    </a>
                    </div>';
                }
            }


            ?>
        </div>
    </nav>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 blog-content pe-5" style="margin-top: 50px;">

                    <h1 class="d-flex justify-content-center" style="margin-top: 100px;">Selamat datang di Yura's Studio!</h1>
                    <p class="text-center mt-4" style="font-size: 20px;">Kami bangga menjadi bagian dari pengalaman hiburan Anda. Kami telah berkomitmen untuk menyajikan film-film berkualitas dan pengalaman bioskop yang tak terlupakan selama bertahun-tahun.</p>

                    <h1 class="d-flex justify-content-center" style="margin-top: 200px;">Visi dan Misi</h1>


                    <ol>
                        <li style="font-size: 20px;" style="margin-top: 50px;">Visi</li>
                        <p style="font-size: 18px;"> Visi kami adalah membawa kebahagiaan melalui dunia film</p>
                        <li style="font-size: 20px;">Misi</li>
                        <p style="font-size: 18px;"> Misi kami adalah memberikan pengalaman bioskop yang luar biasa dengan teknologi terbaru dan kenyamanan terbaik.</p>
                    </ol>

                    <h3 class="d-flex justify-content-center text-center" style="margin-top: 100px;">Kami selalu mengutamakan keamanan pengunjung kami. Kami memiliki protokol ketat dalam menangani situasi darurat.</h3>
                    <h1 class="d-flex justify-content-center text-center" style="margin-top: 350px; margin-bottom: 300px;">Salam hangat dari kami terima kasih.</h1>

                </div>
            </div>
        </div>
    </div>

    <footer class="text-center" style="margin-top: 50px;">
        <p>Copyright 2023 Yura's Studio</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>