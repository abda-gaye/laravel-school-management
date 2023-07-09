<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use App\Mail\ReminderEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReminderEmails extends Command
{


    protected $signature = 'emails:send-reminder';

    protected $description = 'Envoyer des e-mails de rappel aux utilisateurs 24 heures avant un événement spécifique';

    public function handle()
    {
       Mail::send(new ReminderEmail('mar@gmail.com','admin@gmail.com',"Envoyer des e-mails","emails"));
    }
}
