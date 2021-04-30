<style>
* {
  box-sizing: border-box;  
  font-size: 14px;
}

::selection{background-color: white;}

i {
  font-size: 20px;
}


/* 4. Elements - HTML Elements of the page h1-h6, etc. */



input {}

input:focus {}

input[type="submit"],
input[type="button"] {}


/* 5. Objects - wrappers, cards, etc. */

.random-background {
  background-color: #36a88e;
  /*top colour*/
  background-image: -webkit-linear-gradient(top, #36a88e, #f35b47);
  background-image: -moz-linear-gradient(top, #36a88e, #f35b47);
  background-image: -o-linear-gradient(top, #36a88e, #f35b47);
  background-image: linear-gradient(to bottom, #36a88e, #f35b47);
  height: 200vh;
  width: 100vw;
}

.itemlist{ 
  max-width:1024px;  
  margin:auto; 
  padding:20px;
  display:flex;
  flex-wrap: wrap;
}

.itemlist-item-wrapper{width: calc(90% / 3); display:inline-block; font-size: 20px !important; margin:1% 0.5% 0.5% 0.5%; background-color:white; padding:10px;
box-sizing: content-box;}

@media(max-width: 800px){
  .itemlist{ width:auto; margin:auto; padding:0;}
  .itemlist-item-wrapper{width:48%; margin:auto; margin-bottom:0.5%; padding:30px;}
}

@media(max-width: 600px){
  .itemlist{ width:auto; margin:auto; padding:0;}
  .itemlist-item-wrapper{width:auto; margin:auto; margin-bottom:2%;}
}


.lightbox-blanket {  
  display: block;
  height: 100vh;
  position: fixed;
  overflow-y: scroll;
  top: 0;
  width: 100%;
  z-index: 20;
}

.pop-up-container {
  height: 100%;
  width: auto;
  display: table;
  margin: auto;
  position: static;
}

@media (max-width:400px) {
  .pop-up-container {
    width: 96%;
    margin: 2%;
  }
}

.pop-up-container-vertical {
  height: 100%;
  vertical-align: middle;
  display: table-cell;
}

.pop-up-wrapper {
  -webkit-box-shadow: -45px 49px 83px 1px rgba(0, 0, 0, 0.45);
  -moz-box-shadow: -45px 49px 83px 1px rgba(0, 0, 0, 0.45);
  box-shadow: -45px 49px 83px 1px rgba(0, 0, 0, 0.45);
  display: block;
  margin: 20px auto;
  width: auto;
  position: relative;
}

.pop-up-wrapper {
  background-color: white;
  display: block;
  padding: 50px;
}

.go-back {
  position: absolute;
  left: 10px;
  top: 10px;
  color:#222;
  width: 0;
  height: 0;
  border-top: 60px solid #CAE00D;
  border-right: 60px solid transparent;
}

.go-back i {
  font-size:20px;
  position: relative;
  top: -52px;
  left: 10px;
}

.product-details {
  max-width: 600px;
}

.product-left {
  display: inline-block;
  padding-right: 4%;
  vertical-align: top;
  width: 46%;
}

.product-right {
  display: inline-block;
  vertical-align: top;
  width: 49%;
}

.product-bottom{border-top:1px solid #ccc; position:relative; padding-top:20px;}

@media (max-width:650px){
  .product-left, .product-right, .product-bottom{
    width:100%;}
  .product-left{padding-right:0;}
  .product-info{display:inline-block; width:60%; vertical-align:top;}
   .product-image{display:inline-block; width:39%; vertical-align:top;}
}

@media (max-width:512px){
  .product-info, .product-image{width:100%;}
}

.product-manufacturer {
  color:#222;
  font-size: 70px;
  font-weight: bold;
  line-height: 1;
  margin: -2px;
}

.product-title {
  font-size: 20px;
  color: #111;
}

.product-price {
  color:#222;
  font-size: 24px;
  letter-spacing: 1px;
}

.product-price-cents {
  text-decoration: underline;
  vertical-align: top;
  padding-left:3px;
}

.product-image {
  padding: 10px 10px 0 10px;
}

.product-image img {
  width: 100%;
    height: 100%;
    object-fit: contain;
    height: 295px;
}

.product-description {line-height:1.5;}

.product-available {
  margin-top: 25px;
}

.product-rating{
  margin-top:25px;
}

i.fa-star{color:#aaa; display:inline-block;}
i.fa-star.rating{color: rgb(232, 217, 31);}
.product-rating-details{display:inline-block; padding-left: 10px;}
@media(max-width:515px){
  .product-rating-details{padding-left:0;}
}
.product-extended {
  color: #235ba8;
  padding-left: 5px;
}
.product-quantity{margin-top:25px;
  margin-bottom:25px;}

.product-checkout{position:absolute; left:0;font-size: 12px; text-transform: uppercase;}
.product-checkout-actions{position:absolute; right:0;}
.product-checkout-total, .product-checkout-total-amount{font-size: 20px; color: #C17A41;}
.product-checkout-total * {display:inline-block;}
.product-checkout-actions{}

/* 6. Components - buttons, menus, images, etc. */
.product-quantity-label{text-transform:uppercase;}
.product-quantity *{display:inline-block;}

#product-quantity-input{background-color: #eee;border: none; width:2.5em; text-align: center;}
.product-quantity-subtract, .product-quantity-add{margin-left: 20px; padding-left:5px; padding-right: 5px;}
.product-quantity-subtract{margin-right:20px;}


.toast{
  position: fixed;
  top: -50px;
  left: calc(50vw - 50px);
  z-index:25;
  padding:5px 10px;
  border-radius: 15px;
}

.toast-success{
  background-color: green;
  color:white;
  font-size: 9pt;
}

.toast-transition{
  top: calc(50px);
  transition:top 1s;
}


/* 7. Trumps - text helpers, often !important */

.hidden {
  display: none;
}

</style>
<!--script src="../respond.min.js"></script>
<script src="../script/js/jquery.min.js"></script>
<script src="../script/js/bootstrap.min.js"></script-->

<script type="text/javascript">
function popup(){
window.open('faktur_member.php?no_faktur=<?php echo $_GET['no_faktur'];?>','page','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=600,left=50,top=50,titlebar=yes');}
</script>


<div class="lightbox-blanket">
    <div class="pop-up-container">
      <div class="pop-up-container-vertical">
        <div class="pop-up-wrapper">
          <!--div class="go-back" onclick="GoBack();"><i class="fa fa-close"></i-->
          <div class="go-back"><i class="fa fa-close"></i>
          </div>
          <div class="product-details">
            <div class="product-left">
              <div class="product-info">
                <div class="product-manufacturer">KLIK
                </div>
                <div class="product-title">
                  <p>Silahkan mencetak <br><b>NOTA PENJUALAN</b></b></p>
                </div>                
              </div>
              <div class="product-image">
                <i class="fa fa-print fa-5x"></i>
              </div>
            </div>
            <div class="product-right">
              <div class="product-description">               	
                <ul class="ds-btn">
                	 <li><a class="btn btn-lg btn-default" href="kasir.php">
                      <i class="fa fa-calculator fa-2x pull-left"></i><span>KEMBALI<br><small>Halaman Kasir</small>
                      </span></a>                         
                    </li>
                     <li><a class="btn btn-lg btn-danger" href="#" onClick="popup()">
                      <i class="fa fa-file-text fa-2x pull-left"></i><span>NOTA<br><small>Penjualan Kasir</small>
                      </span></a>                         
                    </li>                    
                 </ul>   
              </div> 
            </div>
           
          </div>
        </div>
      </div>
    </div>
  </div>
  
    





<script >//Go Back
function OpenProduct(i){
  var i = $('.product-image[item-data="'+i+'"] img');
  var lbi = $('.lightbox-blanket .product-image img');
  console.log($(i).attr("src"));
  $(lbi).attr("src", $(i).attr("src"));
 // var price =  $(i).attr("price-data");
 // var lbprice = $('.lightbox-blanket .product-info .product-price');
 // if(lbprice){
 //   price = price.split["."];
 //   $(lbprice).html("$" + price[0] + "<span class='product-price-cents'>"+price[1] +"</span>");
 //}
  
  $(".lightbox-blanket").toggle();
  
  
  $("#product-quantity-input").val("0");
  CalcPrice (0);
  
}
function GoBack(){
  $(".lightbox-blanket").toggle();
}

//Calculate new total when the quantity changes.
function CalcPrice (qty){
  var price = $(".product-price").attr("price-data");
  var total = parseFloat((price * qty)).toFixed(2);
  $(".product-checkout-total-amount").text(total);
}

//Reduce quantity by 1 if clicked
$(document).on("click", ".product-quantity-subtract", function(e){
  var value = $("#product-quantity-input").val();
  //console.log(value);
  var newValue = parseInt(value) - 1;
  if(newValue < 0) newValue=0;
  $("#product-quantity-input").val(newValue);
  CalcPrice(newValue);
});

//Increase quantity by 1 if clicked
$(document).on("click", ".product-quantity-add", function(e){
  var value = $("#product-quantity-input").val();
  //console.log(value);
  var newValue = parseInt(value) + 1;
  $("#product-quantity-input").val(newValue);
  CalcPrice(newValue);
});

$(document).on("blur", "#product-quantity-input", function(e){
  var value = $("#product-quantity-input").val();
  //console.log(value);
  CalcPrice(value);
});


function AddToCart(e){
  e.preventDefault();
  var qty = $("#product-quantity-input").val();
  if(qty === '0'){return;}
  var toast = '<div class="toast toast-success">Added '+ qty +' to cart.</div>';  
  $("body").append(toast);
  setTimeout(function(){ 
  $(".toast").addClass("toast-transition");
    }, 100);
  setTimeout(function(){      
    $(".toast").remove();
  }, 3500);
}
//# sourceURL=pen.js
</script>