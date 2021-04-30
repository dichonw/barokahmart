<div class="container">

<!-- <div class="row"> -->
<div class="card card-signin flex-row my-5">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <div class="card mt100 tab-card">
          <div class="card-header tab-card-header" style="height: 70px;">
            <h1>Pickup Jelanta</h1>
          </div>

          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
              <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb30">
                  <form method="post" action="?menu=setor_pujelantah">

                    <div class="row">
                        <input type="hidden" name="kd_barang" class="form-control" value="PUJ001" required>
                        <input name="id_member" type="hidden" value="<?php echo $kd_member; ?>" readonly class="form-control" />
                      <div class="col-sm-6">
                        <label>Alamat Pengambilan</label>  
                        <input name="alamat" class="form-control" placeholder="Alamat Pengambilan"required>
                      </div>

                      <div class="col-sm-6" style="margin-bottom: 5px;">
                        <label>Jumlah Minyak (Liter)</label>  
                        <input type="number" name="jml" class="form-control" placeholder="Jumlah Minyak (Liter)"required>
                      </div>

                      <div class="col-sm-6" style="margin-bottom: 5px;">
                        <label>No. HP</label>  
                        <input type="number" name="no_hp" class="form-control" placeholder="No. HP"required>
                      </div>

                      <div class="col-sm-6" style="margin-bottom: 10px; margin-top:32px;">
                        <button type="submit" name="add_to_cart" class="btn btn-success btn-block">Setor</button>
                      </div>
                    </div>
                    <?php

                    echo '<input type="hidden" class="form-control" name="no_nota" value="' . $no_faktur . '" />';
                    ?>

                  </form>
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
