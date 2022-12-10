<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = 'smtp.mailtrap.io';
        $email->SMTPAuth = true;
        $email->Port = 2525;
        $email->Username = '91bf24029f5bba';
        $email->Password = '3cd300936e8599';

        $email->setFrom('cuentas@uptask.com');
        $email->addAddress('cuentas@uptask.com', 'uptask.com');
        $email->Subject = 'Confirma tu cuenta';

        $email->isHTML(TRUE);
        $email->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .="<p><strong>Hola" .  $this->nombre . "</strong> Has Creado tu cuenta en Uptask,
                        solo debes confirmarla en el siguiente enlace </p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/confirmar?token=" . 
        $this->token ."'>Confirmar cuenta</a></p>";
        $contenido .= "<p> Si tu no creaste esta cuenta, puedes ingorar este mensaje</p>";
        $contenido .= '</html>';

        $email->Body = $contenido;

        //Enviar el email
        $email->send();
    }

    public function enviarInstrucciones(){
        
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = 'smtp.mailtrap.io';
        $email->SMTPAuth = true;
        $email->Port = 2525;
        $email->Username = '91bf24029f5bba';
        $email->Password = '3cd300936e8599';

        $email->setFrom('cuentas@uptask.com');
        $email->addAddress('cuentas@uptask.com', 'uptask.com');
        $email->Subject = 'Reestablece tu contraseña';

        $email->isHTML(TRUE);
        $email->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .="<p><strong>Hola" .  $this->nombre . "</strong> Parece que has olvidado tu contraseña, presiona
                    el siguiente enlace para recuperarlo </p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/reestablecer?token=" . 
        $this->token ."'>Reestablecer contraseña</a></p>";
        $contenido .= "<p> Si tu no creaste esta cuenta, puedes ingorar este mensaje</p>";
        $contenido .= '</html>';

        $email->Body = $contenido;

        //Enviar el email
        $email->send();
    }


}