<?php


namespace App\Notifications;


use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use phpDocumentor\Reflection\DocBlock\Tags\Link;

class TaskCompleted extends Notification
{
    use Queueable;
    public $user;
    public $titulo;
    public $tipo;
    public $mensaje;
    public $link;



    public function __construct($titulo,$tipo,$mensaje,$link)
    {
       // $this->user = $user;
        $this->titulo=$titulo;
        $this->tipo=$tipo;
        $this->mensaje = $mensaje;
        $this->link= $link;
    }

    public function via($notifiable){
        //return['database'];
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
            'data'=>$this->titulo,
            'tipo'=>$this->tipo,
            'mensaje'=>$this->mensaje,
            'link'=>$this->link
        ];
    }
}