<div class="col-sm-12 filterable">
    <!------TABEL---------->
    <div class="panel-body panel-default">
        <div id="pricelist" class="print-area">
            <button class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Export excel</button>
            <span class="btn btn-primary btn-filter pull-right"><span class="fa fa-search"></span> CARI BARANG</span>
            <table id="demo-export" class="table table-bordered" style="font-size:11px">
                <thead>
                    <tr class="filters">
                        <th>NO</th>
                        <th><input type="text" class="form-control" placeholder="BARANG" disabled></th>
                        <th><input type="text" class="form-control" placeholder="STOK" disabled></th>
                        <th>BARANG MASUK</th>
                        <th>BARANG KELUAR</th>
                        <th>BARANG RETUR BELI</th>
                        <th>BARANG RETUR JUAL</th>
                    </tr>
                </thead>
                <?php
                $no = 0;
                $a = mysqli_query($koneksi, "SELECT * FROM tabel_stok_toko ORDER BY tabel_stok_toko.id ASC");
                while ($d = mysqli_fetch_array($a)) {
                    $no++
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php $c = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_barang WHERE tabel_barang.kd_barang = '$d[kd_barang]'")); ?><?php echo $c['nm_barang'] ?></td>
                            <td><?php echo $d['stok'] ?></td>
                            <!-------------------------------BELI---------------------->
                            <td><?php $e = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_rinci_pembelian WHERE tabel_rinci_pembelian.kd_barang = '$d[kd_barang]'")); ?><?php echo $e['jumlah'] ?>
                            </td>
                            <!-------------------------------BELI---------------------->

                            <!-------------------------------JUAL---------------------->
                            <td><?php $f = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_rinci_penjualan WHERE tabel_rinci_penjualan.kd_barang = '$d[kd_barang]'")); ?><?php echo $f['jumlah'] ?>
                            </td>
                            <!-------------------------------JUAL---------------------->

                            <!-------------------------------RETUR JUAL---------------------->
                            <td><?php $e = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_rinci_retur WHERE tabel_rinci_retur.kd_barang = '$d[kd_barang]'")); ?><?php echo $e['jumlah'] ?>
                            </td>
                            <!-------------------------------RETUR JUAL---------------------->

                        </tr><?php } ?>
                    </tbody>

            </table>
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
<script>
    $(function() {
        $("button").click(function() {
            $("#demo-export").table2excel({
                filename: "sirkulasi barang",
                name: "Hosting Packages",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude: ".dntinclude",
                exclude_inputs: true
            });
        });
    });
</script>