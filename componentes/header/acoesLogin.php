<?php
    require('/xampp/htdocs/i/senai-icatalogo-mysqli-alunos/database/conexao.php');

    // Prof.
    function logar($usuario, $senha, $conexao) {
        $sql = "SELECT * FROM tbl_administrador WHERE usuario = '$usuario' AND senha = '$senha';";
        $sqlObject = mysqli_query($conexao, $sql);
        $sqlArray = mysqli_fetch_array($sqlObject);

        if(isset($sqlArray['usuario']) && isset($sqlArray['senha'])) {
            echo '1';
        } else {
            echo '0';
        }
    }

    logar('israel', '123', $conexao);


    // switch($_POST['acao']) {

    //     case 'login':
    //         // Taking the values from the form via POST.
    //         $usuario_value = $_POST['usuario']; 
    //         $senha_value = $_POST['senha'];

    //         // mySQL.
    //         $sql = "SELECT * FROM tbl_administrador WHERE usuario = '$usuario_value' AND senha = '$senha_value';";
    //         $objectSQL = mysqli_query($conexao, $sql);
    //         $arraySQL = mysqli_fetch_array($objectSQL);

    //         if (!$arraySQL === null || !$arraySQL === false) {
    //             echo("<script>alert('Autentication True.')</script>");
    //         } else {
    //             echo("<script>alert('Autentication False.')</script>");
    //         }
    // }
?>