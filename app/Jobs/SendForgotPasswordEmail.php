<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendForgotPasswordEmail implements ShouldQueue
{
    use Queueable;
    protected $details;

    /**
     * Create a new job instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new ForgotPasswordMail($this->details);
        //dd($email);        
        Mail::to($this->details['email'])->send($email);
    }
}
