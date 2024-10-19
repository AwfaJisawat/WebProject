<?php
if (isset($_REQUEST["signout"])) {
    $_SESSION["login"] = "no";
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Book</title>
    <link rel="icon" href="../assets/images/logo.jpeg" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script> -->
    <script>
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
    </script>
</head>

<body>

    <div class="sticky-top container-fluid bg-body shadow-sm  border-bottom">
        <header class="py-0 mb-0">
            <div class="container d-flex flex-wrap align-items-center justify-content-md-between ">
                <div class="col-md-3">
                    <a href="./index.php" class="d-inline-flex link-body-emphasis text-decoration-none ">
                        <img src="../assets/images/logo.jpeg" alt="" style="width: 60px; height: 60px;">
                    </a>
                </div>

                <ul class="nav nav-underline col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="./index.php" class="nav-link px-2 <?= $_SESSION["page1"] ?>">หน้าหลัก</a></li>
                    <li><a href="./main.php" class="nav-link px-2  <?= $_SESSION["page2"] ?>">หนังสือยอดนิยม</a></li>
                    <li><a href="./loan_status.php" class="nav-link px-2  <?= $_SESSION["page3"] ?>">สถานะการยืม</a>
                    </li>
                </ul>

                <?php if (isset($_SESSION["login"]) && $_SESSION["login"] == "no") { ?>
                <div class=" col-md-3 text-end">
                    <a href="./login.php" class="btn btn-outline-primary me-2">Login</a><br>
                </div>
                <?php } else { ?>
                <div class="dropdown col-md-3 pt-1 text-end">
                    <div class="d-inline-flex">
                        <img src="
                        https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZPRo5ILl4Tew10m2HkWjfk8vgdhNwdxzvbw&s"
                            alt="cat" width="40" height="40" class="rounded-circle">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none mx-2 my-2"
                            onclick="myFunction()"><i class="bi bi-caret-down-fill"></i></a>
                    </div>
                    <div id="myDropdown" class="dropdown-menu position-absolute top-100 end-0">
                        <a class="dropdown-item" href="#"><i class="bi bi-gear pe-2"></i>Settings</a>
                        <a class="dropdown-item" href="#"><i class="bi bi-person pe-2"></i>Profile</a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item text-danger" href="?signout=1"><i
                                class="bi bi-box-arrow-in-right pe-2"></i>Sign out</a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </header>
    </div>
    <!-- <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZPRo5ILl4Tew10m2HkWjfk8vgdhNwdxzvbw&s" alt="cat"
        width="40" height="40" class="rounded-circle"> -->

    <!-- Bootstrap JS, Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>