vnamespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
<?php
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Evenement;
use App\Models\Eleve;
use Illuminate\Bus\Queueable;

class EvenementCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $evenement;

    public function __construct(Evenement $evenement)
    {
        $this->evenement = $evenement;
    }

    public function build()
    {
        return $this->subject('Nouvel événement créé')
            ->view('evenement_created');
    }
}
