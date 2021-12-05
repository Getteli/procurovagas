<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendFormCV extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $name, $description, $email, $file, $date)
    {
		$this->subject = $subject;
		$this->name = $name;
        $this->file = $file;
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
		return $this->from(\Config::get('mail.from.address'))
		->subject($this->subject)
		->view('email.vaga')
        ->attach($this->file->getRealPath(), [
            'as' => $this->file->getClientOriginalName(),
            'mime' => $this->file->getMimeType(),
        ])
		->with([
			'name_e' => $this->name,
			'description_e' => $this->description,
			'email_e' => $this->email,
			'date_e' => $this->date
		]);
    }
}
