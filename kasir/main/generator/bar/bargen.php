<style>
#barcode_div input[type="text"]
{ 
 height:35px;
 padding-left:10px;
 font-size:17px;
}
#barcode_div input[type="submit"]
{ 
 border:none;
 height:35px; 
}
</style>

<div id="barcode_div">
 <form method="post" action="">
  <div class="form-group">
   <label class="control-label">Masukkan angka dan huruf untuk kode yang di inginkan</label>
     <div class="input-group">         
      <input type="text" name="barcode_text" class="form-control">
       <span class="input-group-btn">
         <button type="submit" name="generate_barcode" class="btn btn-default">GENERATE BAR</button>
       </span>
     </div>
    </div>
 </form>

<?php
if(isset($_POST['generate_barcode'])){
 $text=$_POST['barcode_text'];
 echo "
 <div id='cetak_ini' class='content'>   
 <table class='table' style='width:280px;'>
   <tr>
      <td><img alt='testing' src='generator/bar/barcode.php?codetype=Code39&size=40&text=".$text."&print=true'/></td>
   </tr>
 </table> 
   <div class='cetak-box jangan_cetak'>
      <button id='cetak' class='btn bg-warning btn-lg'><i class='fa fa-print' aria-hidden='true'></i>
</button>
   </div>
 </div>
 ";
}
?>
</div>
<script src="../jquery.min.js"></script>
        <script>
//            membuat fungsi cetak
            $('#cetak').click(function () {
                printDiv('cetak_ini');
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