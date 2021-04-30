<div class="container">

<!-- <div class="row"> -->
<div class="card card-signin flex-row my-5">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <div class="card mt100 tab-card">
          <div class="card-header tab-card-header" style="height: 70px;">
            <h1>Kurir</h1>
          </div>

          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
              <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb30">
                  <form method="post" action="?menu=transaksi">
                    <div class="row">
                      <div class="col-sm-4">

                        <select id="kategoriBaru" class="form-control" name="kategoriBaru">

                        </select>
                      </div>

                      <div class="col-sm-4">

                        <select id="jenisBaru" class="form-control" name="jenisBaru">

                        </select>
                      </div>

                      <div class="col-sm-4">
                        <select id="kd_barang" class="form-control" name="kd_barang" readonly>

                        </select>
                      </div>
                    </div>

                    <div class="row py3">

                      <div class="col-sm-6" style="margin-top: 2%;">
                        <input name="alamat" class="form-control" placeholder="Alamat Awal"required>
                      </div>

                      <div class="col-sm-6" style="margin-bottom: 5px;margin-top: 2%;">
                        <input name="alamat_akhir" class="form-control" placeholder="Alamat Akhir"required>
                      </div>

                      <div class="col-sm-8" style="margin-top: 1.5%; " >
                        <input name="no_hp" class="form-control" placeholder="Nomor" required >
                      </div>

                      <div class="col-sm-4" style="margin-bottom: 10px;margin-top: 1.5%;">
                        <button type="submit" name="add_to_cart" class="btn btn-success btn-block">Beli</button>
                      </div>
                    </div>
                    <?php

                    echo '<input type="hidden" class="form-control" name="no_nota" value="' . $no_faktur . '" />';
                    ?>

                  </form>
                  <script type="text/javascript">
                    $(document).ready(function() {
                      // alert("test")
                      $("#kategoriBaru").append('<option value="">Pilih Titik Awal</option>');
                      $("#jenisBaru").html('');
                      $("#kd_barang").html('');
                      $("#jenisBaru").append('<option value="">Pilih Titik Akhir</option>');
                      $("#kd_barang").append('<option value="">Harga</option>');
                      var url = 'master/get_titik_awal.php';
                      $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(result) {
                          console.log(result);
                          for (var i = 0; i < result.length; i++) {
                            $("#kategoriBaru").append('<option value="' + result[i].titik_awal + '">' + result[i].titik_awal + '</option>')
                          };
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                          console.log(jqXHR.responseText);
                        }
                      });
                    });
                    $("#kategoriBaru").change(function() {
                      var titik_awal = $("#kategoriBaru").val();
                      var url = 'master/get_titik_akhir.php?titik_awal=' + titik_awal;
                      $("#jenisBaru").html('');
                      $("#kd_barang").html('');
                      $("#jenisBaru").append('<option value="">Pilih Titik Akhir</option>');
                      $("#kd_barang").append('<option value="">Harga</option>');
                      $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(result) {
                          console.log(result);
                          for (var i = 0; i < result.length; i++)
                            $("#jenisBaru").append('<option value="' + result[i].id_kurir + '">' + result[i].titik_akhir + '</option>');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                          console.log(jqXHR.responseText);
                        }
                      });
                    });
                    $("#jenisBaru").change(function() {
                      var kd_barang = $("#jenisBaru").val();
                      var url = 'master/get_harga_kurir.php?id_kurir=' + kd_barang;
                      $("#kd_barang").html('');
                      $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(result) {
                          console.log(result);
                          for (var i = 0; i < result.length; i++)
                            $("#kd_barang").append('<option value="' + result[i].id_kurir  + '">' + "Rp." + result[i].harga + '</option>');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                          console.log(jqXHR.responseText);
                        }
                      });
                    });
                  </script>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- </div> -->
</div>
