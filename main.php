<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kedai INDICA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        /* Warna coklat khusus */
        .bg-brown {
            background-color: #8B4513 !important;
            /* SaddleBrown */
        }

        /* Warna coklat khusus */
        .bg-brown {
            background-color: #8B4513 !important;
            /* warna header */
        }

        /* Styling khusus untuk nav-pills coklat */
        .nav-brown .nav-link {
            color: #ffffffff;
            /* teks coklat */
        }

        .nav-brown .nav-link.active {
            background-color: #8B4513;
            /* coklat tua */
            color: white;
        }

        .nav-brown .nav-link:hover {
            background-color: #A0522D;
            /* coklat muda */
            color: white;
        }
    </style>

    </style>
</head>

<body style="height: 3000px">
    <!-- Header -->
    <?php include "header.php"; ?>
    <!-- End Header -->
    <div class="container-lg mt-3">
        <div class="row">
            <!-- Sidebar -->
            <?php include "Sidebar.php"; ?>
            <!-- End Sidebar-->

            <!-- Content -->
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = "home"; // atau file default seperti dashboard.php
            }

            include($page . ".php");

            ?>
            <!-- End Content -->
        </div>

        <div class="fixed-bottom text-center mb-2">
            Copyright by Muhammad Rafly
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>