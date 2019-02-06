<?php
    include_once '../model/leitores.php';
    include_once '../model/leitores_livros.php';
    $leitores = new leitores();
    switch ( $_GET['funcao'] ){
        case "insert":
            $leitores->setNome( $_GET['nome'] );
            $leitores->setCpf( $_GET['cpf'] );
            $leitores->save();
            break;
        case "delete":
            $leitores->remove('id in ( '.$_GET['id'].' )');
            break;
        case "update":
            $leitores->unique( $_GET['id'] );
            $leitores->setNome( $_GET['nome'] );
            $leitores->setCpf( $_GET['cpf'] );
            $idLivros = json_decode( $_GET['idLivros'] );
            $leitores_livros = new leitores_livros();
            $leitores_livros->remove( 'idLeitores = ' . $leitores->getId() );
            foreach ( $idLivros as $k => $v ){
                $leitores_livros->setIdLivros( $v );
                $leitores_livros->setIdLeitores( $leitores->getId() );
                $leitores_livros->save();
            }
            $leitores->save();
            break;
        case "select":
            unset( $_GET['funcao'] );
            echo json_encode( $leitores->find( $_GET ) );
            break;
        case "leitores_livros":
            $sql = "select distinct l.id, l.titulo from livros l where id ".$_GET['associado']." in (select idLivros from leitores_livros ";
            if( $_GET['idLeitores'] != "" ){
                $sql .= " where idLeitores in (" . $_GET['idLeitores'] . ") )";
            }else{
                $sql .=  ")";
            }
            $livros = $leitores->findInner( $sql );
            echo json_encode( $livros );
            break;
        case "selectOne":
            $leitores->unique( $_GET['id'] );
            $leitores = array( "cpf" => $leitores->getCpf() , "id" => $leitores->getId() , "nome" => $leitores->getNome() );
            echo json_encode($leitores);
            break;
    }
?>