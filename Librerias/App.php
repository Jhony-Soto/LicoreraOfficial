<?php 

	require_once 'Controladores/ErroresController.php';

    class App 
    {
    	private $controlador="Main";
    	private $metodo="index";
    	private $parametros=[];

        function __construct(){
            $url=isset($_GET['url']) ? $_GET['url'] : NULL ;
            $url=rtrim($url,'/');
            $url=explode('/', $url);

            // Si no hay nada en la URL
            if (empty($url[0])){
            	require_once 'Controladores/'.$this->controlador.'Controller.php';
            	$this->controlador=$this->controlador.'Controller';
            	$this->controlador=new $this->controlador;
            	$this->controlador->{$this->metodo}();
            	return false;
            }

         	
         	// si hay elgo en la url
         	if (file_exists('Controladores/'.$url[0].'Controller.php')){
         		$this->controlador=ucwords($url[0]);

         		require_once 'Controladores/'.$this->controlador.'Controller.php';
         		$this->controlador=$this->controlador.'Controller';
                $this->controlador= new $this->controlador;
         		unset($url[0]);


                if(isset($url[1])){
                    $this->metodo=$url[1];
                    unset($url[1]);
                }
         		// Si existe el metodo
         		if (method_exists($this->controlador,$this->metodo)){

         			// obtenemos los parametros
         			$this->parametros=$url ? array_values($url) : [];

         			call_user_func([$this->controlador,$this->metodo],$this->parametros);
         		}else{
         			$errores= new errorescontroller;
         		}

         	}else{
         		$errores= new errorescontroller;
         	}

        }/*Fin del metodo*/
    }/*Fin de la clase*/
    
    
?>