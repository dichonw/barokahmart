<link href="../script/style.css" rel="stylesheet" type="text/css">
<link href="../../keranjang/main/script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../keranjang/main/script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">
<?php
$hp_user = substr("$_SESSION[hp]", 7);
$date = date('ymd');
$query = mysqli_query($koneksi, "SELECT MAX(no_faktur_penjualan) as maxid FROM tabel_penjualan WHERE no_faktur_penjualan LIKE '" . $hp_user . "%'");
$result = mysqli_fetch_array($query);
$maxid = $result['maxid'];
$no_urut = substr($maxid, -5);
$new_urut = $no_urut + 1;
$no_faktur = $hp_user . $date . sprintf("%05s", $new_urut);
?>

<?php
$query_rinci_jual = "SELECT * FROM tabel_rinci_penjualan WHERE no_faktur_penjualan='" . $no_faktur . "' AND kd_barang != 'PUJ001'";
$get_hitung_rinci = mysqli_query($koneksi, $query_rinci_jual);
$hitung = mysqli_num_rows($get_hitung_rinci);
$total_jual = 0;
$total_uang = 0;
$total_item = 0;
while ($hitung_total = mysqli_fetch_array($get_hitung_rinci)) {
    $jml    = $hitung_total['jumlah'];
    //$sub_total=$hitung_total['sub_total_jual'];
    //$total_jual=$sub_total+$total_jual;
    //$ppn=$total_jual*10/100;
    //$total_bayar=$total_jual+$ppn;
    //$total_item=$jml+$total_item;
}
?>

<div class="container mt-5 pt-5">

    <!------------///////////////////////TABEL TRANSAKSI///////////////////////////////--------------->
    <div class="row">
        <div class="col-lg-8">

            <!--a href="?menu=home" class="btn btn-primary"><i class="fa fa-calculator"></i> PENJUALAN TUNAI</a>
    <a href="?menu=grosir" class="btn btn-danger"><i class="fas fa-box-open"></i> GROSIR</a-->
            <a href="?menu=home" class="btn btn-primary" style="margin: 5;"><i class="fas fa-shopping-basket"></i> BELANJA LAGI</a>

            <div class="table-responsive">
                <table class="table" style="font-size:11px">
                    <thead>
                        <tr>
                            <!--td>Kode</td-->
                            <td>Barang</td>
                            <td>Harga</td>
                            <td>Jumlah</td>
                            <td>Sub Total</td>
                            <td>Hapus</td>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $rinci_jual = mysqli_query($koneksi, $query_rinci_jual);
                        while ($data_rinci = mysqli_fetch_array($rinci_jual)) {
                            $kd_barang        = $data_rinci['kd_barang'];
                            $nm_barang        = $data_rinci['nm_barang'];
                            $jml            = $data_rinci['jumlah'];
                            $hrg            = $data_rinci['harga'];
                            $discount        = $data_rinci['diskon'];
                            $sub_total        = $jml * $hrg;
                            //$sub_total=$data_rinci['sub_total_jual'];  
                            $total_jual    = $sub_total + $total_jual;
                            $ppn        = $total_jual * 0 / 100;
                            $diskon        = $discount != null ? ($total_jual * $discount) / 100 : 0;
                            $total_bayar = $total_jual - $diskon;
                            $total_uang    = $total_bayar + $ppn;
                            $total_item    = $jml + $total_item;
                        ?>
                            <tr>
                                <!--td><?php echo $kd_barang; ?></td-->
                                <td><?php echo $nm_barang; ?></td>
                                <?php $b = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_barang WHERE tabel_barang.kd_barang = '$kd_barang'")); ?>
                                <td><?php echo $b['hrg_jual']; ?></td>
                                <td>
                                    <form method="post" action="?menu=transaksi">
                                        <input type="hidden" name="no_faktur" class="form-control" value="<?php echo $no_faktur; ?>">
                                        <input type="hidden" name="kd_brg" class="form-control" value="<?php echo $kd_barang; ?>">
                                        <input type="hidden" name="hrg" class="form-control" value="<?php echo $b['hrg_jual']; ?>">

                                        <?php $b = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_barang WHERE tabel_barang.kd_barang = '$kd_barang'")); ?>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <?php
                                                if (empty($data_rinci['no_hp'])) {
                                                ?>
                                                    <input type="number" class="form-control qty" name="jml" value="<?php echo $jml; ?>" aria-label="Input group example" aria-describedby="btnGroupAddon">

                                                    <button class="btn btn-sm" id="btnGroupAddon">OK</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="number" class="form-control qty" name="no_hp" value="<?php echo $data_rinci['no_hp']; ?>" aria-label="Input group example" aria-describedby="btnGroupAddon" disabled>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
            </div>

            <!--div class="row">
        <div class="col-sm-12 mx-auto">
            <div class="input-group">
                <span class="input-group-prepend">
                    <button type="submit" class="btn btn-outline-secondary btn-number" disabled="disabled" data-type="minus" data-field="jml[1]">
                        <span class="fa fa-minus"></span>
                    </button>
                </span>
                <input type="text" name="jml[1]" class="form-control input-number" value="<?php echo $jml; ?>" min="1" max="10">
                <span class="input-group-append">
                    <button type="submit" class="btn btn-outline-secondary btn-number" data-type="plus" data-field="jml[1]">
                        <span class="fa fa-plus"></span>
                    </button>
                </span>
            </div>
        </div>
    </div-->

            <!--div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <input type="text" name="jml" value="<?php echo $jml; ?>" class="form-control" autofocus>
                      </div>
                       <button type="submit" name="update" class="btn btn-sm btn-primary input-group-text">
                      	<i class="fas fa-pencil-alt"></i></button>
                    </div-->
            </form>
            </td>
            <td><?php echo $sub_total; ?></td>
            <td>
                <a href="keranjang/delete_penjualan.php?no_faktur_penjualan=<?php echo $no_faktur; ?>&kd_barang=<?php echo $kd_barang; ?>" class="btn btn-primary btn-sm"><i class="fa fa-trash"></i></a>

            </td>
            </tr>
        <?php } ?>



        <tr>
            <td></td>
            <td>Total Barang</td>
            <td><?php echo $total_item; ?></td>
            <td>Total Harga</td>
            <td>Rp.<?php echo number_format($total_jual, 0, ".", "."); ?></td>
        </tr>
        <tr>
            <td>Total Bayar</td>
            <td></td>
            <td></td>
            <td></td>
            <td>Rp.<?php echo number_format($total_uang, 0, ".", "."); ?></td>
        </tr>
        </tbody>
        </table>
        <!------    
    <form id="form_kalkulator" name="form_kalkulator" method="post" action="<?php $_SERVER['PHP_SELF'];  ?>">
             
        <div class="form-group">
        	<label for="validate-text">Cash</label>
			<div class="input-group">
				<input name="cash_jual" type="text" id="cash_jual"  class="form-control" placeholder="Masukkan Jumlah Uang" autofocus />
				<span class="input-group-append">
                <input type="submit" name="button" id="button" value="Hitung"  class="btn btn-primary"/></span>
			</div>
		</div>
        
      </form> 
      
      <h4 class="btn btn-primary"><i class="fa fa-calculator"></i> NOTA</h4>
      <form id="form_penjualan" name="form_penjualan" method="post" action="?menu=simpantr">       
        <input name="no_faktur" type="text" id="no_faktur" value="<?php echo $no_faktur; ?>" readonly class="form-control" />
        
        <label>TOTAL BELANJA</label> 
        <input name="total_belanja" type="text" id="total_belanja" value="<?php echo $total_uang; ?>" readonly class="form-control" />
        <input name="cash_jualnya" type="hidden" id="cash_jualnya" value="<?php echo $cash_jual; ?>" readonly class="form-control" />
        <br />
     
     <input type="submit" name="button_selesai" id="button_selesai" value="SIMPAN" class="btn btn-primary" />     
     
      </form>
      ------->
        </div>
    </div>

    <div class="col-lg-4">
        <h4 class="text-uppercase">Lengkapi pesanan anda</h4>
        <hr />
        <div class="panel-body">
            <form id="form_penjualan" name="form_penjualan" method="post" action="?menu=simpantr">
                <input name="total_belanja" type="hidden" id="total_belanja" value="<?php echo $total_uang; ?>" readonly class="form-control" />
                <input name="id_member" type="hidden" value="<?php echo $kd_member; ?>" readonly class="form-control" />
                <div class="form-group">
                    <label class="text-capitalize">Ini adalah nomer nota pesanan anda</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                        </div>
                        <input type="text" class="form-control" name="no_nota" value="<?php echo $no_faktur; ?>" readonly />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-capitalize">Nama anda</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                        </div>
                        <input type="text" name="cust" class="form-control" value="<?php echo $nm_member; ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-capitalize">Nomer anda</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                        </div>
                        <input type="text" name="hp_cust" class="form-control" value="<?php echo $hp_member; ?>" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="text-capitalize">Tuliskan alamat pengiriman</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                        </div>
                        <textarea name="status" class="form-control"><?php echo $almt_member; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-capitalize">Sistem pembayaran anda</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                        </div>
                        <select class="form-control" name="ket">
                            <option>Bayar Ditempat</option>
                            <option>Transfer bank</option>
                        </select>
                    </div>
                </div>

                <button type="submit" name="simpan" class="btn btn-primary pull-left"><i class="fas fa-paper-plane"></i> KIRIM PESANAN</button>
            </form>
        </div>
    </div>
</div>
</div>

<!------------///////////////////////TABEL TRANSAKSI///////////////////////////////--------------->




<!--------------------================================MODAL DISKON=========================--------------->
<div class="modal fade" id="ngediskon_jual" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kasih Diskon</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="hasil-data"></div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!--------------------================================MODAL DISKON=========================--------------->



</div>

<script type="text/javascript">
    var mywin;

    function popup() {
        mywin = window.open("keranjang/faktur_penjualan.php?no_faktur=<?php echo $no_faktur; ?>&cash_jual=<?php echo $cash_jual; ?>", "_blank", "toolbar=yes,location=yes,menubar=yes,copyhistory=yes,directories=no,status=no,resizable=no,width=500, height=400");
        mywin.moveTo(100, 100);
    }
</script>
<script>
    $('.btn-number').click(function(e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function() {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }
    });

    $(".input-number").keydown(function(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>
<!--script>
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
});

$(".input-number").keydown(function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
         // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) || 
         // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
             // let it happen, don't do anything
             return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});
</script-->