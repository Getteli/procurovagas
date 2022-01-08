<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class SendFormAbout extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $name, $description, $email, $date)
    {
		$this->title = $title;
		$this->name = $name;
		$this->description = $description;
		$this->email = $email;
		if($date === 'now')
        {
			$this->date = Carbon::now()->translatedFormat('Y j F, l, g:i a');
		}else{
			$this->date = $date;
		}
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		return $this->from(\Config::get('mail.from.address'), "Procuro Vagas")
		->subject(\Config::get('mail.from.name')." - Contato")
		->view('email.about')
		->with([
			'title_e' => $this->title,
			'name_e' => $this->name,
			'description_e' => $this->description,
			'email_e' => $this->email,
			'date_e' => $this->date
		]);
    }
}
