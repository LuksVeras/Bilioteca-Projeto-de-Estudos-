<?php
    include_once '../model/autores.php';
    include_once '../model/livros_autores.php';
    $autor = new autores();
    switch ( $_GET['funcao'] ){
        case "insert":
            $autor->setNome( $_GET['nome'] );
            echo $autor->save();
            break;
        case "delete":
            echo $autor->remove('id in ( '.$_GET['id'].' )');
            break;
        case "update":
            $autor->unique($_GET["id"]);
            $autor->setNome($_GET["nome"]);
            $idLivros = json_decode( $_GET['idLivros'] );
            $livros_autores = new livros_autores();
            $livros_autores->remove( 'idAutores = ' . $autor->getId() );
            foreach ( $idLivros as $k => $v ){
                $livros_autores->setIdLivros( $v );
                $livros_autores->setIdAutores( $autor->getId() );
                $livros_autores->save();
            }
            echo $autor->save();
            break;
        case "select":
            unset($_GET['funcao']);
            echo json_encode( $autor->find( $_GET ) );
            break;
        case "livros_autores":
            $sql = "select distinct l.id, l.titulo from livros l where id ".$_GET['associado']." in (select idLivros from livros_autores ";
            if( $_GET['idAutores'] != "" ){
                $sql .= " where idAutores in (" . $_GET['idAutores'] . " ) )";
            }else{
                $sql .= " ) ";
            }
            $livros = $autor->findInner( $sql );
            echo json_encode( $livros );
            break;
        case "selectOne":
            $autor->unique( $_GET['id'] );
            $autor = array( "id" => $autor->getId() , "nome" => $autor->getNome() );
            echo json_encode($autor);
            break;
    }
?>