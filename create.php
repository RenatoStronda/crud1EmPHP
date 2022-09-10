<?php
    require_once("connection.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $nomeErro = null;
        $cpfErro = null;
        $emailErro = null;
        $telefoneErro = null;
        $generoErro = null;
        $estadoCivilErro = null;
        $dtNascimentoErro = null;
        $logradouroErro = null;
        $cidadeErro = null;
        $bairroErro = null;
        $ufErro = null;
        $cepErro = null;
        $validacao = true;

        if (isset($_POST["nome"]) && !empty($_POST["nome"]))
        {
            $nome = $_POST["nome"];
        }
        else
        {
            $nomeErro = "Por Favor, Digite Seu Nome!";
            $validacao = false;
        }

        if (isset($_POST["cpf"]) && !empty($_POST["cpf"]))
        {
            $cpf = $_POST["cpf"];
        }
        else
        {
            $cpfErro = "Por Favor, Digite Seu CPF!";
            $validacao = false;
        }

        if (isset($_POST["email"]) && !empty($_POST["email"]))
        {
            $email = $_POST["email"];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $emailErro = "Por Favor, Digite Um E-mail Válido!";
                $validacao = false;
            }
        }
        else
        {
            $emailErro = "Por Favor, Digite Seu E-mail!";
            $validacao = false;
        }

        if (isset($_POST["telefone"]) && !empty($_POST["telefone"]))
        {
            $telefone = $_POST["telefone"];
        }
        else
        {
            $telefoneErro = "Por Favor, Digite Seu Telefone!";
            $validacao = false;
        }

        if (isset($_POST["genero"]) && !empty($_POST["genero"]))
        {
            $genero = $_POST["genero"];
        }
        else
        {
            $generoErro = "Por Favor, Digite Seu Gênero!";
            $validacao = false;
        }

        if (isset($_POST["estadoCivil"]) && !empty($_POST["estadoCivil"]))
        {
            $estadoCivil = $_POST["estadoCivil"];
        }
        else
        {
            $estadoCivilErro = "Por Favor, Digite Seu Estado Civil!";
            $validacao = false;
        }

        if (isset($_POST["dtNascimento"]) && !empty($_POST["dtNascimento"]))
        {
            $dtNascimento = $_POST["dtNascimento"];
        }
        else
        {
            $dtNascimentoErro = "Por Favor, Digite Sua Data De Nascimento!";
            $validacao = false;
        }

        if (isset($_POST["logradouro"]) && !empty($_POST["logradouro"]))
        {
            $logradouro = $_POST["logradouro"];
        }
        else
        {
            $logradouroErro = "Por Favor, Digite Seu Logradouro!";
            $validacao = false;
        }

        if (isset($_POST["cidade"]) && !empty($_POST["cidade"]))
        {
            $cidade = $_POST["cidade"];
        }
        else
        {
            $cidadeErro = "Por Favor, Digite Sua Cidade!";
            $validacao = false;
        }

        if (isset($_POST["bairro"]) && !empty($_POST["bairro"]))
        {
            $bairro = $_POST["bairro"];
        }
        else
        {
            $bairroErro = "Por Favor, Digite Seu Bairro!";
            $validacao = false;
        }

        if (isset($_POST["uf"]) && !empty($_POST["uf"]))
        {
            $uf = $_POST["uf"];
        }
        else
        {
            $ufErro = "Por Favor, Digite Seu Estado!";
            $validacao = false;
        }

        if (isset($_POST["cep"]) && !empty($_POST["cep"]))
        {
            $cep = $_POST["cep"];
        }
        else
        {
            $cepErro = "Por Favor, Digite Seu Cep!";
            $validacao = false;
        }

        if ($validacao)
        {
            try
            {
                $sql = $conn->prepare("INSERT INTO funcionario(nm_funcionario, nm_CPF, nm_email, nm_telefone, 
                ic_genero, ic_estado_civil, dt_nascimento, nm_logradouro, nm_cidade, nm_bairro, sg_UF, nm_CEP, id) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $sql->execute(array($nome, $cpf, $email, $telefone, $genero, $estadoCivil, $dtNascimento, $logradouro, $cidade, 
                $bairro, $uf, $cep, $id));
                echo "<script language=\"javascript\">alert(\"Funcionário Cadastrado Com Sucesso!\");</script>";
                $conn = null;
            }
            catch(PDOException $e)
            {
                echo "Falha Ao Inserir O Funcionário: " . $e->getMessage();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Cadastro De Funcionário </title>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
</head>
<body>
   <div class="container">
        <div class="span10 offset1">
            <div class="card-header">
                <h3 class="well"> Adicionar Funcionário </h3>
            </div>

            <div class="card-body">
                <form class="form-horizontal" action="create.php" method="POST">
                    <div class="control-group">
                        <label class="control-label"> Nome: </label>
                        <div class="controls">
                            <input size="50" class="form-control" name="nome" type="text" placeholder="Nome">
                            <span class="text-danger"><?php echo $nomeErro; ?></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"> CPF: </label>
                        <div class="controls">
                            <input size="50" class="form-control" name="cpf" type="text" placeholder="CPF">
                            <span class="text-danger"><?php echo $cpfErro; ?></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"> E-mail: </label>
                        <div class="controls">
                            <input size="50" class="form-control" name="email" type="text" placeholder="E-mail">
                            <span class="text-danger"><?php echo $emailErro; ?></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"> Telefone: </label>
                        <div class="controls">
                            <input size="50" class="form-control" name="telefone" type="text" placeholder="Telefone">
                            <span class="text-danger"><?php echo $telefoneErro; ?></span>
                        </div>
                    </div>
                    <br>
                    <div class="control-group">
                    <label class="control-label"> Gênero: </label>
                        <select name="genero">
                        <option value="S"> Masculino </option>
                        <option value="C"> Feminino </option>
                        <option value=" N"> Prefiro Não Opinar </option>
                        <span class="text-danger"><?php echo $generoErro; ?></span>
                        </select>
                    </div>
                    <br>
                    <div class="control-group">
                    <label class="control-label"> Estado Civil: </label>
                        <select name="estadoCivil">
                        <option value="S">Solteiro</option>
                        <option value="C">Casado</option>
                        <option value=" N">Prefiro Não Opinar</option>
                        <span class="text-danger"><?php echo $estadoCivilErro; ?></span>
                        </select>
                    </div>
                    <br>
                    <div class="control-group">
                        <label class="control-label"> Data De Nascimento: </label>
                        <div class="controls">
                            <input size="50" class="form-control" name="dtNascimento" type="text" placeholder="Data De Nascimento">
                            <span class="text-danger"><?php echo $dtNascimentoErro; ?></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"> Endereço: </label>
                        <div class="controls">
                            <input size="50" class="form-control" name="logradouro" type="text" placeholder="Endereço">
                            <span class="text-danger"><?php echo $logradouroErro; ?></span>
                        </div>
                    </div>
                    <br>
                    <div class="control-group">
                        <label class="control-label"> Cidade: </label>
                        <select name="cidade">
                        <option value="S">Santos</option>
                        <option value="SV">São Vicente</option>
                        <option value="G">Guarujá</option>
                        <option value="C">Cubatão</option>
                        <option value="PG">Praia Grande</option>
                        <option value="PE">Peruíbe</option>
                        <option value="IT">Itanhaém</option>
                        <option value="MO">Mongaguá</option>
                        <option value="BE">Bertioga</option>
                        <span class="text-danger"><?php echo $cidadeErro; ?></span>
                        </select>
                    </div>
                    <br>
                    <div class="control-group">
                        <label class="control-label"> Bairro: </label>
                        <div class="controls">
                            <input size="50" class="form-control" name="bairro" type="text" placeholder="Bairro">
                            <span class="text-danger"><?php echo $bairroErro; ?></span>
                        </div>
                    </div>
                    <br>
                    <div class="control-group">
                        <label class="control-label"> Estado: </label>
                        <select name="uf">
                        <option value="AC">AC</option>
                        <option value="AP">AP</option>
                        <option value="AM">AM</option>
                        <option value="PA">PA</option>
                        <option value="RO">RO</option>
                        <option value="RR">RR</option>
                        <option value="TO">TO</option>
                        <option value="AL">AL</option>
                        <option value="BA">BA</option>
                        <option value="CE">CE</option>
                        <option value="MA">MA</option>
                        <option value="PB">PB</option>
                        <option value="PE">PE</option>
                        <option value="PI">PI</option>
                        <option value="RN">RN</option>
                        <option value="SE">SE</option>
                        <option value="DF">DF</option>
                        <option value="GO">GO</option>
                        <option value="MT">MT</option>
                        <option value="MS">MS</option>
                        <option value="ES">ES</option>
                        <option value="MG">MG</option>
                        <option value="RJ">RJ</option>
                        <option value="SP">SP</option>
                        <option value="PR">PR</option>
                        <option value="RS">RS</option>
                        <option value="SC">SC</option>
                        <span class="text-danger"><?php echo $ufErro; ?></span> 
                        </select>
                    </div>
                    <br>
                    <div class="control-group">
                        <label class="control-label"> CEP: </label>
                        <div class="controls">
                            <input size="50" class="form-control" name="cep" type="text" placeholder="CEP">
                            <span class="text-danger"><?php echo $cepErro; ?></span>
                        </div>
                    </div>

                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning"> Cadastrar </button>
                        <a href="index.php" class="btn btn-success"> Voltar </a>
                    </div>
                </form>
            </div>
        </div>
   </div> 
</body>
</html>