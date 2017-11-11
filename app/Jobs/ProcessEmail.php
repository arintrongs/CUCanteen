<?php

namespace App\Jobs;

use App\Mail\EmailVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ev;

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
        Mail::to($this->ev['email'])
                ->send($this->ev);
        
    }
}
