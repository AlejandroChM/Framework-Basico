<?php
    /**
     * tareasController.php
     * 
     * @author Jose Alejandro Chan Martin <alejandrochanmartin1@gmail.com>
     */ 
        /**
         * Clase tareasController
         */
    class tareasController extends AppController
    {   
        /**
         * Funcion de constructor
         * @return type
         */
        public function __construct()
        {
        parent::__construct();
        }
        /**
         * Funcion que envia al index
         * @return type
         */
        public function index()
        {
        $tareas = $this->loadModel("tarea");

        $this->_view->tareas = $tareas->getTareas();
        $this->_view->titulo = "Listado de tareas";
        $this->_view->renderizar("index");
        }
        /**
         * Funcion para agregar tareas
         * @return type
         */
        public function agregar()
        {
            if ($_POST) {
                $tareas = $this->loadModel("tarea");
                if ($tareas->guardar($_POST)) 
                {
                    $this->_messages->success(
                        'Tarea guardada correctamente', 
                        $this->redirect(array("controller"=>"tareas"))
                    );
                }
                /*echo "<pre>";
                print_r($_POST);*/         
        }
            $categorias=$this->loadModel("categoria");
            $this->_view->categorias=$categorias->listarTodo();

            $this->_view->titulo="Agregar tarea";
            $this->_view->renderizar("agregar");
        }
        /**
         * Funcion que edita la tarea con el id que es recibido
         * @param null $id 
         * @return type
         */
        public function editar($id=null)
        {
            if ($_POST)
            {
                $tarea = $this->loadModel("tarea");
                if ($tarea->actualizar($_POST))
                {
                    $this->_messages->success(
                        'Tarea editada correctamente', 
                        $this->redirect(array("controller"=>"tareas"))
                    );
                }
                else
                {
                   $this->_view->flashMessage = "Los datos no se guardaron :(";
                   $this->redirect(array(
                        "controller"=>"tareas",
                        "action"=>"editar/".$id)
                    );
                }
                $this->redirect(array("controller"=>"tareas"));
            }
            
                $tarea = $this->loadModel("tarea");
                $this->_view->tarea=$tarea->buscarPorId($id);

                $categorias=$this->loadModel("categoria");
                $this->_view->categorias=$categorias->listarTodo();

                $this->_view->titulo="Editar tarea";
                $this->_view->renderizar("editar");
        }
        /**
         * Funcion que elimina la tarea con el id que se envie
         * @param $id 
         * @return type
         */
        public function eliminar($id)
        {
            $tarea = $this->loadModel("tarea");
            $registro = $tarea->buscarPorId($id);

            if (!empty($registro)) 
            {
                $tarea->eliminarPorId($id);
                $this->_messages->success(
                        'Tarea eliminada correctamente', 
                        $this->redirect(array("controller"=>"tareas"))
                );
            }
        }
        /**
         * Funcion que cambia el estado de la tarea con el id que es enviado
         * @param $id 
         * @param $status 
         * @return type
         */
        public function cambiarEstado($id, $status)
        {
            $tarea = $this->loadModel("tarea");
            if ($status=="off") 
            {
                $status=0;
            }
            elseif($status=="on")
            {
                $status=1;
            }
            $tarea->status($id, $status);
            $this->_messages->success(
                        'Estado cambiado correctamente', 
                        $this->redirect(array("controller"=>"tareas"))
            );
        }
    }