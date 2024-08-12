<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendPasswordNotification extends Notification
{
    use Queueable;

    protected $password;

    /**
     * Create a new notification instance.
     *
     * @param string $password
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Bienvenido al Sistema')
                    ->greeting('¡Hola!')
                    ->line('Se ha creado una cuenta para ti en nuestro sistema.')
                    ->line('Tu contraseña es: ' . $this->password)
                    ->line('Por favor, cambia tu contraseña después de iniciar sesión.')
                    ->action('Iniciar Sesión', url('/login'))
                    ->line('Gracias por unirte a nosotros.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
