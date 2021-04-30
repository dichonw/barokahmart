<?php
session_start();
// $batas = 10;
// $halaman = @$_GET['halaman'];
// if (empty($halaman)) {
//     $posisi = 0;
//     $halaman = 1;
// } else {
//     $posisi = ($halaman - 1) * $batas;
// }
// $no = 1 + $posisi;
?>
<link href="script/css/style.css" rel="stylesheet" type="text/css">
<link href="script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">

<div class="row">
    <div id="stok_barang" class="col-sm-12 col-12 filterable">
        <span class="btn btn-primary btn-filter float-right"><span class="fa fa-search"></span> Filter Pencarian</span>
        <!--button id="exporttable" class="btn btn-primary">Export</button-->
        <div class="panel-body panel-default">
            <div class="table-responsive">
                <table class="table table-bordered" id="databrg">
                    <thead>
                        <tr class="filters">
                            <th><input type="text" class="form-control font-weight-bold" placeholder="Kategori" disabled></th>
                            <th><input type="text" class="form-control font-weight-bold" placeholder="Kode" disabled></th>
                            <th><input type="text" class="form-control font-weight-bold" placeholder="Barang" disabled></th>
                            <th><input type="text" class="form-control font-weight-bold" placeholder="Stok" disabled></th>
                            <th>Foto</th>
                            <th>Toko</th>
                            <th>Beli</th>
                            <th>Jual</th>
                            <th>Grosir</th>
                            <th>Normal</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <?php $query = "SELECT * FROM tabel_barang WHERE kd_barang != '' ORDER BY kd_barang DESC ";
                    $result = mysqli_query($koneksi, $query);
                    while ($brg = mysqli_fetch_array($result)) {
                        $kd_kategori     = $brg['kd_kategori'];
                        $kd_barang        = $brg['kd_barang'];
                        $nm_barang        = $brg['nm_barang'];
                        $hrg_beli        = $brg['hrg_beli'];
                        $hrg_jual        = $brg['hrg_jual'];
                        $hrg_grosir        = $brg['hrg_grosir'];
                        $diskon            = (empty($brg['diskon']) ? '0' : $brg['diskon']);
                    ?>
                        <tbody>
                            <tr>
                                <?php $kategori = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_kategori_barang WHERE kd_kategori = '$kd_kategori'")); ?>
                                <td><?php echo $kategori['nm_kategori']; ?></td>
                                <td><?php echo $kd_barang; ?></td>
                                <td><?php echo $nm_barang; ?></td>
                                <?php $stok = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_stok_toko WHERE kd_barang = '$kd_barang'")); ?>
                                <td><span class="label label-important"><?php echo $stok['stok']; ?></span></td>
                                <?php $foto = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_barang_gambar WHERE id_brg = '$kd_barang'")); ?>
                                <td>
                                    <img class="d-block img-responsive img-thumbnail" src="master_data/images/<?php echo $foto['gambar']; ?>">
                                </td>
                                <?php $toko = mysqli_fetch_array(mysqli_query($koneksi, "SELECT s.kd_toko as kd_toko, t.nm_toko as nm_toko FROM tabel_stok_toko s INNER JOIN tabel_toko t ON s.kd_toko = t.kd_toko WHERE s.kd_barang = '$kd_barang'")); 
                                $kd_toko = $toko['kd_toko'];
                                $nm_toko = $toko['nm_toko'];?>
                                <td><span class="label label-important"><?php echo $nm_toko; ?></span></td>
                                <td>Rp.<?php echo number_format($hrg_beli, 2, ".", ","); ?></td>
                                <td>Rp.<?php echo number_format($hrg_jual, 2, ".", ","); ?></td>
                                <td>Rp.<?php echo number_format($hrg_grosir, 2, ".", ","); ?></td>
                                <td>Rp.<?php echo number_format($diskon, 2, ".", ","); ?></td>
                                <td>
                                <?php if ($kd_toko != $_SESSION['kd_toko']){?>
                                    <div class="btn-group btn-group-toggle">
                                        <a href="?menu=del_brg&kd_barang=<?php echo $kd_barang; ?>" class="btn btn-secondary btn-sm disabled"><i class="fas fa-trash-alt"></i></a>
                                        <?php echo "<a href='#ngedit_brg' data-toggle='modal' data-id=" . $kd_barang . " class='btn btn-secondary btn-sm disabled'><i class='far fa-edit'></i></a>"; ?>
                                        <?php echo "<a href='#ngediskon' data-toggle='modal' data-id=" . $kd_barang . " class='btn btn-secondary btn-sm disabled'><i class='fas fa-percentage'></i></a>"; ?>
                                        <!--?php echo "<a href='#ngeprint' data-toggle='modal' data-id=".$kd_barang." class='btn btn-warning btn-sm'><i class='fas fa-print'></i></a>"; ?-->
                                    </div>
                                <?php } else {
                                    ?><div class="btn-group btn-group-toggle">
                                        <a href="?menu=del_brg&kd_barang=<?php echo $kd_barang; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                        <?php echo "<a href='#ngedit_brg' data-toggle='modal' data-id=" . $kd_barang . " class='btn btn-primary btn-sm'><i class='far fa-edit'></i></a>"; ?>
                                        <?php echo "<a href='#ngediskon' data-toggle='modal' data-id=" . $kd_barang . " class='btn btn-warning btn-sm'><i class='fas fa-percentage'></i></a>"; ?>
                                        <!--?php echo "<a href='#ngeprint' data-toggle='modal' data-id=".$kd_barang." class='btn btn-warning btn-sm'><i class='fas fa-print'></i></a>"; ?-->
                                    </div>
                                <?php }
                                ?>   
                                </td>
                            <?php } ?>
                            </tr>
                        </tbody>

                        <tr>
                            <!-- <td colspan="10">
                                <div class="pagination pagination-centered"><?php include('navigasi_paging.php'); ?></div>
                            </td> -->
                        </tr>
                </table>
            </div>
        </div>
    </div>

</div>
    <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li> -->
  <!-- </ul>
</nav> -->
<?php
    // $query2 = "SELECT * FROM tabel_barang";
    // $paging2 = mysqli_query($koneksi,$query2);
    // $jumlahdata = mysqli_num_rows($paging2);
    // $jumlahhalaman = ceil($jumlahdata/$batas);
?>

<!-- <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-end"> -->
<?php
    // for ($i=1; $i <= $jumlahhalaman ; $i++) { 
    //     if ($i != $halaman) {
    //         echo "<li class='page-item'><a class='page-link' href=\"./?menu=stok&halaman=$i\"><span style='color: blue'>$i</span></a></li>";
    //     }else{
    //         echo "<li class='page-item'><a class='page-link' href=\"./?menu=stok&halaman=$i\"><span style='color: black'>$i</span></a></li>";
    //     }
    // }
?>
  <!-- </ul>
</nav> -->
<div class="modal fade" id="ngedit_brg" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Barang</h4>
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
<div class="modal fade" id="ngediskon" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Diskon Harga </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h5><?php echo $nm_toko; ?></h5>
                <div class="hasil-data"></div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ngeprint" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Print Data </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="printThis">
                <h5><?php echo $nm_toko; ?></h5>
                <div class="hasil-data"></div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">&times; Close</button>
                <button id="btnPrint" type="button" class="btn btn-warning"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>
    </div>
</div>
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
<!----------FILTER TABEL-------------------------------------------->
<!-- <script>
    $(function() {
        $("button").click(function() {
            $("#databrg").table2excel({
                filename: "Data Barang",
                name: "Hosting Packages",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude: ".dntinclude",
                exclude_inputs: true
            });
        });
    });
</script> -->