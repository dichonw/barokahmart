// JavaScript Document
var mywin;
function popup_print(parameter){
if(parameter==1){
mywin=window.open("../manager/lap_penjualan.php","_blank","toolbar=yes,location=yes,menubar=yes,copyhistory=yes,directories=no,status=no,resizable=no,width=1000,height=600"); 
mywin.moveTo(100,100);}
else if(parameter==2){
mywin=window.open("../manager/lap_penjualan.php?view=cabang","_blank","toolbar=yes,location=yes,menubar=yes,copyhistory=yes,directories=no,status=no,resizable=no,width=1000,height=600"); 
mywin.moveTo(100,100);}
if(parameter==3){
mywin=window.open("../manager/lap_pembelian.php","_blank",	"toolbar=yes,location=yes,menubar=yes,copyhistory=yes,directories=no,status=no,resizable=no,width=1000,height=600"); 
mywin.moveTo(100,100);}
else if(parameter==4){
mywin=window.open("../manager/lap_pembelian.php?view=cabang","_blank","toolbar=yes,location=yes,menubar=yes,copyhistory=yes,directories=no,status=no,resizable=no,width=1000,height=600"); 
mywin.moveTo(100,100);}
else if(parameter==5){
mywin=window.open("../manager/lap_profit.php","_blank",	
"toolbar=yes,location=yes,menubar=yes,copyhistory=yes,directories=no,status=no,resizable=no,width=1000,height=600"); 
mywin.moveTo(100,100);}
else if(parameter==6){
mywin=window.open("../manager/lap_profit.php?view=cabang","_blank",	"toolbar=yes,location=yes,menubar=yes,copyhistory=yes,directories=no,status=no,resizable=no,width=1000,height=600"); 
mywin.moveTo(100,100);}
else if(parameter==7){
mywin=window.open("../manager/lap_penjualan_barang.php","_blank",	"toolbar=yes,location=yes,menubar=yes,copyhistory=yes,directories=no,status=no,resizable=no,width=1000,height=600"); 
mywin.moveTo(100,100);}
	
}