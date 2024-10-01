<?php
include '../includes/connect.php';
include '../includes/header.php';

$sql = "SELECT br.id, b.title, br.loan_date, br.return_date
        FROM book_loans br
        INNER JOIN books b ON br.book_id = b.id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สถานะการจองหนังสือ</title>
</head>

<body>
    <h2>สถานะการจองของคุณ</h2>
    <table border="1">
        <tr>
            <th>ชื่อหนังสือ</th>
            <th>วันที่จอง</th>
            <th>วันที่คืน</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['title'] ?></td>
                <td><?= date('d/m/Y', strtotime($row['loan_date'])) ?></td>
                <td><?= date('d/m/Y', strtotime($row['return_date'])) ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>