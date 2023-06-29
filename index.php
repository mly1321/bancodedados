<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Página Inicial</title>
</head>

<body>
        <div class="container">
          <div class="jumbotron">
            <div class="row">
                <h2>Cadastro de curso</h2>
            </div>
          </div>
            </br>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success">Novo curso</a>
                </p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <!--<th scope="col">Codigo do curso</th>-->
                            <th scope="col">Nome</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Data inicio</th>
                           <th scope="col">Data Fim</th>
                           <!-- <th scope="col">E-mail montadora</th> -->
						   <!-- <th scope="col">Tel. montadora</th> -->
                            <th scope="col">Horário</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'banco.php';
                        $pdo = Banco::conectar();
                        $sql = 'SELECT CodCurso, NomeCurso, Valor, DataInicio, DataFim, Horario  FROM curso';

                        foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>' . $row['NomeCurso'] . '</td>';
                            echo '<td>' . $row['Valor'] . '</td>';
                            echo '<td>' . date('d/m/Y', strtotime($row['DataInicio'])) . '</td>';
                            echo '<td>' . date('d/m/Y', strtotime($row['DataFim'])) . '</td>';
                            echo '<td>' . $row['Horario'] . '</td>';
							//echo '<td>'. $row['telefone_montadora'] . '</td>';
                            echo '<td width=250>';
                            echo '<a class="btn btn-primary" href="read.php?id='.$row['CodCurso'].'">Info</a>';
                            echo ' ';
                            echo '<a class="btn btn-warning" href="update.php?id='.$row['CodCurso'].'">Editar</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?id='.$row['CodCurso'].'">Excluir</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        Banco::desconectar();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
