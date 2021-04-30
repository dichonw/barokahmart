<?php
if(isset($_POST) && !empty($_POST)) {
include('phpqrcode/qrlib.php');
$codesDir = "codes/";
$codeFile = $_POST['formData'].'.png';
$formData = $_POST['formData'];
QRcode::png($formData, $codesDir.$codeFile, $_POST['ecc'], $_POST['size']);
echo "
<div id='cetak_yang_ini' class='content'>   
   <table class='table' style='width:280px;'>
	   <tr>
		  <td><img class='img-thumbnail' src='generator/qr/".$codesDir.$codeFile."' /></td>
	   </tr>
   </table>
   <div class='cetak-box jangan_cetak'>
      <button id='cetakan' class='btn btn-warning btn-lg'><i class='fa fa-print'></i></button>
   </div>	  
</div>
";
} else {
header('location:./');
}
?>
<script src="../jquery.min.js"></script>
        <script>
//            membuat fungsi cetak
            $('#cetakan').click(function () {
                printDiv('cetak_yang_ini');
            });
//            membuat fungsi print untuk div tertentu
//            fungsi ini akan membuat jendela baru
//            dan menuliskan kembali html ke dalamnya
            function printDiv(divId) {
                var config = {base: "http://localhost/harviacode2/print/"};
                var divToPrint = document.getElementById(divId);
                newWin = window.open("", "", "width=800, height=500, scrollbars=yes");
                newWin.document.write('<!doctype html><html><head>');
                newWin.document.write('<link rel="stylesheet" href="' + config.base + 'style.css" />');
                newWin.document.write('<style> .jangan_cetak {display:none}</style>');
                newWin.document.write('</head><body>');
                newWin.document.write('<div class="content">');
                newWin.document.write(divToPrint.innerHTML);
                newWin.document.write('</div>');
                newWin.document.write('</body>');
                newWin.document.write('</html>');
                newWin.document.close();
                newWin.focus();
                newWin.print();
                newWin.close();
            }
        </script>