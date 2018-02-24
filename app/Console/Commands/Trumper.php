<?php

namespace App\Console\Commands;

use App\Jobs\BuildInspiringThing;
use Illuminate\Console\Command;
use Spatie\TwitterStreamingApi\PublicStream;
use Illuminate\Support\Facades\Log;

class Trumper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trumper:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fires off a job to do inspiring things';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $target = 25073877; // realDonaldTrump
        //$target = 967241224741507072; // potusinspired2

        //$target = 913595925334958080; // me
        //$tweet = '{"created_at":"Sat Sep 30 07:31:50 +0000 2017","id":914030008246693889,"id_str":"914030008246693889","text":"Thank you @ShopFloorNAM. An honor to be with you today. Great news! Manufacturers report record-high economic optim\u2026 https:\/\/t.co\/dtrHv6eBCJ","display_text_range":[0,140],"source":"<a href=\"http:\/\/twitter.com\" rel=\"nofollow\">Twitter Web Client<\/a>","truncated":true,"in_reply_to_status_id":null,"in_reply_to_status_id_str":null,"in_reply_to_user_id":null,"in_reply_to_user_id_str":null,"in_reply_to_screen_name":null,"user":{"id":913595925334958080,"id_str":"913595925334958080","name":"Potus Inspired","screen_name":"PotusInspired","location":"Washington, DC","url":null,"description":"Potus Inspired Quote Things.","translator_type":"none","protected":false,"verified":false,"followers_count":0,"friends_count":1,"listed_count":0,"favourites_count":0,"statuses_count":7,"created_at":"Fri Sep 29 02:46:57 +0000 2017","utc_offset":null,"time_zone":null,"geo_enabled":false,"lang":"en","contributors_enabled":false,"is_translator":false,"profile_background_color":"F5F8FA","profile_background_image_url":"","profile_background_image_url_https":"","profile_background_tile":false,"profile_link_color":"1DA1F2","profile_sidebar_border_color":"C0DEED","profile_sidebar_fill_color":"DDEEF6","profile_text_color":"333333","profile_use_background_image":true,"profile_image_url":"http:\/\/pbs.twimg.com\/profile_images\/913596850988474368\/46Ttc5ph_normal.jpg","profile_image_url_https":"https:\/\/pbs.twimg.com\/profile_images\/913596850988474368\/46Ttc5ph_normal.jpg","profile_banner_url":"https:\/\/pbs.twimg.com\/profile_banners\/913595925334958080\/1506663979","default_profile":true,"default_profile_image":false,"following":null,"follow_request_sent":null,"notifications":null},"geo":null,"coordinates":null,"place":null,"contributors":null,"is_quote_status":false,"extended_tweet":{"full_text":"Thank you @ShopFloorNAM. An honor to be with you today. Great news! Manufacturers report record-high economic optimism in 2017. #TaxReform https:\/\/t.co\/BOmOyjCEVF","display_text_range":[0,138],"entities":{"hashtags":[{"text":"TaxReform","indices":[128,138]}],"urls":[],"user_mentions":[{"screen_name":"ShopFloorNAM","name":"Nat Assn of MFG","id":26777550,"id_str":"26777550","indices":[10,23]}],"symbols":[],"media":[{"id":914030000034111488,"id_str":"914030000034111488","indices":[139,162],"media_url":"http:\/\/pbs.twimg.com\/media\/DK9JcToVYAAY-pW.jpg","media_url_https":"https:\/\/pbs.twimg.com\/media\/DK9JcToVYAAY-pW.jpg","url":"https:\/\/t.co\/BOmOyjCEVF","display_url":"pic.twitter.com\/BOmOyjCEVF","expanded_url":"https:\/\/twitter.com\/PotusInspired\/status\/914030008246693889\/photo\/1","type":"photo","sizes":{"small":{"w":680,"h":340,"resize":"fit"},"large":{"w":1024,"h":512,"resize":"fit"},"thumb":{"w":150,"h":150,"resize":"crop"},"medium":{"w":1024,"h":512,"resize":"fit"}}}]},"extended_entities":{"media":[{"id":914030000034111488,"id_str":"914030000034111488","indices":[139,162],"media_url":"http:\/\/pbs.twimg.com\/media\/DK9JcToVYAAY-pW.jpg","media_url_https":"https:\/\/pbs.twimg.com\/media\/DK9JcToVYAAY-pW.jpg","url":"https:\/\/t.co\/BOmOyjCEVF","display_url":"pic.twitter.com\/BOmOyjCEVF","expanded_url":"https:\/\/twitter.com\/PotusInspired\/status\/914030008246693889\/photo\/1","type":"photo","sizes":{"small":{"w":680,"h":340,"resize":"fit"},"large":{"w":1024,"h":512,"resize":"fit"},"thumb":{"w":150,"h":150,"resize":"crop"},"medium":{"w":1024,"h":512,"resize":"fit"}}}]}},"quote_count":0,"reply_count":0,"retweet_count":0,"favorite_count":0,"entities":{"hashtags":[],"urls":[{"url":"https:\/\/t.co\/dtrHv6eBCJ","expanded_url":"https:\/\/twitter.com\/i\/web\/status\/914030008246693889","display_url":"twitter.com\/i\/web\/status\/9\u2026","indices":[117,140]}],"user_mentions":[{"screen_name":"ShopFloorNAM","name":"Nat Assn of MFG","id":26777550,"id_str":"26777550","indices":[10,23]}],"symbols":[]},"favorited":false,"retweeted":false,"possibly_sensitive":false,"filter_level":"low","lang":"en","timestamp_ms":"1506756710479"}';
        //$tweet_simple = '{"created_at":"Sat Sep 30 07:44:07 +0000 2017","id":914033099121475584,"id_str":"914033099121475584","text":"Just testing again...","source":"<a href=\"http:\/\/twitter.com\" rel=\"nofollow\">Twitter Web Client<\/a>","truncated":false,"in_reply_to_status_id":null,"in_reply_to_status_id_str":null,"in_reply_to_user_id":null,"in_reply_to_user_id_str":null,"in_reply_to_screen_name":null,"user":{"id":913595925334958080,"id_str":"913595925334958080","name":"Potus Inspired","screen_name":"PotusInspired","location":"Washington, DC","url":null,"description":"Potus Inspired Quote Things.","translator_type":"none","protected":false,"verified":false,"followers_count":0,"friends_count":1,"listed_count":0,"favourites_count":0,"statuses_count":3,"created_at":"Fri Sep 29 02:46:57 +0000 2017","utc_offset":null,"time_zone":null,"geo_enabled":false,"lang":"en","contributors_enabled":false,"is_translator":false,"profile_background_color":"F5F8FA","profile_background_image_url":"","profile_background_image_url_https":"","profile_background_tile":false,"profile_link_color":"1DA1F2","profile_sidebar_border_color":"C0DEED","profile_sidebar_fill_color":"DDEEF6","profile_text_color":"333333","profile_use_background_image":true,"profile_image_url":"http:\/\/pbs.twimg.com\/profile_images\/913596850988474368\/46Ttc5ph_normal.jpg","profile_image_url_https":"https:\/\/pbs.twimg.com\/profile_images\/913596850988474368\/46Ttc5ph_normal.jpg","profile_banner_url":"https:\/\/pbs.twimg.com\/profile_banners\/913595925334958080\/1506663979","default_profile":true,"default_profile_image":false,"following":null,"follow_request_sent":null,"notifications":null},"geo":null,"coordinates":null,"place":null,"contributors":null,"is_quote_status":false,"quote_count":0,"reply_count":0,"retweet_count":0,"favorite_count":0,"entities":{"hashtags":[],"urls":[],"user_mentions":[],"symbols":[]},"favorited":false,"retweeted":false,"filter_level":"low","lang":"en","timestamp_ms":"1506757447401"}';
        //dispatch(new BuildInspiringThing(json_decode($tweet_simple, true)));
        //dispatch(new Tweet('68d4ea91a4ab86f54d274fad73362c9b.jpg'));

        PublicStream::create(
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SECRET'),
            env('TWITTER_CONSUMER_KEY'),
            env('TWITTER_CONSUMER_SECRET')
        )->whenTweets($target, function(array $tweet) use ($target) {
            if(!empty($tweet['text']) && !key_exists('retweeted_status', $tweet)) {
                if($tweet['user']['id'] === $target) { // Only when Trump tweets, make sure Author is TRUMP
                    Log::info('Tweet', json_encode($tweet));
                    dispatch(new BuildInspiringThing($tweet));
                }
            }
        })->startListening();

        //dispatch(new BuildInspiringThing('FEMA & First Responders are doing a GREAT job in Puerto Rico. Massive food & water delivered. Docks & electric grid dead. Locals trying....'));
    }
}
