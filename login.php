<?php 
    session_start();

    if(empty($_POST) or (empty($_POST["email"]) or empty($_POST["senha"])))
    {
        print "<script>location.href='index.php';</script>";
    }

    include('dbconnect.php');
    
    $usuario = $_POST["email"];
    $senha = $_POST["senha"];

$sql = "SELECT * FROM usuarios
    WHERE email = '{$usuario}'
    AND us_senha = '".md5($senha)."'";

  $res = $conn->query($sql) or die($conn->error);

  $row = $res->fetch_object();

  $qtd = $res->num_rows;

  if($qtd > 0)
  {
    $_SESSION["email"] = $usuario;
    $_SESSION["nome"] = $row->us_nome;
    $_SESSION["tipo"] = $row->tipo;
    
    if ($row->tipo == '1') {
        print "<script>location.href= './Administrador/homeadmin.php';</script>";
    }
    if ($row->tipo == '2') {
        print "<script>location.href= './Operacional/homeop.php';</script>";
    }
    if($row->tipo == '3'){
        print "<script>location.href= './Cliente/homecliente.php';</script>";
    }
}
else
{
    print "<script>alert('Usuário e/ou senha incorreto(s)');</script>";
    print "<script>location.href='index.php';</script>";
}
?>