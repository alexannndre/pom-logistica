<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarOperador.php';
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data = $_POST["data"];
}
?>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="styles\table.css">
  <link rel="stylesheet" href="node_modules\jquery\dist\jquery.js">
  <link rel="stylesheet" href="styles\style3.css">
  <link rel="stylesheet" href="css\bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

<style>
  body {
    overflow: hidden;
  }

  /* width */
  ::-webkit-scrollbar {
    width: 0.3rem;
  }

  /* Track */
  ::-webkit-scrollbar-track {
    background: #f1f1f1;
  }

  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: #007bff;
  }

  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #0056b3;
  }

  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    background-color: #ffffff;
  }

  tbody,
  thead tr {
    display: block;
  }

  tbody {
    max-height: 18rem;
    overflow-y: auto;
    overflow-x: hidden;
  }

  tbody td,
  thead th {
    width: 210px;
  }

  thead th:last-child {
    width: 250px;
    /* 140px + 16px scrollbar width */
  }
</style>

<body>
  <?php
  $timeRN = date("Y-m-d");
  ?>
  <div class="row align-items-center" style="font-family: 'Varela Round', sans-serif; font-size:13px">
    <p id="profile-name" class="profile-name-card"></p>
    <form class="container" action="Listar_todas_as_guiasAdmin.php" method="post">
      <div class="table-wrapper" style="margin-top:10rem;">
        <ul class="nav nav-pills">
          <li class="nav-item" style="margin-top:-8.5rem; margin-left:-1.5rem;">
            <button style="border-radius:0.2rem; margin-right:1rem;" class="nav-link" value="1" data-toggle="pill" id="notConfirmed">Entrega</button>
          </li>
          <li class="nav-item" style="margin-top:-8.5rem;">
            <button style="border-radius:0.2rem;" class="nav-link" value="2" data-toggle="pill" id="Confirmed">Transporte</button>
          </li>
          <li style="margin-top:-8.5rem;">
            <input class="form-control" style="text-align:center; text-indent:1.5rem; margin-left:13rem; margin-right:auto; width:17rem;" id="DataEntrega2" type="text" name="Dataentrega2" placeholder="Data e hora de entrega" onfocus="(this.type='date')">
          </li>
        </ul>
        <div id="guiaTeste" style="margin-top:-5.5rem; margin-left:auto; margin-right:auto; width:66.3rem"></div>
        <table style="margin-top:-0.6rem; margin-left:auto; margin-right:auto;" class="table">
          <thead>
            <tr>
              <th style="width:20%">Cliente</th>
              <th style="width:20%">Nº de requisição</th>
              <th style="width:20%; padding: 0 2rem">Armazém</th>
              <th style="width:20%; padding: 0 2rem">Data e hora prevista</th>
              <th style="width:17%">Nº paletes</th>
              <th style="width:25%; padding: 0 3rem">Morada</th>
            </tr>
          </thead>
          <tbody id="Testeeee">
            <?php
            date_default_timezone_set("Europe/Lisbon");
            ?>
          </tbody>
        </table>
        <!--MODAL HERE -->
        <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content" id="ModalGuia">
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</body>

</html>

<script>
  $("#notConfirmed").on("click", function() {
    $.ajax({
      url: 'ajaxPedidosTotaisOP.php',
      type: 'POST',
      data: {
        id: $("#notConfirmed").val(),
        dataescolhida: $("#DataEntrega2").val()
      },
      success: function(data) {
        $("#notConfirmed").removeClass('btn2')
        $("#notConfirmed").addClass('btn3')
        $("#Confirmed").removeClass('btn3')
        $("#Confirmed").addClass('btn2')
        $("#Testeeee").html(data);
      },
    });
  });
</script>

<script>
  $("#Confirmed").on("click", function() {
    $.ajax({
      url: 'ajaxPedidosTotaisOP.php',
      type: 'POST',
      data: {
        id: $("#Confirmed").val(),
        dataescolhida: $("#DataEntrega2").val()

      },
      success: function(data) {

        $("#Confirmed").removeClass('btn2')
        $("#Confirmed").addClass('btn3')
        $("#notConfirmed").removeClass('btn3')
        $("#notConfirmed").addClass('btn2')
        $("#Testeeee").html(data);
      },
    });
  });
</script>

<script>
  $(document).ready(function() {
    $.ajax({
      url: 'ajaxPedidosTotaisOP.php',
      type: 'POST',
      data: {
        id: $("#notConfirmed").val(),
        dataescolhida: $("#DataEntrega2").val()
      },
      success: function(data) {
        $("#notConfirmed").removeClass('btn2')
        $("#notConfirmed").addClass('btn3')
        $("#Confirmed").removeClass('btn3')
        $("#Confirmed").addClass('btn2')
        $("#Testeeee").html(data);
      },
    });
  });
</script>

<script>
  $("#DataEntrega2").on("change", function() {
    $.ajax({
      url: 'ajaxPedidosTotaisOP.php',
      type: 'POST',
      data: {
        id: $("#notConfirmed").val(),
        dataescolhida: $("#DataEntrega2").val()
      },
      success: function(data) {
        $("#notConfirmed").removeClass('btn2')
        $("#notConfirmed").addClass('btn3')
        $("#Confirmed").removeClass('btn3')
        $("#Confirmed").addClass('btn2')
        $("#Testeeee").html(data);
      },
    });
  });
</script>

<script>
  $(document).ready(function() {
    // $.ajax({
    //   url: 'ajaxPedidosTotais.php',
    //   type: 'POST',
    //   data: {
    //     id: $("#notConfirmed").val(),
    //     dataescolhida: $("#DataEntrega2").val()
    //   },
    //   success: function(data) {
    //     $("#notConfirmed").removeClass('btn2')
    //     $("#notConfirmed").addClass('btn3')
    //     $("#Confirmed").removeClass('btn3')
    //     $("#Confirmed").addClass('btn2')
    //     $("#Testeeee").html(data);
    //   },
    // });
    $.ajax({
      url: 'ajaxGuiaTeste.php',
      type: 'POST',
      data: {
        id: $("#notConfirmed").val(),

      },
      success: function(data) {
        $("#guiaTeste").html(data);
      },
    });
  });
</script>

<script>
  $("#DataEntrega2").on("change", function() {
    $.ajax({
      url: 'ajaxPedidosTotaisOP.php',
      type: 'POST',
      data: {
        id: $("#notConfirmed").val(),
        dataescolhida: $("#DataEntrega2").val()
      },
      success: function(data) {
        $("#notConfirmed").removeClass('btn2')
        $("#notConfirmed").addClass('btn3')
        $("#Confirmed").removeClass('btn3')
        $("#Confirmed").addClass('btn2')
        $("#Testeeee").html(data);
      },
    });
  });
</script>

<script>
  $(".modal").on("hidden.bs.modal", function() {
    $(".modal-body1").html("");
  });
</script>