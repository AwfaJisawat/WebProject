<?php
include '../includes/connect.php';
$author_sql = "SELECT  * FROM authors";
$result1 = mysqli_query($conn, $author_sql);
$genres_sql = "SELECT  * FROM genres";
$result2 = mysqli_query($conn, $genres_sql);
//while ($row = mysqli_fetch_assoc($result)) {}
include '../includes/header2.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div class="container">
        <form class="col-md-4 mt-3" action="" method="POST" enctype="multipart/form-data">
            <label class="form-label" for="title">Title</label>
            <input class="form-control form-control-sm" type="text" name="title" id="title" required><br>

            <label class="form-label" for="author">Author</label>
            <input class="form-control form-control-sm" type="text" name="author" id="author" list="authorList"
                placeholder="ค้นหาชื่อนักเขียน..." required>
            <datalist id="authorList">
                <?php while ($row1 = mysqli_fetch_assoc($result1)) {
                    echo '<option value="' . $row1["pseudonym"] . '">';
                } ?>
            </datalist><br>

            <label class="form-label" for="published_year">Published Year</label>
            <input class="form-control form-control-sm" type="number" name="published_year" id="published_year"
                required><br>

            <label class="form-label" for="genre">Genre</label>
            <select class="form-select form-select-sm" name="genre" required>
                <option value="" selected disabled hidden>-- Select Genre --</option>
                <?php while ($row2 = mysqli_fetch_assoc($result2)) {
                ?>
                    <option value="<?= $row2["id"] ?>"><?= $row2["name"] ?></option>
                <?php
                } ?>
            </select><br>

            <label class="form-label" for="description">Description</label>
            <textarea class="form-control form-control-sm" name="description" id="description" cols="20" rows="5"
                required></textarea><br>

            <label class="form-label" for="cover_image">Cover Image</label>
            <input class="form-control form-control-sm" type="file" name="cover_image" id="cover_image" accept="image/*"
                required><br>


            <button class="btn btn-primary" type="submit"><i class="bi bi-upload pe-2"></i>Add Book</button>
        </form>
    </div>
</body>
<?php // ตรวจสอบว่ามีการส่งข้อมูลแบบ POST เข้ามาหรือไม่

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_REQUEST['title'];
    // $author = $_REQUEST['author'];
    $author_name = $_REQUEST['author'];
    // ดึง author_id ตามชื่อนักเขียน
    $author_query = "SELECT id FROM authors WHERE pseudonym = '$author_name'";
    $author_result = mysqli_query($conn, $author_query);
    $author_row = mysqli_fetch_assoc($author_result);
    $author_id = $author_row['id'];

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
VALUES ('$title', '$author_id', '$published_year', '$genre', '$description', '$file_name')";
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