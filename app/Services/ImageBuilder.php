<?php
namespace App\Services;

use Intervention\Image\Facades\Image;

class ImageBuilder
{
    public function build($message)
    {
        // @todo: change this to the list of backdrops in a directory dynamically
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

        return $filename;
    }
}