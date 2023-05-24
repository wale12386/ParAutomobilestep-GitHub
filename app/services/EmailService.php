<?php

namespace App\services;
use PHPMailer\PHPMailer\PHPMailer;
class EmailService
{
    protected $app_name;
    protected $port;
    protected $host;
    protected $username;
    protected $password;
    function __construct()
    {
        $this->app_name=config('app.name');
        $this->port=config('app.mail_port');
        $this->host=config('app.mail_host');
        $this->username=config('app.mail_username');
        $this->password=config('app.mail_password');
    }
  public function resetPassword($subject,$emailuser,$nameUser,$isHtml,$activation_token)
  {
    $mail=new PHPMailer();
    $mail->isSMTP();
    $mail->Host=$this->host;
    $mail->Port=$this->port;
    $mail->Username=$this->username;
    $mail->Password=$this->password;
    $mail->SMTPAuth=true;
    $mail->Subject=$subject;
    $mail->setFrom($this->app_name,$this->app_name);
    $mail->addReplyTo($this->app_name,$this->app_name);
    $mail->addAddress($emailuser,$nameUser);
    $mail->isHTML($isHtml);
    $mail->Body=$this->viewResatPassword($nameUser,$activation_token);
    $mail->send();


  }

  public  function viewResatPassword($name,$activation_token)
  {
    return view('auth.reset_password')
    ->with([
        'name'=>$name,
        'activation_token'=>$activation_token
    ]);
  }
}