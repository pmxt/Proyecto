<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPassword extends Notification
{
    use Queueable;
    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token; // Guarda el token que Laravel genera
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
            ->subject('Solicitud de Restablecimiento de Contraseña')
            ->greeting('Hola ' . $notifiable->name . '!')
            ->line('Recibiste este correo porque solicitaste un restablecimiento de contraseña para tu cuenta.')
            ->action('Restablecer Contraseña', url(route('password.reset', ['token' => $this->token, 'email' => $notifiable->email], false)))

            ->line('Este enlace para restablecer la contraseña expirará en 60 minutos.')
            ->line('Si no solicitaste este restablecimiento, ignora este correo.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
