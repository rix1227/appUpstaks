<?php

namespace Controllers;

use MVC\Router;

class LoginController {
    public static function login(Router $router){
       

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }

        //Render a la vista
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesion'
        ]);
    }


    public static function logout(){
       
    }

    public static function crear(Router $router){
       

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }
         //Render a la vista
         $router->render('auth/crear', [
            'titulo' => 'Crea tu cuenta en uptask',
        ]);
    }
    

    public static function olvide(Router $router){
        

        if($_SERVER['REQUEST_METHOD'] === 'POST'){


        }
        //Muestra la vista
        $router->render('auth/olvide_contraseña',[
            'titulo' => 'Olvide mi contraseña'
        ]);
    }

    public static function reestablecer(Router $router){
        

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }

        //Muestra la vista
        $router->render('auth/reestablecer_contraseña',[
            'titulo'=> 'Reestablecer contraseña'
        ]);
    }

    public static function mensaje(Router $router){
        
        $router->render('auth/mensaje',[
            'titulo'=> 'Cuenta creada con exito'
        ]);
    }

    public static function confirmar(Router $router){
       
        $router->render('auth/confirmar',[
            'titulo' => 'Confirma tu cuenta en UpTask'
        ]);

    }
}
