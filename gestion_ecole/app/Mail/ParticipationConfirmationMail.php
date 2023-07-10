<?php
namespace App\Mail;

use App\Models\Eleve;
use App\Models\Evenement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Participant;

class ParticipationConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $participant;
    public $evenement;

    public function __construct(Eleve $participant, Evenement $evenement)
    {
        $this->participant = $participant;
        $this->evenement = $evenement;
    }

    public function build()
    {
        return $this->subject('Confirmation de participation')
            ->view('participation_confirmation');
    }
}
