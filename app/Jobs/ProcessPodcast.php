<?php

namespace App\Jobs;

use App\Models\Podcast;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected Podcast $podcast
    )
    {
        $this->podcast = $podcast->withoutRelations();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Processing podcast: {$this->podcast->id} {$this->podcast->name}");
        sleep(4);
        throw new \Exception("something went wrong!");
        Log::info("Processed podcast: {$this->podcast->id} {$this->podcast->name}");
    }

    public function tags()
    {
        return ['process-podcast', 'podcast:'.$this->podcast->id];
    }
}
