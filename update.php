<?php
require 'banco.php';

$id = null;
if(!empty($_GET['id'])){
    $id = $_REQUEST['id'];
}

if(null == $id){
    header("Location: index.php");
}

if(!empty($_POST)){
    $nomeErro = null;
    $enderecoErro = null;
    $telefoneErro = null;
    $emailErro = null;
    $sexoErro = null;

    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];

    $validacao = true;
    if(empty($nome)){
        $nomeErro = 'Por favor digite o nome!';
        $validacao = false;
    }

    if(empty($endereco)){
        $enderecoErro = 'Por favor digite o endereço!';
        $validacao = false;
    }

    if(empty($telefone)) {
        $telefoneErro = 'Por favor digite o telefone';
        $validacao = false;
    }

    if(empty($sexo)){
        $sexoErro = 'Por favor preenche o campo!';
        $validacao = false;
    }

    if($validacao){
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE tb_aluno set nome = ?, endereco = ?, telefone = ?, email = ?, sexo = ? where id + ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $endereco, $telefone, $email, $sexo, $id));
        Banco::desconectar();
        header("Location: index.php");
    }
}else{
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM tb_aluno where id=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nome = $data['nome'];
    $endereco = $data['endereco'];
    $telefone = $data['telefone'];
    $email = $data['email'];
    $sexo = $data['sexo'];
    Banco::desconectar();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Contato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="card">
                <div class="card-header">
                    <h3 class="well">Atualizar Contato</h3>
                </div>
                <div class="card-body">
                    <form action="update.php?id=<?php echo $id ?>" class="form-horizontal" method="post">
                        <div class="control-group <?php echo !empty($nomeErro) ? "error" : '';?>">
                            <label class="control-label">Nome</label>
                            <div class="controls">
                                <input name="nome" type="text" class="form-control" size="50" placeholder="Nome"
                                value="<?php echo !empty($nome) ? $nome : '';?>">
                                <?php if(!empty($nomeErro)): ?>
                                <span class="text-danger"><?php echo $nomeErro; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="control-group <?php echo !empty($enderecoErro) ? "error" : '';?>">
                            <label class="control-label">Endereco</label>
                            <div class="controls">
                                <input name="endereco"  type="text" class="form-control" size="80" placeholder="Nome"
                                value="<?php echo !empty($endereco) ? $endereco : '';?>">
                                <?php if(!empty($enderecoErro)):?>
                                <span class="text-danger"><?phpecho $enderecoErro;?></span>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="control-group <?php echo !empty($telefoneErro) ? "error" : '';?>">
                            <label class="control-label">Telefone</label>
                            <div class="controls">
                                <input name="telefone"  type="text" class="form-control" size="50" placeholder="Telefone"
                                value="<?php echo !empty($telefone) ? $telefone : '';?>">
                                <?php if(!empty($telefoneErro)):?>
                                <span class="text-danger"><?phpecho $telefoneErro;?></span>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="control-group <?php echo !empty($emailErro) ? "error" : '';?>">
                            <label class="control-label">Email</label>
                            <div class="controls">
                                <input name="email"  type="text" class="form-control" size="50" placeholder="Email"
                                value="<?php echo !empty($email) ? $email : '';?>">
                                <?php if(!empty($emailErro)):?>
                                <span class="text-danger"><?phpecho $emailErro;?></span>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="control-group <?php echo !empty($sexoErro) ? "error" : '';?>">
                            <label class="control-label">Sexo</label>
                            <div class="controls">
                                <div class="form-check">
                                    <p class="form-check-label">
                                        <input type="radio" name="sexo" id="sexo" class="form-check-input" value="M" <?php echo ($sexo == "M") ? "checked" : null; ?>> Masculino
                                    </p>
                                </div>
                                <div class="form-check">
                                    <p class="form-check-label">
                                        <input type="radio" name="sexo" id="sexo" class="form-check-input" value="F" <?php echo ($sexo == "F") ? "checked" : null; ?>> Feminino
                                    </p>
                                </div>
                                <?php if(!empty($sexoErro)):?>
                                <span class="text-danger"><?phpecho $emailErro;?></span>
                                <?php endif;?>
                            </div>
                        </div>
                        <br>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-warning">Atualizar</button>
                            <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>