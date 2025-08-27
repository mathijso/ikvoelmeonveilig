<?php

namespace App\Notifications;

use App\Models\EmergencyAlert;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmergencyAlertNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public EmergencyAlert $alert
    ) {}

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
        $alertUser = $this->alert->user;
        $location = $this->alert->address ?: "Lat: {$this->alert->latitude}, Lng: {$this->alert->longitude}";

        return (new MailMessage)
            ->subject('🚨 Noodmelding: Iemand heeft hulp nodig in jouw buurt')
            ->greeting('Hallo ' . $notifiable->name)
            ->line('Er is zojuist een noodmelding ontvangen van iemand in jouw buurt.')
            ->line('**Melder:** ' . $alertUser->name)
            ->line('**Locatie:** ' . $location)
            ->line('**Tijdstip:** ' . $this->alert->created_at->format('d-m-Y H:i'))
            ->action('Bekijk details en reageer', url('/emergency/' . $this->alert->id))
            ->line('Als je in de buurt bent en kunt helpen, neem dan contact op met de melder.')
            ->line('Je kunt ook 112 bellen als de situatie ernstig is.')
            ->salutation('Met vriendelijke groet, Het Veiligheidsnetwerk');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'alert_id' => $this->alert->id,
            'alert_user_name' => $this->alert->user->name,
            'location' => $this->alert->address,
            'latitude' => $this->alert->latitude,
            'longitude' => $this->alert->longitude,
            'created_at' => $this->alert->created_at,
        ];
    }
}
