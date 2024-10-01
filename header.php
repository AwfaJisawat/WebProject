<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
        .navbar {
            margin-bottom: 20px;

            a {
                color: slateblue;
                margin-left: 20px;
                text-decoration: none;
            }

            .dropdown-menu a {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./loan_status.php">สถานะการจอง</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            สรุปผล
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="./summary.php?sumdate=0">รายวัน</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./summary.php?sumweek=0">รายสัปดาห์</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./summary.php?summonth=0">รายเดือน</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./summary.php?sumyear=0">รายปี</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./summary.php?sumcat=0">ตามประเภท</a>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>
</body>