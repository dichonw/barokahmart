<!--?php
$kd_toko=$_SESSION['kd_toko'];
$date=date('ymd');
$query=mysql_query("SELECT MAX(no_faktur_penjualan) as maxid FROM tabel_penjualan WHERE no_faktur_penjualan LIKE '".$kd_toko."%'");
$result=mysql_fetch_array($query);
$maxid=$result['maxid'];
$no_urut=substr($maxid,-5);
$new_urut=$no_urut+1;
$no_faktur=$kd_toko.$date.sprintf("%05s",$new_urut);
?-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="../script/autocomplete/jquery-ui.min.css" rel="stylesheet" />

</head>

<body>

  <div class="panel-body panel-warning">

    <div class="col-sm-12">
      <!----------FORM--------->
      <div class="form-group">
        <div class="input-group">
          <input type="text" id="cari_nota" autocomplete="off" placeholder="Cari Nota" class="form-control">
          <span class="input-group-addon"><i class="fa fa-search"></i></span>
        </div>
      </div>

      <h3 class="box-header"><i class="fa fa-id-card"></i> Pembayaran Angsuran</h3>
      <div class="col-sm-6">
        <form action="angsuran-bayar.php" method="post" id="form_pembelian">

          <input name="faktur" type="hidden" id="faktur" readonly="readonly" class="form-control" />
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">ID Member &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <input name="kd_supplier" type="text" id="kd_supplier" readonly="readonly" class="form-control" placeholder="Nama Pelanggan" />
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">Tanggal Beli &nbsp;&nbsp;</span>
              <input name="tgl_penjualan" type="text" id="tgl_penjualan" readonly="readonly" class="form-control" placeholder="Tanggal Pembelian" />
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">ID Kasir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <input name="id_user" type="text" id="id_user" readonly="readonly" class="form-control" placeholder="ID Kasir" />
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">Total Hutang</span>
              <input name="total_penjualan" type="text" id="total_penjualan" readonly="readonly" class="form-control" placeholder="Total Pembelian" />
            </div>
          </div>

      </div>
      <div class="col-sm-6">

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Sudah Bayar &nbsp;&nbsp;</span>
            <input name="dp" type="text" id="dp" class="form-control" placeholder="Titip uang" />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Tunggakan &nbsp;&nbsp;&nbsp;</span>
            <input name="sisa" type="text" id="sisa" class="form-control" placeholder="Sisa" />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Bayar &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <!--input name="jml" type="text" id="jml" onkeyup="kalkulator()" class="form-control" placeholder="Bayar" /-->
            <input name="jml" type="text" id="jml" class="form-control" placeholder="Bayar" />
          </div>
        </div>



        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <select name="status" class="form-control">
              <option>Angsuran</option>
              <option>LUNAS</option>
            </select>
          </div>
        </div>

      </div>




      <input type="submit" name="bayar" id="bayar" value="Bayar Angsuran" class="btn btn-default pull-right" />
      <hr /><br />


      </form>


    </div>
    <!--------------------FORM TRANSAKSI---------------->

  </div>
  </div>

  <!--script>
$(".js-example-tags").select2({
  tags: true
});
</script-->
  <script src="../script/autocomplete/jquery.js"></script>
  <script src="../script/autocomplete/jquery-ui.min.js"></script>
  <script>
    /* autocomplete */
    $('#cari_nota').autocomplete({
      delay: 0,
      source: function(request, response) {

        $.ajax({
          url: 'angsurancari.php',
          dataType: "json",
          data: 'cari=' + request.term,
          success: function(data) {

            response($.map(data, function(item) {
              return {
                label: item.no_faktur_penjualan,
                kd_supplier: item.kd_supplier,
                tgl_penjualan: item.tgl_penjualan,
                id_user: item.id_user,
                total_penjualan: item.total_penjualan,
                dp: item.dp,
                sisa: item.sisa

              }
            }));
          },
          error: function(e) {
            alert('Error: ' + request);
          }
        });
      },
      minLength: 1,
      select: function(event, ui) {
        /* ketika nama yang dicari diklik, maka ditampilkan di form */
        $('#faktur').val(ui.item.label);
        $('#kd_supplier').val(ui.item.kd_supplier);
        $('#tgl_penjualan').val(ui.item.tgl_penjualan);
        $('#id_user').val(ui.item.id_user);
        $('#total_penjualan').val(ui.item.total_penjualan);
        $('#dp').val(ui.item.dp);
        $('#sisa').val(ui.item.sisa);
        $('#jumlah').val("");
        $('#cari_nota').val("");
        return false;
      },
      focus: function(event, ui) {
        return false;
      }

    });

    /* @end autocomplete */
  </script>