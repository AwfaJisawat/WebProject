<?php
include '../includes/connect.php';
$id = $_REQUEST["id"];
$sql = "DELETE FROM books WHERE id = $id";
$rs = mysqli_query($conn, $sql);

if ($rs) {
    echo "ลบหนังสือเรียบร้อย";
    echo "<a href='../index.php'><button>ย้อนกลับ</button></a>";
} else {
    echo "เกิดข้อผิดพลาดในการลบ";
}
