<?php

require 'banco.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {

    $nomeProjetoErro = null;
    $gerenteProjetoErro = null;
    $montadoraErro = null;
    $responsavelMontadoraErro = null;
    $emailMontadoraErro = null;
	$telefoneMontadoraErro = null;

    $nomeProjeto = $_POST['NomeCurso'];
    $gerenteProjeto = $_POST['Valor'];
    $montadora = $_POST['Horario'];
    $responsavelMontadora = $_POST['CodCurso'];
    $emailMontadora = $_POST['DataInicio'];
	$telefoneMontadora = $_POST['DataFim'];

    //Validação
    $validacao = true;
	
    if (empty($nomeProjeto)) {
        $nomeProjetoErro = 'Por favor digite o nome do curso!';
        $validacao = false;
    }

    if (empty($gerenteProjeto)) {
        $gerenteProjetoErro = 'Por favor digite o valor do curso!';
        $validacao = false;
    }

    if (empty($montadora)) {
        $montadoraErro = 'Por favor digite o horário do curso!';
        $validacao = false;
    }

    if (empty($id)) {
        $responsavelMontadoraErro = 'Por favor digite o código do curso!';
        $validacao = false;
    }
	
    if (empty($emailMontadora)) {
        $emailMontadoraErro = 'Por favor digite a data de início do curso!';
        $validacao = false;
    }
	
	
	if (empty($telefoneMontadora)) {
        $telefoneErro = 'Por favor digite a data de fim do curso!';
        $validacao = false;
    }

    // update data
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE curso SET NomeCurso = ?, Valor = ?, Horario = ?, DataInicio = ?, DataFim = ? WHERE CodCurso = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nomeProjeto, $gerenteProjeto, $montadora, date('Y-m-d', strtotime(str_replace('/', '-', $emailMontadora))), date('Y-m-d', strtotime(str_replace('/', '-', $telefoneMontadora))),$id));
        Banco::desconectar();
        header("Location: index.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT CodCurso, NomeCurso, Valor, Horario, DataInicio, DataFim FROM curso where CodCurso=?';
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
	
	$nomeProjeto = $data['NomeCurso'];
    $gerenteProjeto = $data['Valor'];
    $montadora = $data['Horario'];
    $id = $data['CodCurso'];
    $emailMontadora = $data['DataInicio'];
	$telefoneMontadora = $data['DataFim'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- using new bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Atualizar curso</title>
</head>

<body>
<div class="container">

    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Atualizar Curso </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="update.php?id=<?php echo $id ?>" method="post">

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
                        <label class="control-label">Gerente projeto*</label>
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
                            <input size="80" class="form-control" name="Horario" type="text" placeholder="Horarioo do curso"
                                   value="<?php echo !empty($montadoraErro) ? $montadoraErro : ''; ?>">
                            <?php if (!empty($montadoraErro)): ?>
                                <span class="text-danger"><?php echo $montadoraErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
					
					<div class="control-group <?php echo !empty($responsavelMontadoraErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Responsavel montadora*</label>
                        <div class="controls">
                            <input size="35" class="form-control" name="id" type="text" placeholder="Código do curso"
                                   value="<?php echo !empty($id) ? $id : ''; ?>">
                            <?php if (!empty($responsavelMontadoraErro)): ?>
                                <span class="text-danger"><?php echo $responsavelMontadoraErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php !empty($emailMontadoraErro) ? 'erro ' : ''; ?>">
                        <label class="control-label">Data de inicio do curso*</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="DataInicio" type="text" placeholder="Data de Inicio do curso"
                                   value="<?php echo !empty($emailMontadora) ? $emailMontadora : ''; ?>">
                            <?php if (!empty($emailMontadoraErro)): ?>
                                <span class="text-danger"><?php echo $emailMontadoraErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

					<div class="control-group <?php !empty($telefoneMontadoraErro) ? 'erro' : ''; ?>">
                        <label class="control-label">Telefone montadora*</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="DataFim" type="text" placeholder="Data de fim do curso"
                                   value="<?php echo !empty($telefoneMontadora) ? $telefoneMontadora : ''; ?>">
                            <?php if (!empty($telefoneMontadoraErro)): ?>
                                <span class="text-danger"><?php echo $telefoneMontadoraErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
					
		 <!-- -->
                    <div class="form-actions">
                        <br/>
                        <button type="submit" class="btn btn-success">Atualizar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
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
