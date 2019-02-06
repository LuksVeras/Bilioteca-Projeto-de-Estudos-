<?php
    include_once '../model/livros.php';
    include_once '../model/estantes_livros.php';
    include_once '../model/livros_autores.php';
    include_once '../model/leitores_livros.php';
    $livros = new livros();
    switch ( $_GET['funcao'] ){
        case "insert":
            $livros->setTitulo( $_GET['titulo'] );
            $livros->setLancamento( $_GET['lancamento'] );
            $livros->setSinopse( $_GET['sinopse'] );
            $livros->setIdCategorias( $_GET['idCategoria'] );
            $livros->save();
            break;
        case "delete":
            echo $livros->remove('id in ( '.$_GET['id'].' )');
            break;
        case "update":
            $livros->unique( $_GET['id'] );
            $livros->setTitulo( $_GET['titulo'] );
            $livros->setLancamento( $_GET['lancamento'] );
            $livros->setSinopse( $_GET['sinopse'] );
            $livros->setIdCategorias( $_GET['idCategoria'] );
            echo $livros->save();
            break;
        case "select":
            $livros = $livros->findInner( "select l.id,titulo,lancamento,sinopse,idCategorias,genero from categorias c inner join livros l on c.id = l.idCategorias" );
            echo json_encode($livros);
            break;

        case "selectOne":
            $livros->unique( $_GET['id'] );
            $livros = array( "lancamento" => $livros->getLancamento() , "id" => $livros->getId() , "titulo" => $livros->getTitulo() , "sinopse" => $livros->getSinopse(), "IdCategoria" => $livros->getIdCategorias() );
            echo json_encode($livros);
            break;
    }
?>