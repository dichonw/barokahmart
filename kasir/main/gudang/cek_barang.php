<!--link href="../script/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../script/css/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
<link href="../script/css/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css"-->

<?php
if (isset($_GET['kd_barang']) && ($_GET['stok'])) {
    $kd_barang = $_GET['kd_barang'];
    $stok = $_GET['stok'];
    $query_barang_update = "SELECT * FROM tabel_stok_toko WHERE kd_barang='" . $kd_barang . "' AND stok='" . $stok . "' ";
    $barang_update = mysqli_query($koneksi, $query_barang_update);
    $data_barang_update = mysqli_fetch_array($barang_update);
    $id_update = $data_barang_update['id'];
    $toko_update = $data_barang_update['kd_toko'];
    $kd_update = $data_barang_update['kd_barang'];
    $stok_update = $data_barang_update['stok'];
}
?>
<script language="javascript">
    function createRequestObject() {
        var ajax;
        if (navigator.appName == 'Microsoft Internet Explorer') {
            ajax = new ActiveXObject('Msxml2.XMLHTTP');
        } else {
            ajax = new XMLHttpRequest();
        }
        return ajax;
    }

    var http = createRequestObject();

    function sendRequest(kd_barang) {
        if (kd_barang == "") {
            alert("Anda belum memilih kode barang !");
        } else {
            http.open('GET', 'ajax.php?kd_barang=' + encodeURIComponent(kd_barang), true);
            http.onreadystatechange = handleResponse;
            http.send(null);
        }
    }

    function handleResponse() {
        if (http.readyState == 4) {
            var string = http.responseText.split('&&&');
            document.getElementById('nm_barang').value = string[0];
            document.getElementById('warna').value = string[1];
            document.getElementById('ukuran').value = string[2];
            document.getElementById('harga').value = string[3];
            document.getElementById('jumlah').value = "";
            document.getElementById('sub_total').value = "";
            //document.getElementById('harga').focus();
            document.getElementById('jumlah').focus();
        }
    }

    function kalkulator() {
        var jml = document.getElementById('jumlah').value;
        var hrg = document.getElementById('harga').value;
        var hasil = hrg * jml;
        document.getElementById('sub_total').value = hasil;
    }
</script>

<div class="panel-body panel-warning">
    <div class="col-sm-12 filterable">
        <div class="col-sm-3">
            <span class="btn btn-default btn-filter btn-block"><span class="fa fa-search"></span> CARI BARANG</span>
            <h4 class="btn btn-default"><i class="fa fa-truck"></i> TAMBAH STOK BARU</h4>
            <hr />
            <?php
            $sql = "SELECT * FROM tabel_kategori_barang ORDER BY nm_kategori ASC";
            $result = mysqli_query($koneksi, $sql);
            $sql_barang = "SELECT * FROM tabel_barang ORDER BY nm_barang ASC";
            $result_barang = mysqli_query($koneksi, $sql_barang);
            ?>
            <form action="insert-stok.php" method="post">

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
                        <select id="combo_kategori_barang" class="form-control">
                            <option value="">PILIH KATEGORI </option>
                            <?php while ($a = mysqli_fetch_assoc($result)) { ?>
                                <option value="<?php echo $a['kd_kategori']; ?>"><?php echo $a['nm_kategori']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
                        <select name="kd_barang" id="combo_barang" onchange="new sendRequest(this.value)" class="form-control">
                            <option value="">PILIH BARANG </option>
                            <?php
                            while ($b = mysqli_fetch_assoc($result_barang)) {
                                echo '<option class="dt ' . $b['kd_kategori'] . '" value="' . $b['kd_barang'] . '">' . $b['nm_barang'] . '&raquo;' . $b['warna'] . '&raquo;' . $b['ukuran'] . '</option>';
                            }
                            ?>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
                        <input type="text" id="nm_barang" class="form-control" readonly="readonly" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
                        <input type="text" id="warna" readonly="readonly" class="form-control" placeholder="warna" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
                        <input type="text" id="ukuran" readonly="readonly" class="form-control" placeholder="ukuran" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                        <select name="kd_toko" class="form-control">
                            <?php
                            $a = mysqli_query($koneksi, "SELECT * FROM tabel_toko");
                            while ($d = mysqli_fetch_array($a)) {
                            ?>
                                <option value="<?php echo $d['kd_toko'] ?>"><?php echo $d['nm_toko'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                        <input name="stok" type="text" class="form-control" placeholder="stok" />
                    </div>
                </div>

                <input type="submit" name="button_selesai" id="button_selesai" value="TAMBAH STOK" class="btn btn-default" />
            </form>


        </div>
        <div class="col-sm-6">
            <div class="table-responsive">
                <table class="table tabel-bordered">
                    <thead>
                        <tr class="filters">
                            <th>NO</th>
                            <th><input type="text" class="form-control" placeholder="TOKO" disabled></th>
                            <th><input type="text" class="form-control" placeholder="BARANG" disabled></th>
                            <th><input type="text" class="form-control" placeholder="STOK" disabled></th>
                            <th>EDIT</th>
                        </tr>
                    </thead>
                    <?php
                    include('../inc/koneksi.php');
                    $no = 0;
                    $a = mysqli_query($koneksi, "SELECT * FROM tabel_stok_toko ORDER BY tabel_stok_toko.id ASC");
                    while ($d = mysqli_fetch_array($a)) {
                        $no++
                    ?>


                        <tbody>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php $b = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_toko WHERE tabel_toko.kd_toko = '$d[kd_toko]'")); ?><?php echo $b['nm_toko'] ?></td>
                                <td><?php $c = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_barang WHERE tabel_barang.kd_barang = '$d[kd_barang]'")); ?><?php echo $c['nm_barang'] ?><br /><small><?php echo $c['warna'] ?> &raquo;<?php echo $c['ukuran'] ?></small></td>
                                <td><?php echo $d['stok'] ?></td>
                                <td>
                                    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?menu=stok&kd_barang=<?php echo $d['kd_barang']; ?>&stok=<?php echo $d['stok']; ?>&do=update" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                                    <a href="delete_stok.php?id=<?php echo $d['id']; ?>" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr><?php } ?>
                        </tbody>
                </table>
            </div>
        </div>


        <div class="col-sm-3">
            <h4 class="btn btn-default"><i class="fa fa-truck"></i> EDIT STOK</h4>
            <hr />
            <form action="update-stok.php" method="post">

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
                        <input name="id" type="text" id="id" class="form-control" value="<?php echo $id_update; ?>" readonly="readonly" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
                        <input name="toko_update" type="text" id="toko_update" class="form-control" value="<?php echo $toko_update; ?>" readonly="readonly" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
                        <input type="kd_update" name="kd_toko" id="kd_update" value="<?php echo $kd_update; ?>" class="form-control" readonly="readonly" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
                        <input name="stok_update" id="stok_update" type="text" class="form-control" value="<?php echo $stok_update; ?>" />
                    </div>
                </div>

                <input type="submit" name="button_edit" id="button_edit" value="EDIT STOK" class="btn btn-default" />
            </form>

        </div>
    </div>
</div>




<!----------FILTER TABEL-------------------------------------------->
<script>
    /*
Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
*/
    $(document).ready(function() {
        $('.filterable .btn-filter').click(function() {
            var $panel = $(this).parents('.filterable'),
                $filters = $panel.find('.filters input'),
                $tbody = $panel.find('.table tbody');
            if ($filters.prop('disabled') == true) {
                $filters.prop('disabled', false);
                $filters.first().focus();
            } else {
                $filters.val('').prop('disabled', true);
                $tbody.find('.no-result').remove();
                $tbody.find('tr').show();
            }
        });

        $('.filterable .filters input').keyup(function(e) {
            /* Ignore tab key */
            var code = e.keyCode || e.which;
            if (code == '9') return;
            /* Useful DOM data and selectors */
            var $input = $(this),
                inputContent = $input.val().toLowerCase(),
                $panel = $input.parents('.filterable'),
                column = $panel.find('.filters th').index($input.parents('th')),
                $table = $panel.find('.table'),
                $rows = $table.find('tbody tr');
            /* Dirtiest filter function ever ;) */
            var $filteredRows = $rows.filter(function() {
                var value = $(this).find('td').eq(column).text().toLowerCase();
                return value.indexOf(inputContent) === -1;
            });
            /* Clean previous no-result if exist */
            $table.find('tbody .no-result').remove();
            /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
            $rows.show();
            $filteredRows.hide();
            /* Prepend no-result row if all rows are filtered */
            if ($filteredRows.length === $rows.length) {
                $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No result found</td></tr>'));
            }
        });
    });
</script>
<!-- js untuk jquery -->
<script src="../script/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var combo_barang = $("#combo_barang");

        temp = combo_barang.children(".dt").clone();
        $("#combo_kategori_barang").change(function() {
            var value = $(this).val();
            combo_barang.children(".dt").remove();
            if (value !== '') {
                temp.clone().filter("." + value).appendTo(combo_barang);
            } else {
                temp.clone().appendTo(combo_barang);
            }
        });
    });
</script>