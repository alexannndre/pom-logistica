<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");

$sql =  mysqli_query($conn,"SELECT guia.numero_requisicao as guiareq, tipo_palete.nome as tipopalete,artigo.nome as nomeartigo, artigo.referencia as artigo_referencia, guia.numero_paletes as numeropaletes FROM guia INNER JOIN artigo on artigo.id=guia.artigo_id INNER JOIN tipo_palete on tipo_palete.id=guia.tipo_palete_id WHERE guia.id='".$_POST['id']."'");
$dados = mysqli_fetch_array($sql); 

echo '<div class="form-group">';
echo    '<label style="margin-left:2.7rem;">Referência da Guia</label>';
echo    '<input type="text" style="margin-left:auto; margin-right:auto; background-color:#fff; width:80%; cursor:default;" class="form-control" name="TableClick" value="' . $dados['guiareq'] . '" readonly>';
echo '</div>';

echo '<div class="form-group">';
echo    '<label style="margin-left:2.7rem;">Nome do Artigo</label>';
echo    '<input type="text" style="margin-left:auto; margin-right:auto; background-color:#fff; width:80%; cursor:default;" class="form-control" name="TableClick" value="' . $dados['nomeartigo'] . '" readonly>';
echo '</div>';

echo '<div class="form-group">';
echo    '<label style="margin-left:2.7rem;">Referência do Artigo</label>';
echo    '<input type="text" style="margin-left:auto; margin-right:auto; background-color:#fff; width:80%; cursor:default;" class="form-control" name="TableClick" value="' . $dados['artigo_referencia'] . '" readonly>';
echo '</div>';

echo '<div class="form-group">';
echo    '<label style="margin-left:2.7rem;">Tipo de Palete</label>';
echo    '<input type="text" style="margin-left:auto; margin-right:auto; background-color:#fff; width:80%; cursor:default;" class="form-control" name="TableClick" value="' . $dados['tipopalete'] . '" readonly>';
echo '</div>';

echo '<div class="form-group">';
echo    '<label style="margin-left:2.7rem;">Número de Paletes</label>';
echo    '<input type="text" style="margin-left:auto; margin-right:auto; background-color:#fff; width:80%; cursor:default;" class="form-control" name="TableClick" value="' . $dados['numeropaletes'] . '" readonly>';
echo '</div>';