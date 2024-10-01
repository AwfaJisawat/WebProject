<?php
include '../includes/connect.php';
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

$sql = "UPDATE books SET
                    title = '$title',
                    author_id = '$author',
                    published_year = '$published_year',
                    genre_id = '$genre',
                    description = '$description'
                    WHERE id = $id";

if ($_FILES['cover_image']['name']) {

    if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {

        if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $target_file)) {

            $sql = "UPDATE books SET
                    title = '$title',
                    author_id = '$author',
                    published_year = '$published_year',
                    genre_id = '$genre',
                    description = '$description',
                    cover_image = '$file_name'
                    WHERE id = $id";
        } else {
            echo "การอัปโหลดไฟล์ภาพล้มเหลว')";
        }
    } else {
        echo "ประเภทไฟล์ที่รองรับได้คือ JPG, JPEG, PNG และ GIF เท่านั้น";
    }
}

$rs = mysqli_query($conn, $sql);
if ($rs) {
    echo "แก้ไขหนังสือเรียบร้อย";
    echo "<a href='desc_book.php?id=$id'><button>ย้อนกลับ</button></a>";
} else {
    echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล";
}