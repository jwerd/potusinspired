<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\ImageBuilder;

class BuildInspiringThing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    protected $tweet;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($tweet)
    {
        $this->tweet = $tweet;
        $full_message = $tweet;
        $message_text = $tweet['text'];

        if(key_exists('extended_tweet', $tweet)) {
            $full_message = $tweet['extended_tweet'];
            $message_text = $tweet['extended_tweet']['full_text'];
        }

        $message = strip_tags($message_text);
        $message = preg_replace("/[^a-zA-Z0-9\s\#\,\!\.\-\&\@\'\?\(\)\"]/", "", $message);

        if(key_exists('display_text_range', $full_message)) {
            $start_text = $full_message['display_text_range'][0];
            $end_text   = $full_message['display_text_range'][1];
            $message = substr($message, $start_text, $end_text);
        }
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $filename = (new ImageBuilder)->build($this->message);

        dispatch(new Tweet($filename, $this->tweet));
    }
}
