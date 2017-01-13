<?php

namespace app\Services;

use App\Tag;

/**
 * Service class Post modelu
 * Obsahuje celu business logiku modelu
 */
class TagService {

	public function __construct() {
		//
	}

	// vytvorenie jednotlivych tagov
    // navratova hodnota je pole id novych tagov
    public function createTags($tagsArray) {
        $tagIds = [];

        foreach ($tagsArray as $tag) {
            if( !$newTag = Tag::firstOrCreate(['name' => $tag]) )
                throw new Exception("Nieco je zle");

            $tagIds[] = $newTag->id;
        }

        return $tagIds;
    }

    // funkcia vytvori jeden velky string tagov
    public function tagsToString($tagsArray) {
        $string = '';
        // pocet tagov
        $len = sizeof($tagsArray);
        // iterator
        $i = 0;

        foreach ($tagsArray as $tag) {
            $string .= $tag->name . (++$i>=$len ? '' : ',');
        }

        return $string;
    }

}