<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Thujohn\Twitter\Facades\Twitter;

class Tweet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filename;
    protected $tweet;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filename, $tweet)
    {
        $this->filename = $filename;
        $this->tweet    = $tweet;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // We upload the image
        $uploaded_media = Twitter::uploadMedia([
            'media' => file_get_contents(public_path('final/'.$this->filename))
        ]);

        // We tweet and reply to the tweet
        $postTweet = Twitter::postTweet([
            'status'                => '@realDonaldTrump',
            'media_ids'             => $uploaded_media->media_id_string,
            'in_reply_to_status_id' => $this->tweet['id'],
        ]);

        // We re-tweet on our own page
        Twitter::postRt($postTweet->id);

        // Success
    }
}
