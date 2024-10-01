<?php
include '../includes/connect.php';
$id = $_REQUEST["id"];
$sql = "SELECT genre_id, author_id, cover_image, title, published_year, description, g.name , a.pseudonym FROM books as b
        INNER JOIN authors as a ON b.author_id = a.id
        INNER JOIN genres as g ON b.genre_id = g.id
        WHERE b.id = $id";
$author_sql = "SELECT  * FROM authors";
$result1 = mysqli_query($conn, $author_sql);
$genres_sql = "SELECT  * FROM genres";
$result2 = mysqli_query($conn, $genres_sql);
$rs = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($rs);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
</head>

<body>
    <form action="show_edit.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="<?= $row["title"] ?>" required><br>

        <label for="author">Author:</label>
        <select name="author" require>
            <option value="<?= $row["author_id"] ?>" selected hidden><?= $row["pseudonym"] ?></option>
            <?php
            while ($row1 = mysqli_fetch_assoc($result1)) { ?>
            <option value="<?= $row1["id"] ?>"><?= $row1["pseudonym"] ?></option>
            <?php
            } ?>
        </select><br>

        <label for="published_year">Published Year:</label>
        <input type="number" name="published_year" id="published_year" value="<?= $row["published_year"] ?>"
            required><br>

        <label for="genre">Genre:</label>
        <select name="genre" require>
            <option value="<?= $row["genre_id"] ?>" selected hidden><?= $row["name"] ?></option>
            <?php
            while ($row2 = mysqli_fetch_assoc($result2)) { ?>
            <option value="<?= $row2["id"] ?>"><?= $row2["name"] ?></option>
            <?php
            } ?>
        </select><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" cols="30" rows="10"
            required><?= $row["description"] ?></textarea><br>

        <label for="cover_image">Cover Image:</label>
        <input type="file" name="cover_image" id="cover_image" accept="image/*"><br>

        <input type="submit" value="Confirm" onclick="return confirm('คุณแน่ใจที่จะแก้ไขหรือไม่ที่?')">
    </form>
</body>