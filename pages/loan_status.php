<?php
session_start();
$_SESSION['page1'] = "";
$_SESSION['page2'] = "";
$_SESSION['page3'] = "link-secondary active";

include '../includes/connect.php';

$sql = "SELECT br.book_id, b.cover_image, br.id, b.title, br.loan_date, br.return_date
        FROM book_loans br
        INNER JOIN books b ON br.book_id = b.id
        WHERE br.status = 'loan'";
$result = mysqli_query($conn, $sql);

if (isset($_REQUEST['return'])) {
    $id = $_REQUEST['id'];

    $return = "UPDATE book_loans SET status = 'returned', return_date = NOW() WHERE id = $id";

    // echo $return;
    mysqli_query($conn, $return);
    header("Location: loan_status.php");
    exit;
}
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สถานะการจองหนังสือ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
        td img {
            width: 50%;
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="col-md-12 d-flex justify-content-center mt-md-4">
            <span
                class="bg-primary-subtle text-primary-emphasis rounded-pill px-md-3 py-md-2 border border-primary">สถานะการยืมหนังสือของคุณ</span>
        </div>
        <table class="table mt-3">
            <tr class="text-center">
                <th></th>
                <th>ชื่อหนังสือ</th>
                <th>วันที่ยืม</th>
                <th>วันที่คืน</th>
                <th></th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr class="text-center align-middle">
                    <td class="text-end"><a href="desc_book.php?id=<?= $row["book_id"] ?>"><img
                                src="../assets/uploads/<?= $row["cover_image"] ?>" alt="<?= $row["title"] ?>"></a>
                    </td>
                    <td><?= $row['title'] ?></td>
                    <td><?= date('d/m/Y', strtotime($row['loan_date'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($row['return_date'])) ?></td>
                    <td>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleModal<?= $row["id"] ?>">
                            <i class="bi bi-book-fill pe-2"></i>คืนหนังสือ
                        </button>
                    </td>
                </tr>
                <!-- Modal -->
                <div class=" modal fade" id="exampleModal<?= $row["id"] ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">ยืนยันการคืนหนังสือ</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>คุณกำลังจะคืนหนังสือ: <strong><?= $row["title"] ?></strong></p>
                                <p>กรุณากด "ยืนยัน" เพื่อดำเนินการคืนหนังสือ</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                <a href="?return=1&id=<?= $row["id"] ?>" class="btn btn-primary">ยืนยัน</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </table>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>