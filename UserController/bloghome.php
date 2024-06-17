<?php
include '../connection.php'; // Include the connection file

// Query to get articles
$query = "SELECT artikel.*, kategori.nama_kategori 
          FROM artikel 
          JOIN kategori ON artikel.id_kategori = kategori.id_kategori 
          ORDER BY artikel.tanggal DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog Home</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#!">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Selamat Datang di Blog Kami!</h1>
                <p class="lead mb-0">Perluas Informasi Anda Melalui Website Kami</p>
            </div>
        </div>
    </header>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <?php
                $featured = true;
                $post_counter = 0;
                while ($row = $result->fetch_assoc()):
                    if ($featured): ?>
                        <!-- Featured blog post-->
                        <div class="card mb-4">
                            <a href="blogpost.php?id=<?= $row['id_artikel'] ?>"><img class="card-img-top"
                                    src="data:image/jpeg;base64,<?= base64_encode($row['gambar']) ?>" alt="..." width="850"
                                    height="350" /></a>
                            <div class="card-body">
                                <div class="small text-muted"><?= ($row['tanggal']) ?></div>
                                <h2 class="card-title"><?= $row['judul'] ?></h2>
                                <p class="card-text"><?= substr($row['isi'], 0, 200) ?>...</p>
                                <a class="btn btn-primary" href="blogpost.php?id=<?= $row['id_artikel'] ?>">Read more →</a>
                            </div>
                        </div>
                        <!-- Nested row for non-featured blog posts-->
                        <div class="row">
                            <?php
                            $featured = false;
                    else: ?>
                            <div class="col-lg-6">
                                <!-- Blog post-->
                                <div class="card mb-4">
                                    <a href="blogpost.php?id=<?= $row['id_artikel'] ?>"><img class="card-img-top"
                                            src="data:image/jpeg;base64,<?= base64_encode($row['gambar']) ?>" alt="..."
                                            width="700" height="350" /></a>
                                    <div class="card-body">
                                        <div class="small text-muted"><?= ($row['tanggal']) ?></div>
                                        <h2 class="card-title h4"><?= $row['judul'] ?></h2>
                                        <p class="card-text"><?= substr($row['isi'], 0, 100) ?>...</p>
                                        <a class="btn btn-primary" href="blogpost.php?id=<?= $row['id_artikel'] ?>">Read
                                            more →</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $post_counter++;
                            if ($post_counter % 2 == 0):
                                echo '</div><div class="row">';
                            endif;
                    endif;
                endwhile;
                if ($post_counter % 2 != 0):
                    echo '</div>'; // Close the last row if it's not closed
                endif;
                ?>
                </div> <!-- Close the main blog entries column -->
                <!-- Pagination-->
                <nav aria-label="Pagination">
                    <hr class="my-0" />
                    <ul class="pagination justify-content-center my-4">
                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"
                                aria-disabled="true">Newer</a></li>
                        <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                        <li class="page-item"><a class="page-link" href="#!">2</a></li>
                        <li class="page-item"><a class="page-link" href="#!">3</a></li>
                        <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                        <li class="page-item"><a class="page-link" href="#!">15</a></li>
                        <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                    </ul>
                </nav>
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">Search</div>
                    <div class="card-body">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Enter search term..."
                                aria-label="Enter search term..." aria-describedby="button-search" />
                            <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                        </div>
                    </div>
                </div>
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">Reviewer</a></li>
                                    <li><a href="#!">Kesehatan</a></li>
                                    <li><a href="#!">Berita</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">Tutorial</a></li>
                                    <li><a href="#!">Pendidikan</a></li>
                                    <li><a href="#!">Opini</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Side widget-->
                <div class="card mb-4">
                        <div class="card-header">Komentar</div>
                        <body>
                        <h3>Form Komentar</h3>

                        <form action="#" method="post">
                            <label for="name">Nama:</label><br>
                            <input type="text" id="name" name="name" required><br>

                            <label for="email">Email:</label><br>
                            <input type="email" id="email" name="email" required><br>

                            <label for="comment">Komentar:</label><br>
                            <textarea id="comment" name="comment" rows="4" required></textarea><br>

                            <input type="submit" value="Kirim">
                        </form>
                        </body>
                    </div>
            </div>
        </div>
    </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; elailma217@gmail.com</p></div>
        </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>