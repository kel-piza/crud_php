<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Inicial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <div class="row">
                <h2>AULA DE PWBE - CRUD <span class="badge badge-secondary">v 1.0.0 - SENAI</span></h2>
            </div>
        </div>
        <br>
        <div class="row">
            <p>
                <a href="create.php" class="btn btn-success">Adicionar</a>
            </p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'banco.php';
                    $pdo = Banco::conectar();
                    $sql = 'SELECT * FROM tb_aluno ORDER BY id DESC';

                    foreach($pdo->query($sql) as $row)
                    {
                        echo '<tr>';
                        echo '<th scope="row">' .$row['id']. '</th>';
                        echo '<td>'.$row['nome']. '</td>';
                        echo '<td>'.$row['endereco']. '</td>';
                        echo '<td>'.$row['telefone']. '</td>';
                        echo '<td>'.$row['email']. '</td>';
                        echo '<td>'.$row['sexo']. '</td>';
                        echo '<td width="250">';
                        echo '<a class="btn btn-primary" href="read.php?id='.$row['id'].'">Info</a>';
                        echo '';
                        echo '<a class="btn btn-warning" href="update.php?id='.$row['id'].'">Atualizar</a>';
                        echo '';
                        echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Excluir</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    Banco::desconectar();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>