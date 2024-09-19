<?php

namespace App\Notifications;

use App\Models\CompanyDetail;
use App\Models\Quote;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\File;
use ZipArchive;

class SendMailAttachment extends Notification
{
    use Queueable;

    private $quote;
    public $emailDetails;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($quote, $email_details)
    {
        
        $this->quote = $quote;
        $this->emailDetails = $email_details;
      
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // TODO: zip images based on condition and attach it
              
        if ($this->quote->attach_images_in_email) {
            try {
                $zip = new ZipArchive();
                // $path = public_path('storage/user-uploads/quotation-images/temp'.$this->quote->id.'.zip');
                $path = public_path('/user-uploads/quotation-images/'.$this->quote->id.'.zip');
               

                if($zip->open($path, ZipArchive::CREATE)){
                    $photosPath = public_path('user-uploads/quotation-images/'.$this->quote->id);
                    $files = File::files($photosPath);

                    foreach ($files as $key => $value) {
                        $zip->addFile($value, basename($value));
                    }
                }

                $zip->close();
            } catch (Exception $exception) {
                dd($exception);
            }

            return (new MailMessage)
            ->subject($this->emailDetails['subject'] ? $this->emailDetails['subject'] :"Your Quote from Dentcraft is Now Available for Approval")
            ->line($this->emailDetails['template'])
            ->attach($path);
        }

        return (new MailMessage)
        ->subject($this->emailDetails['subject'] ? $this->emailDetails['subject'] :"Your Quote from Dentcraft is Now Available for Approval")
        ->line($this->emailDetails['template']);
        
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
