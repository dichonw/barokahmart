<div class="container">

<!-- <div class="row"> -->
<div class="card card-signin flex-row my-5">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <div class="card mt100 tab-card">
          <div class="card-header tab-card-header" style="height: 70px;">
            <h1>Tagihan</h1>
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
                        <select id="kd_barang" class="form-control" name="kd_barang">

                        </select>
                      </div>
                    </div>

                    <div class="row py3">

                      <div class="col-sm-4" style="margin-bottom: 10px;margin-top: 2%;">
                        <input name="no_hp" class="form-control" placeholder="Nomor" required>
                      </div>

                      <div class="col-sm-4" style="margin-bottom: 10px;margin-top: 2%;">
                        <input name="alamat" class="form-control" placeholder="Alamat"required>
                      </div>

                      <div class="col-sm-4 " style="margin-bottom: 10px;margin-top: 2%;">
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
                      $("#kategoriBaru").append('<option value="">Pilih Kategori Pembelian</option>');
                      $("#jenisBaru").html('');
                      $("#kd_barang").html('');
                      $("#jenisBaru").append('<option value="">Pilih</option>');
                      $("#kd_barang").append('<option value="">Pilih</option>');
                      var url = 'master/get_kategori_baru.php';
                      $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(result) {
                          console.log(result);
                          for (var i = 0; i < result.length; i++) {
                            $("#kategoriBaru").append('<option value="' + result[i].id_kategori_baru + '">' + result[i].nama_kategori_baru + '</option>')
                          };
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                          console.log(jqXHR.responseText);
                        }
                      });
                    });
                    $("#kategoriBaru").change(function() {
                      var id_kat = $("#kategoriBaru").val();
                      var url = 'master/get_jenis_baru.php?id_kategori=' + id_kat;
                      $("#jenisBaru").html('');
                      $("#kd_barang").html('');
                      $("#jenisBaru").append('<option value="">Pilih</option>');
                      $("#kd_barang").append('<option value="">Pilih</option>');
                      $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(result) {
                          console.log(result);
                          for (var i = 0; i < result.length; i++)
                            $("#jenisBaru").append('<option value="' + result[i].id_jenis_baru + '">' + result[i].nama_jenis_baru + '</option>');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                          console.log(jqXHR.responseText);
                        }
                      });
                    });
                    $("#jenisBaru").change(function() {
                      var id_jen = $("#jenisBaru").val();
                      var url = 'master/get_barang_baru.php?id_jenis=' + id_jen;
                      $("#kd_barang").html('');
                      $("#kd_barang").append('<option value="">Pilih</option>');
                      $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(result) {
                          console.log(result);
                          for (var i = 0; i < result.length; i++)
                            $("#kd_barang").append('<option value="' + result[i].kd_barang + '">' + result[i].nm_barang + '</option>');
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
