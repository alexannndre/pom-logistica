<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarAdmin.php';
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pw = $_POST["MainPw"];
    $pw2 = $_POST["Pw2"];
    $nome = $_POST["Nome"];
    $arID = $_POST["combobox"];
    $pfID = $_POST["combobox2"];
    $email = $_POST["Email"];

    if ($pw == $pw2) {
        $stmt = $conn->prepare("INSERT INTO utilizador (perfil_id, armazem_id, nome, email, password ) VALUES(?,?,?,?,?)");
        $stmt->bind_param("iisss", $pfID, $arID, $nome, $email, $pw);
        $stmt->execute();
    } else {
        ?>
        <script type="text/javascript">
            alert("As passwords não coincidem");
        </script>
    <?php
}
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles\table.css">
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

    .btn-success {
        background-color: #01d932;
    }

    .btn-success:hover {
        background-color: #01bc2c;
    }

    body {
        color: #566787;
    }

    table,
    tr td {
        /* border: 1px solid red */
    }

    tbody {
        display: block;
        max-height: 22rem;
        overflow-y: auto;
        overflow-x: hidden;
    }

    thead,
    tbody tr {
        display: table;
        width: 100%;
        table-layout: fixed;
        /* even columns width , fix width of table too*/
    }

    thead {
        width: calc(100% - 0rem)
            /* scrollbar is average 1em/16px width, remove it from thead width */
    }
</style>

<body>
    <form style="font-family: 'Varela Round', sans-serif; font-size:13px" action="ListarUtilizadores.php" method="post" novalidate>
        <div class="container">
            <div class="table-wrapper" style="margin-top:5rem; margin-left:auto; margin-right:auto; width:65rem">
                <div class="table-title" style="background-color:#0275d8">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Gerir <b>Utilizadores</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar Utilizador</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover" style="margin-top:-0.6rem;">
                    <thead>
                        <tr>
                            <th style="width:30%">Nome</th>
                            <th style="width:35%">Email</th>
                            <th style="width:25%">Estatuto</th>
                            <th style="width:30%">Armazém</th>
                            <th style="width:14%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dado = mysqli_query($conn, "SELECT utilizador.id as id, utilizador.nome as nome, utilizador.email as email,utilizador.perfil_id as perfil_id,armazem_id, armazem.nome as armazem_nome, perfil.nome as pnome FROM utilizador INNER JOIN armazem on armazem.id=utilizador.armazem_id INNER JOIN perfil on perfil.id=utilizador.perfil_id ORDER BY id ASC");
                        foreach ($dado as $eachRow) {
                            $buscaId = $eachRow['id'];
                            $nomeID = $eachRow['id'];
                            $Nome = $eachRow['nome'];
                            $email = $eachRow['email'];
                            $ArmazemNome  = $eachRow['armazem_nome'];
                            $PerfilNome  = $eachRow['pnome'];
                            echo '<tr>';
                            echo '<td style="width:30%"> ' . $Nome . '</td>';
                            echo '<td style="width:35%"> ' . $email . '</td>';
                            echo '<td style="width:25%"> ' . $PerfilNome . '</td>';
                            echo '<td style="width:30%"> ' . $ArmazemNome . '</td>';
                            echo '<td style="width:15%">';
                            ?>
                            <button type="button" style="width:1px; height:1.5rem; color:#ffc107;" href="#editEmployeeModal" class="btn" data-toggle="modal"><i class="material-icons" style="margin-left:-11px; margin-top:-15px" data-toggle="tooltip" title="Editar">&#xE254;</i></button>
                            <button type="button" style="width:1px; height:1.5rem;" class="btn" value="<?php echo $buscaId ?>" name="teste2" id="teste2" data-toggle="modal" data-target="#deleteEmployeeModal"><i class="material-icons" style="color:#dc3545; margin-left:-11px; margin-top:-15px" data-toggle="tooltip" title="Apagar">&#xE872;</i></button>
                            <input type="hidden" value="<?php echo $buscaId ?>" name="teste">
                            <?php '</td>';
                            echo '</tr>';
                        }
                        ?>
                        <!-- <div id="Testeeee"></div> -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registar Utilizador</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input style="margin-top:1rem; height:auto;" type="input" name="Nome" class="form-control" placeholder="Nome" pattern="[A-Za-z\sâàáêèééìíôòóùúçãõ ]+" title="Apenas deve conter letras." required autofocus>
                        <input style="margin-top:1rem; height:auto;" type="email" name="Email" id="inputEmail" class="form-control" placeholder="Endereço de email" required autofocus>
                        <input style="margin-top:1rem; height:auto;" type="password" id="inputPassword" name="MainPw" class="form-control" placeholder="Password" required autofocus>
                        <input style="margin-top:1rem; height:auto;" type="password" id="input2Password" name="Pw2" class="form-control" placeholder="Confirmar Password" required autofocus>
                        <select style="text-align-last:center; margin-top:1rem; color: #6C757D;" class="form-control" name="combobox" required autofocus>
                            <option value="" disabled selected>Armazém</option>
                            <?php
                            $busca = mysqli_query($conn, "SELECT id,nome FROM armazem");
                            foreach ($busca as $eachRow) {
                                ?>
                                <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                            <?php
                        }
                        ?>
                        </select>
                        <select style="text-align-last:center; margin-top:1rem; color: #6C757D;" class="form-control" name="combobox2" required autofocus>
                            <option value="" disabled selected>Estatuto</option>
                            <?php
                            $busca = mysqli_query($conn, "SELECT id,nome FROM perfil");
                            foreach ($busca as $eachRow) {
                                ?>
                                <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                            <?php
                        }
                        ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="registar" class="btn btn-primary">Registar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Modal HTML -->
        <div id="editEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Utilizador</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <?php if (isset($_POST['teste'])) {
                            $sql = "SELECT * FROM utilizador WHERE id='" . $_POST['teste'] . "'";
                            $sql2 = mysqli_fetch_array($sql);
                            $nome = $sql2['nome'];
                        } ?>
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" value="<?php echo $nome ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Morada</label>
                            <textarea class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Telemóvel</label>
                            <input type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-info" value="Guardar">
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Modal HTML -->
        <div id="deleteEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Apagar Utilizador</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Tem a certeza que quer apagar estes registos?</p>
                        <p class="text-warning"><small>Esta ação não pode ser desfeita.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-danger" name="apagar" value="Apagar">
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
<script>
    function validateForm() {
        var x = document.forms["myForm"]["Nome"]["Email"]["MainPw"]["Pw2"]["combobox"]["combobox2"].value;
        if (x == "") {
            alert("Não preencheu todos os campos.");
            return false;
        }
    }

    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                }
            });
        });
    }

    setInputFilter(document.getElementById("uintTextBox"), function(value) {
        return /^\d*$/.test(value);
    });
</script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<script>
    $('button[name="teste2"]').on("click", function() {
        $.ajax({
            url: 'teste.php',
            type: 'POST',
            data: {
                id: $(this).val()
            },
            success: function(data) {
                $("#Testeeee").html(data);
            },
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Select/Deselect checkboxes
        var checkbox = $('table tbody input[type="checkbox"]');
        $("#selectAll").click(function() {
            if (this.checked) {
                checkbox.each(function() {
                    this.checked = true;
                });
            } else {
                checkbox.each(function() {
                    this.checked = false;
                });
            }
        });
        checkbox.click(function() {
            if (!this.checked) {
                $("#selectAll").prop("checked", false);
            }
        });
    });
</script>