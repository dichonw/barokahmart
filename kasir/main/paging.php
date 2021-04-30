<?php
if($hitung_record>0){
$tampil_data=true;}
else{
$tampil_data=false;}
$max_data=10;
$total_page=ceil($hitung_record /$max_data);
if(isset($_GET['page'])){
$page=$_GET['page'];
if($page<=0){
$page=1;}
else if($page>$total_page){
$page=$total_page;}
else{
$page=$page;}
}
else{
$page=1;}
$start_record=($page-1)*$max_data;
