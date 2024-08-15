<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Consulta;

class ConsultaRealizadaNotification extends Notification
{
    use Queueable;

    protected $consulta;

    /**
     * Create a new notification instance.
     *
     * @param Consulta $consulta
     * @return void
     */
    public function __construct(Consulta $consulta)
    {
        $this->consulta = $consulta;
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
                    ->subject('Detalles de su Consulta')
                    ->greeting('¡Hola, ' . $this->consulta->paciente->nombre . '!')
                    ->line('Se ha realizado una consulta para usted. A continuación, le presentamos los detalles:')
                    ->line('Fecha de la consulta: ' . $this->consulta->fecha)
                    ->line('Talla: ' . $this->consulta->talla)
                    ->line('Peso: ' . $this->consulta->peso)
                    ->line('Temperatura: ' . $this->consulta->temperatura)
                    ->line('Presión: ' . $this->consulta->presion)
                    ->line('Notas: ' . $this->consulta->notas)
                    ->line('Gracias por confiar en nosotros.')
                    ->action('Ver Detalles', url('/consultas/' . $this->consulta->id));
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
