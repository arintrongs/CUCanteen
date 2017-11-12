<?php

namespace App\Jobs;

use App\Mail\EmailVerification;
use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Exception;

class ProcessEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ev;

     /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 2*24*7; //2 times an hour, 24 hours and keep doing it for a week

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ev)
    {
        $this->ev = $ev;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            Mail::to($this->ev->getEmail())
                    ->send($this->ev);
        }catch (Exception $e){
            throw $e;
        }
        
    }

    /**
     * Determine the time at which the job should timeout.
     *
     * @return \DateTime
     */
    public function retryUntil()
    {
        return now()->addSeconds(60*30);
    }
}
