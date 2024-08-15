<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Cita;

class CitaRegistradaNotification extends Notification
{
    use Queueable;

    protected $cita;

    /**
     * Create a new notification instance.
     *
     * @param Cita $cita
     * @return void
     */
    public function __construct(Cita $cita)
    {
        $this->cita = $cita;
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
                    ->subject('Cita Registrada')
                    ->greeting('¡Hola, ' . $this->cita->paciente->nombre . '!')
                    ->line('Su cita ha sido registrada exitosamente.')
                    ->line('Detalles de la Cita:')
                    ->line('Fecha: ' . $this->cita->fecha)
                    ->line('Hora: ' . $this->cita->hora)
                    ->line('Motivo: ' . $this->cita->motivo)
                    ->line('Observaciones: ' . $this->cita->observaciones)
                    ->action('Ver Detalles', url('/citas/' . $this->cita->id))
                    ->line('Gracias por confiar en nosotros.');
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
