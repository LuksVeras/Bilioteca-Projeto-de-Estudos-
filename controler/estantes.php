<?php
    include_once '../model/estantes.php';
    include_once '../model/estantes_livros.php';
    include_once '../model/estantes_categorias.php';
    $estantes = new estantes();
    switch( $_GET['funcao'] ){
        case "insert":
            $estantes->setCodigo( $_GET['codigo'] );
            echo $estantes->save();
            break;
        case "delete":
            echo $estantes->remove('id in ( '.$_GET['id'].' )');
            break;
        case "update":
            $estantes->unique( $_GET['id'] );
            $estantes->setCodigo( $_GET['codigo'] );

            $idCategorias = json_decode( $_GET['idCategorias'] );
            $idLivros = json_decode( $_GET['idLivros'] );

            $estantes_livros = new estantes_livros();
            $estantes_categorias = new estantes_categorias();

            $estantes_livros->remove("idEstantes = " . $estantes->getId() );
            $estantes_categorias->remove("idEstantes = " . $estantes->getId() );

            foreach ( $idLivros as $k => $v ){
                $estantes_livros->setIdLivros( $v );
                $estantes_livros->setIdEstantes( $estantes->getId() );
                $estantes_livros->save();
            }
            foreach ( $idCategorias as $k => $v ){
                $estantes_categorias->setIdCategorias( $v );
                $estantes_categorias->setIdEstantes( $estantes->getId() );
                $estantes_categorias->save();
            }

            echo $estantes->save();
            break;
        case "select":
            unset($_GET['funcao']);
            echo json_encode( $estantes->find( $_GET ) );
            break;
        case "estantes_livros":

            $sql = "select distinct l.id, l.titulo from livros l where id ".$_GET['associado']." in (select idLivros from estantes_livros ";
            if( $_GET['idEstantes'] != "" ) {
                $sql .= " where idEstantes in (" . $_GET['idEstantes'] . " ) )";
            }else{
                $sql .= " ) ";
            }
            if( $_GET['idCategorias'] != "" ) {
                $sql .= " and idCategorias in (" . $_GET['idCategorias'] . " ) ";
            }

            $livros = $estantes->findInner($sql);
            echo json_encode( $livros );
            break;
        case "estantes_categorias":
            $sql = "select distinct c.id, c.genero from categorias c where id ".$_GET['associado']." in ( select idCategorias from estantes_categorias ";
            if( $_GET['idEstantes'] != "" ) {
                $sql .= " where idEstantes in (" . $_GET['idEstantes'] . " ) )";
            }else{
                $sql .= " ) ";
            }
            $categorias = $estantes->findInner( $sql );
            echo json_encode( $categorias );
            break;
        case 'selectOne':
            $estantes->unique( $_GET['id'] );
            $estantes = array ( "codigo" => $estantes->getCodigo(), "id" => $estantes->getId() );
            echo json_encode( $estantes );
            break;
    }

?>

