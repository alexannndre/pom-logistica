<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarLogin.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $referencia = $_POST["referencia"];
    $tipopalete = $_POST["combobox2"];
    $zona = $_POST["combobox3"];
    $dataentrada = $_POST["entrada"];
    $datasaida = $_POST["saida"];
    $sql  = "INSERT INTO localizacao (palete_id, zona_id, referencia, data_entrada, data_saida) VALUES ('$tipopalete', '$zona', '$referencia', '$dataentrada', '$datasaida')";
    if (mysqli_query($conn, $sql)) {
?>
   <script type="text/javascript">;
    alert("New record created successfully"); </script>
    <?php
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
    //header("Location: navbarLogin.php");
    exit;
}
?>
 <head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="">
    <meta charset="utf-8">
    <link rel="stylesheet" href="node_modules\bootstrap3\dist\css\bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="style.css">

  </head>
  <body>

    <div class="container">
       <div class="card card-container">
           <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->

           <p id="profile-name" class="profile-name-card"></p>
           <form class="form-signin" action="localizacao.php" method="post">
               <span id="reauth-email" class="reauth-email"></span>
               <div style="text-align:center">
                    <h1>Localização</h1>
                    <br>
                    <p>Tipo de palete</p>
                    <select name="combobox2">
                        <?php
                            $busca = mysqli_query($conn,"SELECT * FROM tipo_palete");
                            foreach ($busca as $eachRow)
                            {
                        ?>
                                <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <div style="text-align:center">
                        <br>
                        <p>Zona</p>
                        <select name="combobox3">
                        <?php
                            $busca = mysqli_query($conn,"SELECT * FROM tipo_zona");
                            foreach ($busca as $eachRow)
                            {
                        ?>
                                <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                </div>     
                <div style="text-align:center">
                <br>
                <p>Referência</p>
                    <input type=text name="referencia">     
                </div>
               <div style="text-align:center">
                    <p>Data de entrada</p>
                    <input style="text-align:right" type="date" name="entrada">
               </div>
                &nbsp;
                <div style="text-align:center">
                    <p>Data de saída</p>
                    <input style="text-align:right" type="date" name="saida">
                    <br>
                </div>
                &nbsp;
               <button type="submit">Confirmar</button>
           </form><!-- /form -->
       </div><!-- /card-container -->
   </div><!-- /container -->
   <script type="text/javascript"></script>
   <script type="text/javascript"></script>
  </body>
</html>
        