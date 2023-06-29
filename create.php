<?php
require 'banco.php';
//Acompanha os erros de validação

// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
    $nomeProjetoErro = null;
    $gerenteProjetoErro = null;
    $montadoraErro = null;
    $responsavelMontadoraErro = null;
    $emailMontadoraErro = null;
	$telefoneMontadoraErro = null;

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
		
        if (!empty($_POST['NomeCurso'])) {
            $nomeProjeto = $_POST['NomeCurso'];
        } else {
            $nomeProjetoErro = 'Por favor digite o nome do curso!';
            $validacao = False;
        }
        echo $validacao;

        if (!empty($_POST['Valor'])) {
            $gerenteProjeto = $_POST['Valor'];
        } else {
            $gerenteProjetoErro = 'Por favor digite o valor do curso!';
            $validacao = False;
        }
        echo $validacao;

        if (!empty($_POST['Horario'])) {
            $montadora = $_POST['Horario'];
        } else {
            $montadoraErro = 'Por favor digite o horário do curso!';
            $validacao = False;
        }
		if (!empty($_POST['CodCurso'])) {
            $responsavelMontadora = $_POST['CodCurso'];
        } else {
            $responsavelMontadoraErro = 'Por favor digite o código do curso!';
            $validacao = False;
        }
        echo $validacao;
        if (!empty($_POST['DataInicio'])) {
            $emailMontadora = $_POST['DataInicio'];
        } else {
            $emailMontadoraErro = 'Por favor digite a data de início do curso!';
            $validacao = False;
        }
		echo $validacao;
		if (!empty($_POST['DataFim'])) {
            $telefoneMontadora = $_POST['DataFim'];
        } else {
            $telefoneMontadoraErro = 'Por favor digite a data de fim do curso!';
            $validacao = False;
        }
        echo $validacao;
    }

//Inserindo no Banco:
    
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO curso(NomeCurso, Valor, Horario, CodCurso, DataInicio, DataFim) VALUES(?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nomeProjeto, $gerenteProjeto, $montadora, $responsavelMontadora, date('Y-m-d', strtotime(str_replace('/', '-', $emailMontadora))), date('Y-m-d', strtotime(str_replace('/', '-', $telefoneMontadora)))));
        Banco::desconectar();
        header("Location: index.php");
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Adicionar curso</title>
</head>

<body>
<div class="container">
    <div clas="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar curso </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="create.php" method="post">

                    <div class="control-group  <?php echo !empty($nomeProjetErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Nome do curso*</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="NomeCurso" type="text" placeholder="Nome do curso"
                                   value="<?php echo !empty($nomeProjeto) ? $nomeProjeto : ''; ?>">
                            <?php if (!empty($nomeProjetoErro)): ?>
                                <span class="text-danger"><?php echo $nomeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($gerenteProjetoErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Valor*</label>
                        <div class="controls">
                            <input size="80" class="form-control" name="Valor" type="text" placeholder="Valor do curso"
                                   value="<?php echo !empty($gerenteProjeto) ? $gerenteProjeto : ''; ?>">
                            <?php if (!empty($gerenteProjetoErro)): ?>
                                <span class="text-danger"><?php echo $gerenteProjetoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($montadoraErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Horario*</label>
                        <div class="controls">
                            <input size="80" class="form-control" name="Horario" type="text" placeholder="Horario"
                                   value="<?php echo !empty($montadora) ? $montadora : ''; ?>">
                            <?php if (!empty($montadoraErro)): ?>
                                <span class="text-danger"><?php echo $gerenteProjetoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
					
					<div class="control-group <?php echo !empty($responsavelMontadoraErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Código do curso*</label>
                        <div class="controls">
                            <input size="35" class="form-control" name="CodCurso" type="text" placeholder="Código do curso"
                                   value="<?php echo !empty($responsavelMontadora) ? $responsavelMontadora : ''; ?>">
                            <?php if (!empty($responsavelMontadoraErro)): ?>
                                <span class="text-danger"><?php echo $responsavelMontadoraErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php !empty($emailMontadoraErro) ? '$emailMontadoraErro ' : ''; ?>">
                        <label class="control-label">Data de inicio*</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="DataInicio" type="text" placeholder="Data de Inicio do curso"
                                   value="<?php echo !empty($emailMontadora) ? $emailMontadora : ''; ?>">
                            <?php if (!empty($emailMontadoraErro)): ?>
                                <span class="text-danger"><?php echo $emailMontadoraErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

					<div class="control-group <?php !empty($telefoneMontadoraErro) ? '$telefoneMontadoraErro ' : ''; ?>">
                        <label class="control-label">Data de fim*</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="DataFim" type="text" placeholder="Data de fim do curso"
                                   value="<?php echo !empty($telefoneMontadora) ? $telefoneMontadora : ''; ?>">
                            <?php if (!empty($telefoneMontadoraErro)): ?>
                                <span class="text-danger"><?php echo $telefoneMontadoraErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
					
                    <div class="form-actions">
                        <br/>
                        <button type="submit" class="btn btn-success">Adicionar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>