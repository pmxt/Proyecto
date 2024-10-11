<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CitasNotification extends Notification
{
    use Queueable;
    protected $citas;

    public function __construct($citas)
    {
        $this->citas = $citas;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Notificación de Citas Agendadas')
                    ->greeting('Hola ' . $notifiable->name . '!')
                    ->line('Tienes citas agendadas para hoy:')
                    ->line($this->citas)
                    ->action('Ver Citas', url('/citas'))
                    ->line('Gracias por usar nuestro sistema.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
          'citas' => $this->citas,
        ];
    }
}
