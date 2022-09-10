<?php
    require_once("connection.php");

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
    }

    if(isset($_POST['id']) && !empty($_POST['id']))
    {
        $cd = $_POST['id'];

        try
        {
            $sql = $conn->prepare("DELETE FROM rh WHERE cd_funcionario = ?");
            $sql->execute(array($cd));
            echo "<script language=\"javascript\">alert(\"Funcionário Excluído Com Sucesso!\");location.replace(\"index.php\");</script>";
            $conn = null;
        }
        catch(PDOException $e)
        {
            echo "Falha Ao Excluir O Funcionário: " . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Excluir Funcionário </title>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
</head>
<body>
   <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3 class="well"> Excluir Funcionário </h3>
            </div>
            
            <form class="form-horizontal" action="delete.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="alert alert-danger"> Deseja Excluir O Contato? </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-danger">Sim</button>
                    <a href="index.php" type="btn" class="btn btn-outline-danger">Não</a>
                </div>
            </form>
        </div>
   </div> 
</body>
</html>