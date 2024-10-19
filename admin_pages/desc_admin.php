<?php
include '../includes/connect.php';

$id = $_REQUEST["id"];

$sql = "SELECT cover_image, title, published_year, description, g.name , a.pseudonym FROM books as b
        INNER JOIN authors as a ON b.author_id = a.id
        INNER JOIN genres as g ON b.genre_id = g.id
        WHERE b.id = $id";

$rs = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($rs);

$review_sql = "SELECT  * FROM reviews WHERE book_id = $id";
$review_rs = mysqli_query($conn, $review_sql);

include '../includes/header2.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Book</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.jpeg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
    * {
        box-sizing: border-box;
    }

    .title {
        text-align: center;
        margin: 20px;
    }

    .descript {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60%;
        margin: 0 auto;
    }


    .descript .image {
        width: 40%;
        height: 520px;
        border: 1px solid lightgray;
        border-radius: 10px;
        object-fit: cover;
        overflow: hidden;
        margin: 20px 50px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .descript .image img {
        width: 100%;
        height: 520px;
    }

    .descript .text {
        line-height: 22px;
        width: 60%;

        a {
            text-decoration: none;
        }

        span {
            font-size: 14px;
        }
    }

    .modal-body p {
        font-size: 18px;
    }

    .profile-pic img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #4CAF50;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
        font-weight: bold;
        margin-top: 20px;
    }
    </style>
</head>

<body class=" bg-body-tertiary">
    <div class="main">
        <h2 class="title py-3 fw-bold"><?= $row["title"] ?></h2>
        <div class="descript">
            <div class="image">
                <img src="../assets/uploads/<?= $row["cover_image"] ?>" alt="Book Cover">
            </div>
            <div class="text">
                <p class="fw-bold">โดย <span class="fw-normal text-primary fs-6 px-2"> <?= $row["pseudonym"] ?></span>
                </p>
                <p class="fw-bold">หมวดหมู่ <span class="fw-normal text-primary fs-6 px-2"> <?= $row["name"] ?></span>
                </p>
                <p class="fw-bold">ปีที่ตีพิมพ์ <span class="fw-normal text-primary fs-6 px-2">
                        <?= $row["published_year"] ?></span>
                </p>
                <p class="fw-bold my-2">รายละเอียด<br></p>
                <p class="fw-light"><?= $row["description"] ?></p>

                <!-- <div class="mt-4">
                    <a class="btn btn-primary" href="edit_book.php?id=<?= $id ?>">แก้ไข</a>
                    <a class="btn btn-danger" href="delete_book.php?id=<?= $id ?>"
                        onclick="return confirm('คุณแน่ใจว่าจะลบหนังสือเล่มนี้ใช่ไหม?')">ลบ</a>
                </div> -->

            </div>
        </div>
        <br>

        <!-- Comment Section -->
        <div class="container row">
            <h3 class="col-6 offset-3 pb-3 pt-5"><i class="bi bi-chat-right-text-fill pe-3"></i>รีวิว</h3>
            <hr class="border-secondary" style="margin-left:300px;width:930px">
        </div>
        <br>

        <!-- review -->
        <div class="container row gap-2">
            <?php
            if (mysqli_num_rows($review_rs) > 0) {
                while ($row2 = mysqli_fetch_assoc($review_rs)) { ?>
            <div class="card col-md-4 offset-3" id="review" style="width: 55rem;">
                <div class="d-flex">
                    <div class="profile-pic">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZPRo5ILl4Tew10m2HkWjfk8vgdhNwdxzvbw&s"
                            alt="cat">
                    </div>
                    <div class="card-body">
                        <h6 class="card-title"><?= $row2["name"] ?></h6>
                        <p class="card-text"><?= $row2["comment"] ?></p>
                    </div>
                </div>
            </div>
            <?php }
            } else { ?>
            <div class="card col-md-4 offset-3" id="review" style="width: 55rem;">
                <div class="d-flex">
                    <div class="card-body">
                        <div class="card-body">
                            <h6 class="card-text text-center">ไม่มีรีวิว</h6>
                        </div>
                    </div>
                </div>
            </div>

            <?php } ?>
        </div>
        <br>

    </div>

    <?php include '../includes/footer.php'; ?>
</body>