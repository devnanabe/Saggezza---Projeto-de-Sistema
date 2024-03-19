<?php 
    session_start();

    if(empty($_POST) or (empty($_POST["email"]) or empty($_POST["senha"])))
    {
        echo json_encode(array("type" => "error", "message" => "Os campos não podem estar vazios!"));
        exit; // Adicionado para interromper a execução do script após enviar a resposta
    }

    include('dbconnect.php');
    
    $usuario = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM usuarios
        WHERE us_email = '{$usuario}'";

    $res = $conn->query($sql) or die($conn->error);

    $row = $res->fetch_object();

    $qtd = $res->num_rows;
    
    if($qtd > 0)
    {
        $senhabanco = $row->us_senha;

        if (password_verify($senha, $senhabanco)) {

        $_SESSION["email"] = $usuario;
        $_SESSION["nome"] = $row->us_nome;
        $_SESSION["tipo"] = $row->us_tipo;
        
        if ($row->us_tipo == '1') {
            echo json_encode(array("type" => "success", "redirect" => "./Administrador/homeadmin.php"));
        }
        else if ($row->us_tipo == '2') {
            echo json_encode(array("type" => "success", "redirect" => "./Operacional/homeop.php"));
        }
        else if($row->us_tipo == '3'){
            echo json_encode(array("type" => "success", "redirect" => "./Cliente/homecliente.php"));
        }
    }else
    {
        echo json_encode(array("type" => "error", "message" => "Dados inválidos inseridos!"));
    }
}
    else
    {
        echo json_encode(array("type" => "error", "message" => "Dados inválidos inseridos!"));
    }

    exit; // Adicionado para interromper a execução do script após enviar a resposta
?>