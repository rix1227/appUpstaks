<?php

namespace Controllers;


use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router){

        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            
            $usuario = new Usuario($_POST);

            //Validar al usuario
            $alertas = $usuario->validarLogin();

            if(empty($alertas)){
                //verificar que el usuario exista
                $usuario = Usuario::where('email', $usuario->email);

                if(!$usuario || !$usuario->confirmado){
                    Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                } else{
                    //El usuario existe
                    if( password_verify($_POST['password'], $usuario->password)){

                        //Iniciar la sesion del usuario
                        session_start();
                       $_SESSION['id'] = $usuario->id;
                       $_SESSION['nombre'] = $usuario->nombre;
                       $_SESSION['email'] = $usuario->email;
                       $_SESSION['login'] = true;


                       //Redireccionar al usuario
                       header('Location: /dashboard');

                        
                    } else{
                        Usuario::setAlerta('error', 'Contraseña incorrecta');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();

        //Render a la vista
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesion',
            'alertas' => $alertas
        ]);
    }


    public static function logout(){
       
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    public static function crear(Router $router){
       
        $alertas = [];

        //Instanciar un usuario
        $usuario = new Usuario;


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);

            $alertas = $usuario->validarNuevaCuenta();

            $existeUsuario = Usuario::where('email', $usuario->email);
          
            if(empty($alertas)){
                if($existeUsuario) {
                    Usuario::setAlerta('error', 'El usuario ya esta registrado');
                    //sacarlo de memoria
                    $alertas = Usuario::getAlertas();
                } else{

                    //Hashear el password
                    $usuario->hashPassword();

                    //Eliminar password2
                    unset($usuario->password2);


                    //Generar un token


                    $usuario->crearToken();

                    
                    //Crear un nuevo usuario
                    $resultado = $usuario->guardar();
                    
                    //Enviar email
                    
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                    $email->enviarConfirmacion();

                    if($resultado){
                        header('Location: /mensaje');
                    }
                }
            }
        
        }
         //Render a la vista
         $router->render('auth/crear', [
            'titulo' => 'Crea tu cuenta en uptask',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    

    public static function olvide(Router $router){
        
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)){
                //Buscar el usuario

                $usuario = Usuario::where('email', $usuario->email);

                if($usuario && $usuario->confirmado){

                    //generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2); //Eliminar el password2

                    //Actualizar el usuario
                    $usuario->guardar();

                    //Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    //Imprimir alerta
                    Usuario::setAlerta('exito', 'Revisa tu correo electronico');

                }

                if($usuario){
                    //Encontre al usuario
                } else{
                    Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                }
            }

        }

        $alertas = Usuario::getAlertas();


        //Muestra la vista
        $router->render('auth/olvide_contraseña',[
            'titulo' => 'Olvide mi contraseña',
            'alertas'=> $alertas
        ]);
    }

    public static function reestablecer(Router $router){
        
        $token = s($_GET['token']);
        $mostrar = true;

        if(!$token) header('Location: /');

        //Identificar al usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token NO valido');
            $mostrar = false;

        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){


            //añadir el nuevo password
            $usuario->sincronizar($_POST);

            //Validar la contraseña

            $alertas = $usuario->validarPassword();

            if(empty($alertas)){
                //Hashear el nuevo password
                $usuario->hashPassword();


                //Eliminar el token
                $usuario->token = null;

                //Guardar el usuario en la BD
                $resultado = $usuario->guardar();

            
                //Redireccionar
                if($resultado){
                    header('Location: /');
                }
                
            }
        }

        $alertas = Usuario::getAlertas();
        //Muestra la vista
        $router->render('auth/reestablecer_contraseña',[
            'titulo'=> 'Reestablecer contraseña',
            'alertas' => $alertas,
            'mostrar' => $mostrar
        ]);
    }

    public static function mensaje(Router $router){
        
        $router->render('auth/mensaje',[
            'titulo'=> 'Cuenta creada con exito'
        ]);
    }

    public static function confirmar(Router $router){
       
        //Leer el tokoen de la URL
        $token = s($_GET['token']);

        if(!$token) header('Location: /');
        
        //ENCONTRAR AL USUARIO CON ESTE TOKEN
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            //No se encontro un usuario con ese token
            Usuario::setAlerta('error', 'Token NO Valido');
        } else{
            //Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = "";
            unset($usuario->password2);

            //Guardar en la BD
            $usuario->guardar();


            Usuario::setAlerta('exito', 'Cuenta comprobada correctamente');

        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar',[
            'titulo' => 'Confirma tu cuenta en UpTask',
            'alertas' => $alertas
        ]);

    }
}
