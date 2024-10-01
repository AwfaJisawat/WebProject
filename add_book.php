<?php
include '../includes/connect.php';
$author_sql = "SELECT  * FROM authors";
$result1 = mysqli_query($conn, $author_sql);
$genres_sql = "SELECT  * FROM genres";
$result2 = mysqli_query($conn, $genres_sql);
//while ($row = mysqli_fetch_assoc($result)) {}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
</head>

<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required><br>

        <label for="author">Author:</label>
        <select name="author" require>
            <option value="" selected disabled hidden>-- Select Author --</option>
            <?php
            while ($row1 = mysqli_fetch_assoc($result1)) { ?>
                <option value="<?= $row1["id"] ?>"><?= $row1["pseudonym"] ?></option>
            <?php
            } ?>
        </select><br>

        <label for="published_year">Published Year:</label>
        <input type="number" name="published_year" id="published_year" required><br>

        <label for="genre">Genre:</label>
        <select name="genre" require>
            <option value="" selected disabled hidden>-- Select Genre --</option>
            <?php
            while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                <option value="<?= $row2["id"] ?>"><?= $row2["name"] ?></option>
            <?php
            } ?>
        </select><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" cols="30" rows="10" required></textarea><br>

        <label for="cover_image">Cover Image:</label>
        <input type="file" name="cover_image" id="cover_image" accept="image/*" required><br>

        <input type="submit" value="Add Book">
    </form>
</body>

<?php
// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST เข้ามาหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_REQUEST['title'];
    $author = $_REQUEST['author'];
    $published_year = $_REQUEST['published_year'];
    $genre = $_REQUEST['genre'];
    $description = $_REQUEST['description'];

    // นำเข้ารูปภาพ
    $target_dir = "../assets/uploads/";
    $file_name = basename($_FILES['cover_image']['name']);
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // ตรวจสอบประเภทไฟล์
    if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {

        // ย้ายไฟล์ภาพไปยังโฟลเดอร์ที่กำหนด
        if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $target_file)) {

            $sql = "INSERT INTO books (title, author_id, published_year, genre_id, description, cover_image)
                                                            VALUES ('$title', '$author', '$published_year', '$genre', '$description', '$file_name')";
            $rs = mysqli_query($conn, $sql);

            if ($rs) {
                echo "<script>alert('เพิ่มหนังสือและอัปโหลดภาพเรียบร้อย!')</script>";
            } else {
                echo "<script>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล')</script>";
            }
        } else {
            echo "<script>alert('การอัปโหลดไฟล์ภาพล้มเหลว')</script>";
        }
    } else {
        echo "<script>alert('ประเภทไฟล์ที่รองรับได้คือ JPG, JPEG, PNG และ GIF เท่านั้น')</script>";
    }
}
?>