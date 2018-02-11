<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Thujohn\Twitter\Facades\Twitter;

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
        $rand = rand(1,4);
        $img = Image::make(public_path('backdrops/'.$rand.'.jpg'));

        $quoteBox = Image::canvas($img->getWidth(), 100, 'rgba(0, 0, 0, 0.5)');

        $lines = explode("\n", wordwrap($this->message, 50));
        // Sign it by Trump.
        //$lines[count($lines)-1] .= ' @realDonaldTrump';

        $position = 35;
        foreach($lines as $key => $part) {
            $font_choice = ($key === 0) ? 'MoonTypeFace/Moon Bold.otf' : 'MoonTypeFace/Moon Light.otf';
            $quoteBox->text($part, 10, $position, function($font) use ($font_choice) {
                $font->file(public_path('fonts/'.$font_choice));
                $font->size(30);
                $font->color('#fff');
            });
            $position += 30;
        }

        $img->insert($quoteBox, 'bottom');

        $filename = md5(time()).'.jpg';

        $img->save(public_path('final/'.$filename));

        dispatch(new Tweet($filename, $this->tweet));
    }
}
