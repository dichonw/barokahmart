<?php
$query_cek_tabel="SELECT * FROM tabel_member";
$cek_tabel=mysqli_query($koneksi, $query_cek_tabel);
$hitung_record=mysqli_num_rows($cek_tabel);
include('paging.php');
/*$query_user_paging="SELECT * FROM tabel_member LIMIT ".$start_record.", ".$max_data."";
$user_paging=mysqli_query($query_user_paging);*/
$query_user_paging="SELECT * FROM tabel_member";
$user_paging=mysqli_query($koneksi, $query_user_paging);
?>

<?php
if(isset($_GET['id_user'])){
$id_user=$_GET['id_user'];
$query_user_for_update="SELECT * FROM tabel_member WHERE id_user='".$id_user."'";
$user_for_update=mysqli_query($koneksi, $query_user_for_update);
$user_update=mysqli_fetch_array($user_for_update);
$id_update=$user_update['id_user'];
$nm_update=$user_update['nm_user'];
$akses_update=$user_update['stt_user'];}
?>

<!--?php echo $param; ?-->
<?php
if(isset($_GET['stt'])){
$stt=$_GET['stt'];
echo "query ".$stt."";}
?> 
<div class="row">
<div class="col-sm-9 filterable"><!------TABEL---------->
  <h4 class="btn btn-primary"><i class="fa fa-table"></i> DATA</h4><hr />
  <button id="exporttable" class="btn btn-primary"><i class="far fa-file-excel"></i> Export</button>
  <span class="btn btn-primary btn-filter"><span class="fa fa-search"></span> Filter Pencarian</span>	
    <div class="panel-body panel-default"> 
    	<div class="table-responsive">
            <table class="table table-bordered" id="anggota">    
              <thead>
              <tr class="filters">
                <th class="hidden-phone">Id User</th>
                <th><input type="text" class="form-control font-weight-bold" placeholder="Nama" disabled></th>
                <th>No.HP</th>
                <th>Alamat</th>
                <th>Password</th>
                <th>Status</th>
                <th>Aksi</th>
                </tr>
              </thead>  
            <?php
            if($tampil_data==true){
            while($data_user=mysqli_fetch_array($user_paging)){
            $id_user=$data_user['id_user'];
            $nm_user=$data_user['nm_user'];
			$almt_user=$data_user['alamat_user'];
			$hp_user=$data_user['hp'];
			$pass_user=$data_user['pass_user'];
            $akses=$data_user['stt_user'];
            ?>
              <tbody>
              <tr>
                <td class="hidden-phone"><?php echo $id_user; ?>&nbsp;</td>
                <td><?php echo $nm_user; ?>&nbsp;<br /><a href="https://wa.me/62<?php echo substr("$hp_user",1);?>?text=Akun%20sudah%20<?php echo $akses; ?>" target="_blank" class="btn btn-primary btn-lg btn-xs"><i class="fab fa-whatsapp-square"></i></a></td>
                <td><?php echo $hp_user; ?>&nbsp;</td>
                <td><?php echo $almt_user; ?>&nbsp;</td>
                <td><?php echo $pass_user; ?>&nbsp;</td>
                <td><span class="btn btn-primary"><?php echo $akses; ?>&nbsp;</span></td>
                <td><a href="<?php echo $_SERVER['PHP_SELF']; ?>?menu=member&id_user=<?php echo $id_user; ?>&do=update"class="btn btn-primary btn-sm btn-xs"><i class="fas fa-user-edit"></i></a>
                <a href="master_data/delete_member.php?id_user=<?php echo $id_user; ?>"class="btn btn-primary btn-sm btn-xs"><i class="fa fa-trash"></i></a></td>
              </tr>
            <?php }} ?>
             </tbody>
            </table>
            </div>
    </div>
</div><!------TABEL---------->
<?php
ini_set("display_errors",0);
if(isset($_POST['btn_update'])){	
$id_member		=$_POST ['id_member'];
$stt_update		=$_POST ['stt_update'];
if(empty($id_member)) { 
}else {
$query = "UPDATE `tabel_member` SET `stt_user`='$stt_update' WHERE `id_user`='$id_member'" ;
$hasil = mysqli_query($koneksi, $query);
echo "<script language='JavaScript'>;document.location='?menu=member'</script>";
}
}
?> 
<div class="col-sm-3"><!------FORM---------->
  <h4 class="btn btn-primary"><i class="fa fa-edit"></i> EDIT</h4><hr />		
    <div class="panel-body panel-warning"> 
      <form action="" method="post" >	
       <input name="id_member" type="hidden" id="id_update" value="<?php echo $id_update; ?>" readonly class="form-control" /> 
       <div class="form-group"> 
        <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Nama Member</div>
            </div>
            <input type="text" id="nm_update" value="<?php echo $nm_update; ?>" class="form-control" />
          </div>
       </div>
       
       <div class="form-group"> 
        <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Status</div>
            </div>
            <select name="stt_update" id="akses_update" class="form-control">
                    <option value="<?php echo $akses_update; ?>"><?php echo $akses_update; ?></option>
                    <option>----------------</option>
                    <option value="inactive">Blockir</option>
                    <option value="active">Aktifkan</option>
                  </select>
          </div>
       </div> 
        <input type="submit" name="btn_update" id="button_update" value="Update" class="btn btn-primary" />
        <input type="reset" name="btn_cancel" id="button_cancel" value="Cancel" onClick="hide(0)" class="btn btn-primary" />
       </form>  
    </div>
</div><!------FORM---------->

</div>
<script>
/*
Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
*/
$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
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

    $('.filterable .filters input').keyup(function(e){
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
        var $filteredRows = $rows.filter(function(){
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
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});
</script>
<!----------FILTER TABEL-------------------------------------------->
<script>
	$(function() {
	   $("button").click(function(){
		$("#anggota").table2excel({
            filename: "data member",
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