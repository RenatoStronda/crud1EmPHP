<?php
    require_once("connection.php");

    if (!empty($_GET['id']))
    {
        $id = $_GET['id'];
    }

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
                echo $id;
                $sql = $conn->prepare("UPDATE funcionario SET nm_funcionario = ?, nm_CPF = ?, nm_email = ?, nm_telefone = ?, 
                ic_genero = ?, ic_estado_civil = ?, dt_nascimento = ?, nm_logradouro = ?, nm_cidade = ?, nm_bairro = ?, 
                sg_UF = ?, nm_CEP = ?, id = ? WHERE cd_funcionario = ?");
                $sql->execute(array($nome, $cpf, $email, $telefone, $genero, $estadoCivil, $dtNascimento, $logradouro, $cidade, 
                $bairro, $uf, $cep, $id));
                echo "<script language=\"javascript\">alert(\"Funcionário Atualizado Com Sucesso!\");location.replace(\"index.php\");</script>";
                $conn = null;
            }
            catch(PDOException $e)
            {
                echo "Falha Ao Atualizar O Funcionário: " . $e->getMessage();
            }
        }
    }
    else
    {
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
            echo "Falha Ao Buscar O Funcionário: " . $e->getMessage();
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Atualizar Funcionário </title>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="card-header">
                <h3 class="well"> Atualizar Funcionário </h3>
            </div>

            <div class="card-body">
                <form class="form-horizontal" action="update.php?id=<?php echo $id; ?>" method="POST">
                    <div class="control-group">
                        <label class="control-label">Nome:</label>
                        <div class="controls">
                            <input name="nome" class="form-control" size="50" type="text" placeholder="Nome" value="<?php echo !empty($nome) ? $nome : ''; ?>">
                            <span class="text-danger"><?php echo $nomeErro; ?></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"> CPF: </label>
                        <div class="controls">
                            <input name="nome" class="form-control" size="50" type="text" placeholder="CPF" value="<?php echo !empty($cpf) ? $cpf : ''; ?>">
                            <span class="text-danger"><?php echo $cpfErro; ?></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"> Email: </label>
                        <div class="controls">
                            <input name="telefone" class="form-control" size="50" type="text" placeholder="Email" value="<?php echo !empty($email) ? $email : ''; ?>">
                            <span class="text-danger"><?php echo $emailErro; ?></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"> Telefone: </label>
                        <div class="controls">
                            <input name="email" class="form-control" size="50" type="text" placeholder="Telefone" value="<?php echo !empty($telefone) ? $telefone : ''; ?>">
                            <span class="text-danger"><?php echo $telefoneErro; ?></span>
                        </div>
                    </div>
                    <br>
                    <div class="control-group">
                    <label class="control-label"> Gênero: </label>
                        <select name="genero">
                        <option value="<?php echo !empty($genero) ? $genero : ''; ?>"> Masculino </option>
                        <option value="<?php echo !empty($genero) ? $genero : ''; ?>"> Feminino </option>
                        <option value="<?php echo !empty($genero) ? $genero : ''; ?>"> Prefiro Não Opinar </option>
                        <span class="text-danger"><?php echo $generoErro; ?></span>
                        </select>
                    </div>
                    <br>
                    <div class="control-group">
                    <label class="control-label"> Estado Civil: </label>
                        <select name="estadoCivil">
                        <option value="<?php echo !empty($estadoCivil) ? $estadoCivil : ''; ?>"> Solteiro </option>
                        <option value="<?php echo !empty($estadoCivil) ? $estadoCivil : ''; ?>"> Casado </option>
                        <option value="<?php echo !empty($estadoCivil) ? $estadoCivil : ''; ?>"> Prefiro Não Opinar </option>
                        <span class="text-danger"><?php echo $estadoCivilErro; ?></span>
                        </select>
                    </div>
                    <br>
                    <div class="control-group">
                        <label class="control-label"> Data De Nascimento: </label>
                        <div class="controls">
                            <input name="dtNascimento" class="form-control" size="50" type="text" placeholder="Data De Nascimento" value="<?php echo !empty($dtNascimento) ? $dtNascimento : ''; ?>">
                            <span class="text-danger"><?php echo $dtNascimentoErro; ?></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"> Endereço: </label>
                        <div class="controls">
                            <input name="logradouro" class="form-control" size="50" type="text" placeholder="Endereço" value="<?php echo !empty($logradouro) ? $logradouro : ''; ?>">
                            <span class="text-danger"><?php echo $logradouroErro; ?></span>
                        </div>
                    </div>
                    <br>
                    <div class="control-group">
                        <label class="control-label"> Cidade: </label>
                        <select name="cidade">
                        <option value="<?php echo !empty($cidade) ? $cidade : ''; ?>"> Santos </option>
                        <option value="<?php echo !empty($cidade) ? $cidade : ''; ?>"> São Vicente </option>
                        <option value="<?php echo !empty($cidade) ? $cidade : ''; ?>"> Guarujá </option>
                        <option value="<?php echo !empty($cidade) ? $cidade : ''; ?>"> Cubatão </option>
                        <option value="<?php echo !empty($cidade) ? $cidade : ''; ?>"> Praia Grande </option>
                        <option value="<?php echo !empty($cidade) ? $cidade : ''; ?>"> Peruíbe </option>
                        <option value="<?php echo !empty($cidade) ? $cidade : ''; ?>"> Itanhaém </option>
                        <option value="<?php echo !empty($cidade) ? $cidade : ''; ?>"> Mongaguá </option>
                        <option value="<?php echo !empty($cidade) ? $cidade : ''; ?>"> Bertioga </option>
                        <span class="text-danger"><?php echo $cidadeErro; ?></span>
                        </select>
                    </div>
                    <br>
                    <div class="control-group">
                        <label class="control-label"> Bairro: </label>
                        <div class="controls">
                            <input name="bairro" class="form-control" size="50" type="text" placeholder="Bairro" value="<?php echo !empty($bairro) ? $bairro : ''; ?>">
                            <span class="text-danger"><?php echo $bairroErro; ?></span>
                        </div>
                    </div>
                    <br>
                    <div class="control-group">
                        <label class="control-label"> Estado: </label>
                        <select name="uf">
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> AC </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> AP </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> AM </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> PA </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> RO </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> RR </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> TO </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> AL </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> BA </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> CE </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> MA </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> PB </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> PE </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> PI </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> RN </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> SE </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> DF </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> GO </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> MT </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> MS </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> ES </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> MG </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> RJ </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> SP </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> PR </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> RS </option>
                        <option value="<?php echo !empty($uf) ? $uf : ''; ?>"> SC </option>
                        <span class="text-danger"><?php echo $ufErro; ?></span> 
                        </select><br>
                    </div>
                    <br>
                    <div class="control-group">
                        <label class="control-label"> CEP: </label>
                        <div class="controls">
                            <input name="email" class="form-control" size="50" type="text" placeholder="CEP" value="<?php echo !empty($cep) ? $cep : ''; ?>">
                            <span class="text-danger"><?php echo $cepErro; ?></span>
                        </div>
                    </div>

                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning"> Atualizar </button>
                        <a href="index.php" class="btn btn-success"> Voltar </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>