<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=".$_POST['nameexport']."_".date('Y-m-d', time()).".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $_POST['datos_a_enviar'];
?>