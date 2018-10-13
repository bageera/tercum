<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class PostContactJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //dd($this->data);
        Mail::send('emails.contacts.main', $this->data, function($message){
            $message->from('contact@tercumllc.com', 'Contact Form');
            $message->to('contact@tercumllc.com');
        });
        //send thank you/confirmation message back to customer
        Mail::send('emails.contacts.thank-you', $this->data, function($message){
            $message->from('contact@tercumllc.com', 'Contact TercumLLC');
            $message->to($this->data['email'])->subject('Your Message has been received');
        });

        return true;
    }
}
