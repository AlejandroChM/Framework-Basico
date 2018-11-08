<?php 
    /**
     * categoriaModel.php
     * 
     * @author Jose Alejandro Chan Martin <alejandrochanmartin1@gmail.com>
     */

    /**
     * Clase CategoriaModel
     */
    class CategoriaModel extends AppModel
    {
        private static $nombre = "categorias";
        public function listarTodo()
        {
            $categorias=$this->_db->query("SELECT * FROM categorias");

            return $categorias->fetchall();
        }
        /**
         * Funcion getCategorias que obtiene las categorias
         * @return type
         */
        public function getCategorias()
        {
                $categorias=$this->_db->query("SELECT * FROM categorias");

                foreach (range(0, $categorias->columnCount()-1) as $column_index) 
                {
                    $meta[] = $categorias->getColumnMeta($column_index);
                }

                $resultado = $categorias->fetchAll(PDO::FETCH_NUM);

                for ($i=0; $i < count($resultado); $i++) 
                { 
                    $j = 0;
                    foreach ($meta as $value) 
                    {
                        $rows[$i][$value["table"]][$value["name"]]=
                        $resultado[$i][$j];
                        $j++;
                    }
                }

            return $rows;
        }
        /**
         * Funcion guardar_categoria que almacena la categoria
         * @param type|array $datos 
         * @return type
         */
        public function guardar_categoria($datos=array())
        {
            $consulta = $this->_db->prepare(
                "INSERT INTO categorias(nombre)VALUES(:nombre)"
            );
            $consulta->bindParam(":nombre", $datos["nombre"]);

            if ($consulta->execute()) 
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        /**
         * Funcion buscarPorId que encuentra la categoriacon el id que sea enviado
         * @param $id 
         * @return type
         */
        public function buscarPorId($id)
        {
            $categorias=$this->_db->prepare(
                "SELECT * FROM tareas WHERE id=:id"
            );
            $categorias->bindParam(":id", $id);
            $categorias->execute();
            $registro=$categorias->fetch();
            if ($registro) 
            {
                return $registro;
            } else {
                return false;
            }
        }
        /**
         * Funcion actualizar_categoria que actuaiza la categoria del arreglo que sea enviado
         * @param array $datos 
         * @return type
         */
        public function actualizar_categoria($datos=array())
        {
            $consulta=$this->_db->prepare(
                "UPDATE categorias SET nombre=:nombre WHERE id=:id"
            );
            $consulta->bindParam(":id", $datos["id"]);
            $consulta->bindParam(":nombre", $datos["nombre"]);

            if ($consulta->execute()) 
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        /**
         * Funcion eliminarPorId que elimina una categoria con el id que es enviado
         * @param $id 
         * @return type
         */
        public function eliminarPorId($id)
        {
            $consulta = $this->_db->prepare(
                "DELETE FROM categorias WHERE id=:id"
            );
            $consulta->bindParam(":id", $id);
            if ($consulta->execute()) 
            {
                return true;
            } 
            else
            {
                return false;
            }
        }
    }