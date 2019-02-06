<?php
    include_once '../model/categorias.php';
    $categoria = new categorias();
    switch ( $_GET['funcao'] ){
        case "insert":
            $categoria->setGenero( $_GET['genero']);
            echo $categoria->save();
            break;
        case "delete":
            echo $categoria->remove('id in ( '.$_GET['id'].' )');
            break;
        case "update":
            $categoria->unique( $_GET['id']);
            $categoria->setGenero( $_GET['genero'] );
            echo $categoria->save();
            break;
        case "select":
            unset( $_GET['funcao'] );
            echo json_encode($categoria->find( $_GET ));
            break;
        case "selectOne":
            $categoria->unique( $_GET['id'] );
            $categoria = array ("genero" => $categoria->getGenero(), "id" => $categoria->getId() );
            echo json_encode( $categoria );
            break;
    }
?>