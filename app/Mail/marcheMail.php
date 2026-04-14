<?php

namespace App\Mail;

use App\Models\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class marcheMail extends Mailable
{
    use Queueable, SerializesModels;

    
    /**
     * Create a new message instance.
     */
    public function __construct( private readonly Customer $user )
    {
        //
       
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Profile confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    //le method dyal t3alom
   /* public function content(): Content
    {
        $date =$this->user->created_at;
         $id =$this->user->id;
         $href =url('').'/verify-email/'.base64_encode($date.$id);
        return new Content(
            view: 'emails.inscription',
            with:[
                'email' => $this->user->email,
                'name'=>$this->user->name,
                'href'=> $href,
            ]
        );
    }*/
//methode production
public function content(): Content
{
    $href = URL::temporarySignedRoute(
        'verify.email',
        now()->addMinutes(60), // expires in 1 hour
        ['id' => $this->user->id]
    );

    return new Content(
        view: 'emails.inscription',
        with: [
            'email' => $this->user->email,
            'name'  => $this->user->name,
            'href'  => $href,
        ]
    );
}

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
{
    return [
        /*Attachment::fromPath(storage_path('app/public/avatars/default.png'))
            ->as('image.png')
            ->withMime('image/png'),*/
    ];
}
}