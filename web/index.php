<?php

error_reporting(0);
include("../kasir/main/inc/koneksi.php");
session_start();
if (!isset($_SESSION['hp']) && !isset($_SESSION['password'])) {
    header("location:akses/login.php");
} else {
?>
<?php } ?>
<?php
if (isset($_SESSION['hp'])) {
    $query_info_member = mysqli_query($koneksi, "SELECT * FROM tabel_member WHERE hp='" . $_SESSION['hp'] . "'");
    $info_member = mysqli_fetch_array($query_info_member);
    $kd_member        = $info_member['id_user'];
    $nm_member        = $info_member['nm_user'];
    $almt_member    = $info_member['alamat_user'];
    $hp_member        = $info_member['hp'];
    $pass_member    = $info_member['pass_user'];
    $foto            = $info_member['foto'];
    $akses            = $info_member['akses'];
    $status            = $info_member['stt_user'];
    $header = true;
}
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8 user-scalable=no">
    <meta http-equiv="refresh" content="300">
    <link href="../kasir/main/script/css/boilerplate.css" rel="stylesheet" type="text/css">
    <link href="script/style.css" rel="stylesheet" type="text/css">
    <link href="../kasir/main/script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../kasir/main/script/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
    <link href="../kasir/main/script/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
    <link href="../kasir/main/script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">
    <link href="../kasir/main/script/css/font/css/all.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="script/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="script/owlcarousel/owl.theme.default.css">
    <!---------------SCROLLING----------------------->
    <link href="script/scrollingtabs/dist/jquery.scrolling-tabs.css" rel="stylesheet">

    <script src="../kasir/main/script/js/respond.min.js"></script>
    <script src="../kasir/main/script/js/jquery.min.3.2.1.js"></script>
    <script src="../kasir/main/script/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include 'inc/header.php' ?>


    <?php
    if (isset($_GET['menu'])) {
        $menu = $_GET['menu'];
        switch ($menu) {
            case ('home');
                include('master/home.php');
                break;
            case ('detail');
                include('master/detail.php');
                break;
            case ('akun');
                include('master/member.php');
                break;
            case ('cart');
                include('keranjang/penjualan.php');
                break;
            case ('transaksi');
                include('keranjang/beli-aksi.php');
                break;
            case ('simpantr');
                include('keranjang/update_stok.php');
                break;
            case ('search');
                include('master/cari.php');
                break;
            case ('record');
                include('master/data-beli.php');
                break;
            case ('tagihan');
                include('master/tagihan.php');
                break;
            case ('kurir');
                include('master/kurir.php');
                break;
            case ('pu_jelantah');
                include('master/pu_jelantah.php');
                break;
            case ('setor_pujelantah');
                include('keranjang/setor_pujelantah.php');
                break;
            case ('simpan_pujelantah');
                include('keranjang/simpan_pujelantah.php');
                break;
            default:
                include('master/home.php');
                break;
        }
    }else{
        include('master/home.php');
    }
    ?>

    <?php include 'inc/footer.php' ?>
    <script src="script/owlcarousel/popper.min.js"></script>
    <script type="text/javascript" src="script/owlcarousel/owl.carousel.js"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 0,
            dots: false,
            nav: true,
            autoplay: true,
            smartSpeed: 3000,
            autoplayTimeout: 7000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
    </script>
    <script>
        $('.feedback-toggle').click(function() {
            var left = parseFloat($('.feedback')[0].style.left.match(/[0-9]+/g)) || 50,
                tgl = '+=280';
            (left > 50) ? tgl = '-=280': tgl = '+=280';
            $('.feedback').animate({
                left: tgl
            }, 500);
        });
        $("#feedback-form .btn").click(function() {
            var url = "path/to/your/script.php",
                data = $("#feedback-form").serialize(),
                isValid = validate("#feedback-form");
            if (isValid) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function(data) {
                        $('.feedback').find('.alert-error').fadeIn('fast');
                        $('.feedback').animate({
                            left: '-=350'
                        }, 500);
                    },
                    error: function(data) {
                        $('.feedback').find('.alert-block').fadeIn('fast');
                        return false;
                    }
                });
            }
            return false;
        });
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imageResult')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(function() {
            $('#upload').on('change', function() {
                readURL(input);
            });
        });
        var input = document.getElementById('upload');
        var infoArea = document.getElementById('upload-label');

        input.addEventListener('change', showFileName);

        function showFileName(event) {
            var input = event.srcElement;
            var fileName = input.files[0].name;
            infoArea.textContent = 'File name: ' + fileName;
        }
    </script>
    <!-- <script src="script/scrollingtabs/dist/jquery.scrolling-tabs.js"></script>
    <script>
        $('.nav-tabs').scrollingTabs();
    </script>
    <script>
        window.onscroll = function() {
            myFunction()
        };
        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;

        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script> -->

</body>

</html>