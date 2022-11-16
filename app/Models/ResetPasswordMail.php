<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;

class ResetPasswordMail extends Mailable
{
    use HasFactory;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->markdown('mail.resetpassword_credential_mail')
            ->subject($this->data['subjectContent'])
            ->with([
                'login_link' => $this->data['login_link'],'firstname' => $this->data['firstname'] ,'lastname' => $this->data['lastname'],'username' => $this->data['username'],'password' => $this->data['password']
            ]);
    }
}
