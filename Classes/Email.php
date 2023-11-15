<?php 
namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email {
  public $nombre;
  public $email;
  public $token;
  public function __construct($nombre, $email, $token) {
    $this->nombre = $nombre;
    $this->email = $email;
    $this->token = $token;
  }

  public function enviarConfirmacion() {
    // Crear el objeto de email
    $email = new PHPMailer();
    $email->isSMTP();
    $email->Host = $_ENV["EMAIL_HOST"];
    $email->SMTPAuth = true;
    $email->Port = $_ENV["EMAIL_PORT"];
    $email->Username = $_ENV["EMAIL_USER"];
    $email->Password = $_ENV["EMAIL_PASS"];

    $email->setFrom('cuentas@complejocu.com');
    $email->addAddress("cuentas@complejocu.com", "ComplejoCultural.com");
    $email->Subject = "Confirma tu cuenta";
    $email->isHTML(true);
    
    $email->CharSet = "UTF-8";


    $contenido = "<html>";
    $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en Complejo Cultural, solo debes confirmarla presionando el siguiente enlace </p>";
    $contenido .= "<p>Preciona aqui: <a href='".$_ENV["APP_URL"]."/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
    $contenido .= "<p> Si tu no solicitaste este proceso, puedes ignorar el mensaje</p><html>";

    $email->Body = $contenido;

    // Enviar el email
    $email->send();
  }

  public function enviarInstrucciones() {
    // Crear el objeto de email
    $email = new PHPMailer();
    $email->isSMTP();
    $email->Host = $_ENV["EMAIL_HOST"];
    $email->SMTPAuth = true;
    $email->Port = $_ENV["EMAIL_PORT"];
    $email->Username = $_ENV["EMAIL_USER"];
    $email->Password = $_ENV["EMAIL_PASS"];

    $email->setFrom('cuentas@complejocu.com');
    $email->addAddress($this->email);
    $email->Subject = "Reestablece tu Password";
    $email->isHTML(true);
    
    $email->CharSet = "UTF-8";


    $contenido = "<html>";
    $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu password en tu cuenta de Complejo Cultural, para hacerlo sigue el siguiente enlace: </p>";
    $contenido .= "<p>Preciona aqui: <a href='".$_ENV["APP_URL"]."/reestablecer-password?token=" . $this->token . "'>Reestablecer Password</a></p>";
    $contenido .= "<p> Si tu no solicitaste este cambio, puedes ignorar el mensaje</p><html>";

    $email->Body = $contenido;

    // Enviar el email
    $email->send();
  }
}
?>