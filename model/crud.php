<?php
    include_once 'config.php';
    class Crud extends Config
    {
        function getAll(){
            $data = $this->con->query('select * from ' . get_class($this) );
            foreach( $data as $row ) {
                var_dump( $row ) . "<br>";
            }
        }
        protected function getWhere($condicao){
            $where = " where 1 = 1";
            foreach ( $condicao as $k => $v){
                $where .= " and ".$k." = :".$k;
            }
            return $where;
        }

        protected function getColumnsUpdate( $condicao ){
            $columns = array();
            foreach ( $condicao as $k => $v){
                array_push($columns, " " . $k . " = :" . $k );
            }
            return implode("," , $columns );
        }

        protected function getColumns( $condicao , $prefix = "" ){
            $columns = array();
            foreach ( $condicao as $k => $v ){
                array_push( $columns , $prefix.$k );
            }
            return implode("," , $columns );
        }

        function find($condicao){
            $arrayObjs = array();
            $where = $this->getWhere($condicao);
            $data = $this->con->prepare('select * from ' . get_class($this) . $where);
            $data->execute( $condicao );
            while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                array_push($arrayObjs , $row );
            }
            if(empty( $arrayObjs )){
                $arrayObjs = null;
            }
            return $arrayObjs;
        }

        function findInner( $sql ){
            $arrayObjs = array();
            $data = $this->con->query( $sql );
            while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                array_push( $arrayObjs , $row );
            }
            return $arrayObjs;
        }

        function unique($id) {
            $property = (object) $this->find( array("id" => $id ) )[0];
            if($property) {
                foreach ($property as $k => $v) {
                    $this->$k = $v;
                }
            }
        }

        function save(){
            $arrayObj = get_object_vars($this);
            unset($arrayObj['con']);
            if( $this->id == null ){
                unset($arrayObj['id']);
                $this->insert($arrayObj);
            }else{
                $this->update($arrayObj);
            }
        }

        protected function insert( $condicao ){
            $data = $this->con->prepare('insert into '.get_class($this). ' ('.$this->getColumns( $condicao ).') values ('.$this->getColumns( $condicao , ":" ) .')');
            $data->execute( $condicao );
            echo $data->rowCount();
        }

        public function remove( $where ){
            if( !empty( $where ) ){
                echo $this->con->exec('delete from '. get_class($this) .' where '. $where );
            }else{
                echo 0;
            }
        }

        function update($condicao){
            $column = $this->getColumnsUpdate( $condicao );
            $data = $this->con->prepare('update '. get_class($this) . ' set ' . $column . ' WHERE id = :id ');
            $data->execute( $condicao );
            echo $data->rowCount();
        }
    }
?>