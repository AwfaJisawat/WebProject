<?php
include '../includes/connect.php';
include '../includes/header.php';

$sql = "SELECT b.id, cover_image, title, g.name , a.pseudonym FROM books as b
        INNER JOIN authors as a ON b.author_id = a.id
        INNER JOIN genres as g ON b.genre_id = g.id";
$rs = mysqli_query($conn, $sql);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <!--<link rel="stylesheet" href="assets/css/style.css">-->
    <style>
        * {
            box-sizing: border-box;
        }

        .h {
            margin: 20px 0 0 20px;
        }

        .line {
            width: 97%;
            height: 1px;
            background-color: black;
            margin: 5px 0 0 20px;
        }

        .card {
            width: 220px;
            height: 380px;
            border: 1px solid lightgray;
            border-radius: 10px;
            object-fit: cover;
            display: inline-block;
            margin: 20px 10px;
        }

        .card:hover {
            box-shadow: 0 4px 4px 0 orange, 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .card .image {
            height: 75%;
            margin-bottom: 10px;
            border-radius: 10px;
            overflow: hidden;
        }

        .card .image img {
            width: 100%;
            height: 275px;
        }

        .card .caption {
            padding-left: 1rem;
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
    </style>
</head>

<body>
    <div class="main">
        <h2 class="h">หนังสือยอดนิยม</h2>
        <div class="line"></div>
        <?php
        while ($row = mysqli_fetch_assoc($rs)) { ?>
            <div class="card">
                <div class="image">
                    <a href="desc_book.php?id=<?= $row["id"] ?>">
                        <img src="../assets/uploads/<?= $row["cover_image"] ?>" alt="<?= $row["title"] ?>">
                    </a>
                </div>
                <div class="caption">
                    <h3><?= $row["title"] ?></h3>
                    <p><?= $row["pseudonym"] ?></p>
                    <p><?= $row["name"] ?></p>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>
<?php mysqli_close($conn); ?>
<!--<a href="do_del.php?studentid=<?= $row["student_id"] ?>" onclick="myFunction()">Withdraw</a>