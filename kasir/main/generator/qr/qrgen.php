
<form class="form-horizontal" method="post" id="codeForm" onsubmit="return false">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label class="control-label">Masukkan angka dan huruf untuk kode yang di inginkan</label>
<input class="form-control col-xs-1" id="content" type="text" required="required">
</div>
<div class="form-group">
<label class="control-label">Code Level (ECC) : </label>
<select class="form-control col-xs-10" id="ecc">
<option value="H">H - best</option>
<option value="M">M</option>
<option value="Q">Q</option>
<option value="L">L - smallest</option>
</select>
</div>
<div class="form-group">
<label class="control-label">Ukuran</label>
<input type="number" min="1" max="10" step="1" class="form-control col-xs-10" id="size" value="5">
</div>
<div class="form-group">
<label class="control-label"></label>
<input type="submit" name="submit" id="submit" class="btn bg-warning" value="Generate QR Code">
</div>
</form>
</div>
<div class="col-md-6"> 
  <div class="showQRCode"></div>
</div>
</div>

<script>
$(document).ready(function() {
$("#codeForm").submit(function(){
$.ajax({
url:'generator/qr/generate_code.php',
type:'POST',
data: {formData:$("#content").val(), ecc:$("#ecc").val(), size:$("#size").val()},
success: function(response) {
$(".showQRCode").html(response);
},
});
});
});
</script>
