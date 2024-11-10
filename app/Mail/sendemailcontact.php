<?php

namespace App\Mail;

use App\Models\Product;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendemailcontact extends Mailable
{
    use Queueable, SerializesModels;

    public $input;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($input)
    {
        $this->input=$input;

    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $setting =Setting::first();

        $input = $this->input;

        $name = $input['name'];
        $subject = 'ما یک درخواست مشاوره دارید!';
        $email = $input['email'];
        $expert_email = $setting->email;
      
        $message = $input['message'];
       




        return $this->markdown('home.sendmail.contact',compact('message','name','email','subject'))
            ->subject($subject)
            ->to($expert_email)
            ;
    }

}
