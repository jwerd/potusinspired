# PotusInspired
Tweets POTUS' twitter feed over inspirational backgrounds

## What is this thing?
So the goal with this project is to listen to a specific twitter feed of another user and tweet to an authenticated account 
what that twitter user writes in real-time over a backdrop image located in *public/backdrops*

## Why?
Why not?  It's a refresher on the twitter api and it's capabilities.  And it's actually a pretty neat little project.

## Tech Used
- PHP 7.1.14*
- Laravel 5.6
- spatie/twitter-streaming-api (real-time feed reader)
- thujohn/twitter (tweeting/auth, etc)

## Usage
To start a listener run the following command.
```php
php artisan trumper:build -v
```
