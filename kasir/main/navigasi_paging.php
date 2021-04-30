<?php
$menu = $_GET['menu'];
echo "
<table width='300' border='0'>
<tr class='button_tabel'>";
if ($page > 1) {
    $prev = $page - 1;
    echo "
<td><a href='" . $_SERVER['PHP_SELF'] . "?menu=" . $menu . "&page=1' class='btn btn-primary btn-xs'> First </a> </td> 
<td> <a href='" . $_SERVER['PHP_SELF'] . "?menu=" . $menu . "&page=" . $prev . "' class='btn btn-primary btn-xs'> Prev </a> </td>";
}
if ($page == 1) {
    echo "
<td>First</td>
<td>Prev</td>";
}
if ($page < $total_page) {
    $next = $page + 1;
    echo "
<td> <a href='" . $_SERVER['PHP_SELF'] . "?menu=" . $menu . "&page=" . $next . "' class='btn btn-primary btn-xs'> Next </a> </td>
<td><a href='" . $_SERVER['PHP_SELF'] . "?menu=" . $menu . "&page=" . $total_page . "' class='btn btn-primary btn-xs'> Last</a> </td>";
}
if ($page >= $total_page) {
    echo "
<td> Next </td>
<td> Last </td>";
}
echo "<td> Halaman : " . $page . "/" . $total_page . " </td>
</tr>
</table>";
