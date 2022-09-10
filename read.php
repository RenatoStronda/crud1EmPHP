<?php
    require_once("connection.php");

    if (!empty($_GET['id']))
    {
        $id = $_GET['id'];
    }

    try
    {
        $sql = $conn->prepare("SELECT * FROM funcionario WHERE cd_funcionario = ?");
        $sql->execute(array($id));
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        $nome = $data['nm_funcionario'];
        $telefone = $data['nm_telefone'];
        $email = $data['nm_email'];
    }
    catch(PDOException $e)
    {
        echo "Falha Ao Buscar O Contato: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Informações Do Funcionário </title>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="card">
                <div class="card-header">
                    <h3 class="well"> Informações Do Funcionário </h3>
                </div>

                <div class="container">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">Nome:</label>
                            <div class="controls form-control">
                                <label class="carousel-inner">
                                    <?php echo $nome; ?>
                                </label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"> CPF: </label>
                            <div class="controls form-control">
                                <label class="carousel-inner">
                                    <?php echo $cpf; ?>
                                </label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"> Email: </label>
                            <div class="controls form-control">
                                <label class="carousel-inner">
                                    <?php echo $email; ?>
                                </label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Telefone:</label>
                            <div class="controls form-control disabled">
                                <label class="carousel-inner">
                                    <?php echo $telefone; ?>
                                </label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"> Gênero: </label>
                            <div class="controls form-control disabled">
                                <label class="carousel-inner">
                                    <?php echo $genero; ?>
                                </label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"> Estado Civil: </label>
                            <div class="controls form-control">
                                <label class="carousel-inner">
                                    <?php echo $estadoCivil; ?>
                                </label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"> Data De Nascimento: </label>
                            <div class="controls form-control">
                                <label class="carousel-inner">
                                    <?php echo $dtNascimento; ?>
                                </label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"> Endereço: </label>
                            <div class="controls form-control">
                                <label class="carousel-inner">
                                    <?php echo $logradouro; ?>
                                </label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"> Cidade: </label>
                            <div class="controls form-control">
                                <label class="carousel-inner">
                                    <?php echo $cidade; ?>
                                </label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"> Bairro: </label>
                            <div class="controls form-control">
                                <label class="carousel-inner">
                                    <?php echo $bairro; ?>
                                </label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"> Estado: </label>
                            <div class="controls form-control">
                                <label class="carousel-inner">
                                    <?php echo $uf; ?>
                                </label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"> CEP: </label>
                            <div class="controls form-control">
                                <label class="carousel-inner">
                                    <?php echo $cep; ?>
                                </label>
                            </div>
                        </div>

                        <br>
                        <div class="form-actions">
                            <a href="index.php" type="btn" class="btn btn-success"> Voltar </a>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>