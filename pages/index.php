<?php
session_start();
$_SESSION['page1'] = "link-secondary active";
$_SESSION['page2'] = "";
$_SESSION['page3'] = "";

include '../includes/connect.php';
include '../includes/header.php';

$sql1 = "SELECT b.id, cover_image, title, g.name , a.pseudonym FROM books as b
        INNER JOIN authors as a ON b.author_id = a.id
        INNER JOIN genres as g ON b.genre_id = g.id
        WHERE b.id NOT IN (5,6,7,8) AND b.genre_id = 5
        LIMIT 5";
$rs = mysqli_query($conn, $sql1);

$sql2 = "SELECT b.id, cover_image, title, g.name , a.pseudonym FROM books as b
        INNER JOIN authors as a ON b.author_id = a.id
        INNER JOIN genres as g ON b.genre_id = g.id
        WHERE b.id NOT IN (5,6,7,8) AND b.genre_id = 8
        LIMIT 5";
$rs2 = mysqli_query($conn, $sql2);

$sql3 = "SELECT b.id, cover_image, title, g.name , a.pseudonym FROM books as b
        INNER JOIN authors as a ON b.author_id = a.id
        INNER JOIN genres as g ON b.genre_id = g.id
        WHERE b.id NOT IN (5,6,7,8) AND b.genre_id = 9
        LIMIT 5";
$rs3 = mysqli_query($conn, $sql3);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Book</title>
    <link rel="icon" href="../assets/images/logo.jpeg" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!--<link rel="stylesheet" href="assets/css/style.css">-->
    <style>
    * {
        box-sizing: border-box;
    }

    .h {
        margin: 20px 0 10px 20px;
    }

    .line {
        width: 97%;
        height: 0.1px;
        background-color: rgba(149, 157, 165);
        margin: 5px 0 0 20px;
    }

    .card {
        width: 220px;
        height: 400px;
        border: 1px solid lightgray;
        border-radius: 10px;
        object-fit: cover;
        display: inline-block;
        margin: 20px 17.5px;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 5px 24px;
    }

    .card:hover {
        box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px;
    }

    .card .image {
        height: 80%;
        margin-bottom: 1px;
        border-radius: 10px;
        overflow: hidden;
    }

    .card .image img {
        width: 100%;
        height: 300px;
    }

    .card .caption {
        padding-left: 0.8rem;
        padding-right: 0.2rem;
        line-height: 0.5rem;
        height: 25%;
    }

    .card .caption h3 {
        font-size: 0.9rem;
        line-height: 1rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card .caption p {
        font-size: 0.8rem;
        color: gray;
    }

    @media (max-width: 600px) {
        .card {
            width: 100%;
            height: auto;
        }
    }

    .carousel-item img {
        object-fit: cover;
        width: 100%;
        height: 70vh;
    }
    </style>
</head>

<body>
    <!-- Carousel Section -->
    <div id="myCarousel" class="carousel slide mb-6 col-12 text-center" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class="active"
                aria-current="true"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../assets/images/banner1.jpeg" alt="Banner 1">
            </div>
            <div class="carousel-item">
                <img src="../assets/images/banner2.jpeg" alt="Banner 2">
            </div>
            <div class="carousel-item">
                <img src="../assets/images/banner3.jpeg" alt="Banner 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="main">
        <div class="container">
            <h4 class="h fw-light">จิตวิทยา</h4>
            <div class="line"></div>
            <?php
            while ($row = mysqli_fetch_assoc($rs)) { ?>
            <div class="card box-shadow-inset">
                <div class="image">
                    <a href="desc_book.php?id=<?= $row["id"] ?>">
                        <img src="../assets/uploads/<?= $row["cover_image"] ?>" alt="<?= $row["title"] ?>">
                    </a>
                </div>
                <div class="caption">
                    <h3><strong><?= $row["title"] ?></strong></h3>
                    <p><?= $row["pseudonym"] ?></p>
                    <p><?= $row["name"] ?></p>
                </div>
            </div>
            <?php
            }
            ?>
        </div>

        <div class="container">
            <h4 class="h fw-light">การ์ตูน</h4>
            <div class="line"></div>
            <?php
            while ($row = mysqli_fetch_assoc($rs2)) { ?>
            <div class="card box-shadow-inset">
                <div class="image">
                    <a href="desc_book.php?id=<?= $row["id"] ?>">
                        <img src="../assets/uploads/<?= $row["cover_image"] ?>" alt="<?= $row["title"] ?>">
                    </a>
                </div>
                <div class="caption">
                    <h3><strong><?= $row["title"] ?></strong></h3>
                    <p><?= $row["pseudonym"] ?></p>
                    <p><?= $row["name"] ?></p>
                </div>
            </div>
            <?php
            }
            ?>
        </div>

        <div class="container">
            <h4 class="h fw-light">นิยาย</h4>
            <div class="line"></div>
            <?php
            while ($row = mysqli_fetch_assoc($rs3)) { ?>
            <div class="card box-shadow-inset">
                <div class="image">
                    <a href="desc_book.php?id=<?= $row["id"] ?>">
                        <img src="../assets/uploads/<?= $row["cover_image"] ?>" alt="<?= $row["title"] ?>">
                    </a>
                </div>
                <div class="caption">
                    <h3><strong><?= $row["title"] ?></strong></h3>
                    <p><?= $row["pseudonym"] ?></p>
                    <p><?= $row["name"] ?></p>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <br>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

    <?php include '../includes/footer.php'; ?>

</body>

</html>
<?php mysqli_close($conn); ?>
<!--<a href="do_del.php?studentid=<?= $row["student_id"] ?>" onclick="myFunction()">Withdraw</a>