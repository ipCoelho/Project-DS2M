<?php
    session_start();
    require('/xampp/htdocs/i/senai-icatalogo-mysqli-alunos/database/conexao.php');
    //----------------------------------------------------------------------------|

    function realizarLogin($usuario, $senha, $conexao) {
        // mySQL.
        $query = "SELECT * FROM tbl_administrador WHERE usuario = '$usuario' AND senha = '$senha';";
        $sqlObject = mysqli_query($conexao, $query);
        $userArray = mysqli_fetch_array($sqlObject);

        // Tests, if the the array is set.
        if(isset($userArray['usuario']) && isset($userArray['senha']) && password_verify($senha, $userArray['senha'])) {
            $_SESSION['usuarioID'] = $userArray['id'];
            $_SESSION['usuarioN ome'] = $userArray['nome'];

            header('location: ../../produtos/index.php');
        } else {
            echo 'ALGO DEU ERRADO';
        }
    }

    switch($_POST['acao']) {

        case 'login':
            // Taking the values from the form via POST.
            $usuario_value = $_POST['usuario']; 
            $senha_value = $_POST['senha'];

            realizarLogin($usuario_value, $senha_value, $conexao);
            /* My Logic -> 
                // mySQL.
                $sql = "SELECT * FROM tbl_administrador WHERE usuario = '$usuario_value' AND senha = '$senha_value';";
                $objectSQL = mysqli_query($conexao, $sql);
                $arraySQL = mysqli_fetch_array($objectSQL);
        
                // Credentials Verification.
                if (!$arraySQL === null || !$arraySQL === false) {
                    echo("<script>alert('Autentication True.')</script>");
                } else {
                    echo("<script>alert('Autentication False.')</script>");
                } */
        break;



        case 'logout':
            session_destroy();
            header('location: ../../produtos/index.php');
        break;



    }

?>