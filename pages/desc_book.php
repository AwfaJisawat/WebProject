<?php
include '../includes/connect.php';
include '../includes/header.php';

$id = $_REQUEST["id"];

$sql = "SELECT cover_image, title, published_year, description, g.name , a.pseudonym FROM books as b
        INNER JOIN authors as a ON b.author_id = a.id
        INNER JOIN genres as g ON b.genre_id = g.id
        WHERE b.id = $id";

$rs = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($rs);

if (isset($_REQUEST["loan"])) {
    $loan_date = date('Y-m-d H:i:s'); // เปลี่ยนรูปแบบวันที่ให้ตรงกับที่บันทึกในฐานข้อมูล
    $return_date = date('Y-m-d H:i:s', strtotime($loan_date . ' +7 days')); // เพิ่ม 7 วัน
    $sql = "INSERT INTO book_loans (book_id, loan_date, return_date)
            VALUES ('$id', '$loan_date', '$return_date')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('จองหนังสือสำเร็จ!'); window.location.href = 'index.php';</script>";
    } else {
        echo "เกิดข้อผิดพลาด";
    }
}

if (isset($_REQUEST["add_comment"])) {
    $comment = $_REQUEST["comment_text"];
    $sql = $conn->prepare("INSERT INTO reviews (book_id, comment) VALUES (?, ?)");
    $sql->bind_param("is", $id, $comment);
    if ($sql->execute()) {
        echo "<script>window.location.href = 'desc_book.php?id=$id';</script>";
        // header('Location : desc_book.php');
        exit;
    } else {
        echo "เกิดข้อผิดพลาด";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
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

        .comment-section {
            margin-top: 50px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .comment-section h3 {
            margin-bottom: 20px;
        }

        .comment-section .form-label {
            font-weight: bold;
        }

        .modal-body p {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="main">
        <h1 class="title"><?= $row["title"] ?></h1>
        <div class="descript">
            <div class="image">
                <img src="../assets/uploads/<?= $row["cover_image"] ?>" alt="Book Cover">
            </div>
            <div class="text">
                <p>โดย <strong><?= $row["pseudonym"] ?></strong></p>
                <p>หมวดหมู่: <strong><?= $row["name"] ?></strong></p>
                <p>ปีที่ตีพิมพ์: <strong><?= $row["published_year"] ?></strong></p>
                <p>รายละเอียด: <span><?= $row["description"] ?></span></p>

                <div class="mt-4">
                    <a class="btn btn-primary" href="edit_book.php?id=<?= $id ?>">แก้ไข</a>
                    <a class="btn btn-danger" href="delete_book.php?id=<?= $id ?>"
                        onclick="return confirm('คุณแน่ใจว่าจะลบหนังสือเล่มนี้ใช่ไหม?')">ลบ</a>
                </div>

                <button type="button" class="btn btn-success mt-3" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    ยืมหนังสือ
                </button>
            </div>
        </div>

        <!-- Comment Section -->
        <div class="container comment-section">
            <h3>ความคิดเห็น</h3>
            <form action="" method="POST">
                <input type="hidden" name="book_id" value="<?= $id ?>"> <!-- ส่ง ID ของหนังสือไปด้วย -->
                <div class="row mb-3">
                    <div class="col-sm-8">
                        <label for="comment_text" class="form-label">แสดงความคิดเห็น</label>
                        <textarea class="form-control" name="comment_text" rows="3" required></textarea>
                    </div>
                    <div class="col-sm-4 d-flex align-items-end">
                        <button type="submit" name="add_comment" class="btn btn-primary">ส่งความคิดเห็น</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Book Loan Confirmation -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ยืนยันการยืมหนังสือ</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>คุณกำลังจะยืมหนังสือ: <strong><?= $row["title"] ?></strong></p>
                    <p>วันที่คืนหนังสือคือ:
                        <strong><?= date('d/m/Y', strtotime(date('d-m-Y') . ' +7 days')) ?></strong>
                    </p>
                    <p>กรุณากด "ยืนยัน" เพื่อดำเนินการยืมหนังสือ</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <a href="desc_book.php?id=<?= $id ?>&loan=1" class="btn btn-primary">ยืนยันการยืม</a>
                </div>
            </div>
        </div>
    </div>
</body>