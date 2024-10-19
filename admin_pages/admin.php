<?php
include '../includes/connect.php';

$sql = "SELECT b.id, genre_id, author_id, cover_image, title, published_year, description, g.name , a.pseudonym FROM books as b
INNER JOIN authors as a ON b.author_id = a.id
INNER JOIN genres as g ON b.genre_id = g.id";
$rs = mysqli_query($conn, $sql);

$author_sql = "SELECT  * FROM authors";
$result1 = mysqli_query($conn, $author_sql);
$genres_sql = "SELECT  * FROM genres";
$result2 = mysqli_query($conn, $genres_sql);

if (isset($_REQUEST["edit"])) {
    $id = $_REQUEST["id"];
    $title = $_REQUEST['title'];
    $author = $_REQUEST['author'];
    $published_year = $_REQUEST['published_year'];
    $genre = $_REQUEST['genre'];
    $description = $_REQUEST['description'];

    $target_dir = "../assets/uploads/";
    $file_name = basename($_FILES['cover_image']['name']);
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $update = "UPDATE books SET
                    title = '$title',
                    author_id = '$author',
                    published_year = '$published_year',
                    genre_id = '$genre',
                    description = '$description'
                    WHERE id = $id";

    if ($_FILES['cover_image']['name']) {

        if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {

            if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $target_file)) {

                $update = "UPDATE books SET
                    title = '$title',
                    author_id = '$author',
                    published_year = '$published_year',
                    genre_id = '$genre',
                    description = '$description',
                    cover_image = '$file_name'
                    WHERE id = $id";
            } else {
                echo "<script>alert('การอัปโหลดไฟล์ภาพล้มเหลว')</script>')";
            }
        } else {
            echo "<script>alert('ประเภทไฟล์ที่รองรับได้คือ JPG, JPEG, PNG และ GIF เท่านั้น')</script>";
        }
    }

    if (mysqli_query($conn, $update)) {
        echo "<script>alert('แก้ไขหนังสือเรียบร้อย')</script>";
        header("Location: admin.php");
        exit;
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล')</script>";
    }
}

if (isset($_REQUEST["delete"])) {
    $id = $_REQUEST["id"];
    $delete = "DELETE FROM books WHERE id = $id";

    if (mysqli_query($conn, $delete)) {
        echo "<script>alert('ลบหนังสือเรียบร้อย')</script>";
        header("Location: admin.php");
        exit;
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการลบ')</script>";
    }
}

include '../includes/header2.php';
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Book Admin</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.jpeg">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
    img {
        width: 100%;
        height: 100px;
    }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="text-center py-5 border-bottom">- Book Lists -</h1>
        <table class="table">
            <tr class="text-center">
                <th>ID</th>
                <th width="7%">Cover Image</th>
                <th>Title</th>
                <th>Published Year</th>
                <th>Genre</th>
                <th width="40%">Description</th>
                <th colspan="3">Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($rs)) { ?>
            <tr class="align-middle">
                <td><?= $row['id']; ?></td>
                <td><img src="../assets/uploads/<?= $row["cover_image"] ?>" alt="<?= $row["title"] ?>"></td>
                <td><?= $row['title']; ?></td>
                <td class="text-center"><?= $row['published_year']; ?></td>
                <td><?= $row['name']; ?></td>
                <td class="text-wrap"><?= $row['description']; ?></td>
                <td>
                    <a href="desc_admin.php?id=<?= $row["id"] ?>" class="btn btn-success"
                        style="white-space: nowrap;">รายละเอียด</a>
                </td>
                <td>
                    <a href="?edit=1&id=<?= $row["id"] ?>" class="btn btn-warning" data-bs-toggle="modal"
                        data-bs-target="#exampleModal<?= $row["id"] ?>"><i class="bi bi-pencil-square"></i>
                    </a>
                </td>
                <td>
                    <a class="btn btn-danger" href="?delete=1&id=<?= $row["id"] ?>"
                        onclick="return confirm('คุณแน่ใจว่าจะลบหนังสือเล่มนี้ใช่ไหม?')"><i
                            class="bi bi-trash-fill"></i></a>
                </td>
            </tr>

            <!-- Modal for Book Edit Form -->
            <div class="modal fade" id="exampleModal<?= $row["id"] ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel<?= $row["id"] ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel<?= $row["id"] ?>">แก้ไขหนังสือ</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="form" action="?edit=1&id=<?= $row["id"] ?>" method="POST"
                                enctype="multipart/form-data">
                                <label class="form-label" for="title"><strong>Title</strong></label>
                                <input class="form-control" type="text" name="title" id="title"
                                    value="<?= $row["title"] ?>" required><br>

                                <label class="form-label" for="author"><strong>Author</strong></label>
                                <select class="form-select" name="author" require>
                                    <option value="<?= $row["author_id"] ?>" selected hidden>
                                        <?= $row["pseudonym"] ?>
                                    </option>
                                    <?php
                                        $result1 = mysqli_query($conn, "SELECT * FROM authors");
                                        while ($row1 = mysqli_fetch_assoc($result1)) { ?>
                                    <option value="<?= $row1["id"] ?>"><?= $row1["pseudonym"] ?></option>
                                    <?php } ?>
                                </select><br>

                                <label class="form-label" for="published_year"><strong>Published Year</strong></label>
                                <input class="form-control" type="number" name="published_year" id="published_year"
                                    value="<?= $row["published_year"] ?>" required><br>

                                <label for="genre"><strong>Genre</strong></label>
                                <select class="form-select" name="genre" require>
                                    <option value="<?= $row["genre_id"] ?>" selected hidden><?= $row["name"] ?></option>
                                    <?php
                                        $result2 = mysqli_query($conn, "SELECT * FROM genres");
                                        while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                    <option value="<?= $row2["id"] ?>"><?= $row2["name"] ?></option>
                                    <?php } ?>
                                </select><br>

                                <label class="form-label" for="description"><strong>Description</strong></label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="5"
                                    required><?= $row["description"] ?></textarea><br>

                                <label class="form-label" for="cover_image"><strong>Cover Image</strong></label>
                                <input class="form-control" type="file" name="cover_image" id="cover_image"
                                    accept="image/*"><br>
                        </div>
                        <div class="modal-footer d-flex">
                            <input class="btn btn-success" type="submit" value="Confirm"
                                onclick="return confirm('คุณแน่ใจที่จะแก้ไขหรือไม่?')">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </table>
    </div>
</body>

</html>