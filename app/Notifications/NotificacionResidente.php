<?php


namespace App\Notifications;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use phpDocumentor\Reflection\DocBlock\Tags\Link;



class NotificacionResidente extends Notification{
    use Queueable;
    public $titulo;
    public $tipo;
    public $mensaje;
    public $obra;

    public function __construct($titulo,$tipo,$mensaje,$obra){
        $this->titulo = $titulo;
        $this->tipo=$tipo;
        $this->mensaje=$mensaje;
        $this->obra=$obra;
    }

    public function via($notifiable){
        return['mail','database'];
    }


    public function toMail($notifiable){
        return(new MailMessage())
            ->subject('Yurta App')
            ->greeting('hola')
            ->line('Linea 1')
            ->action('Notification Action',url('/'))
            ->line('Gracias')
            ->salutation('despido');
    }

    public function toArray($notifiable){
        return[
            'titulo'=>$this->titulo,
            'tipo'=>$this->tipo,
            'mensaje'=>$this->mensaje,
            'obra'=>$this->obra
        ];
    }
}