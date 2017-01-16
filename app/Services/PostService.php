<?php

namespace app\Services;

use App\Events\PostCreated;
use App\Events\PostDeleted;
use App\Events\PostViewed;
use App\Post;
use app\Services\BaseService;
use app\Services\TagtService;

/**
 * Service class Post modelu
 * Obsahuje celu business logiku modelu
 */
class PostService extends BaseService{

	// Service class Tag modelu
	protected $tagService;
	protected $post;

	public function __construct(TagService $tagService) {
		// service class Tag modelu, obsahuje methody na pracu s tagmi
		$this->tagService = $tagService;
	}

	public function getAllPosts() {
		return Post::orderBy('created_at', 'desc')->get();
	}

	public function findPost($id) {
		return Post::findOrFail($id);
	}

	public function createNewPost($request) {

		// prihlaseny uzivatel
        $user = $this->getLoggedUser();
        // najskor sa ulozi nadpis, text clanku a kategoria
        $this->post = $user->posts()->create($request->only(['title', 'text','category_id']));
        // pocet videni pri vytvoreni postu inicializuj na 0
        $this->post->unique_views = 0;
        
        // nasledne sa vytvori obrazok a do db sa ulozi jeho nazov
        // ak request z formularu obsahuje subor(obrazok)
        if($request->hasFile('blog_photo')) {
            $fileName = $this->setPhoto($request->file('blog_photo'), $this->post);
            // nazov obrazku je ulozeny fo db
            $this->post->blog_photo = $fileName;
        }
        // inak nastav defaultny obrazok
        else {
        	$this->post->blog_photo = 'default.png';
        }

        $this->handleTags($request->input('tags'), $this->post);

        // pri vytvoreni postu sa vyvola event, ktory zvysi pocet postov 
        // prihlaseneho uzivatela a aktualizuje citanost clankov uzivatela
        event(new PostCreated());

        // nakoniec model uloz
        $this->post->save();

        return $this->post;
	}

	public function updatePost($request, $id) {
		// dany post
		$this->post = Post::findOrFail($id);
		// autor postu
		$user = $this->post->user;
		// najskor sa updatuje nazov, text a id kategorie
		$this->post->update($request->only(['title', 'text', 'category_id']));

		// ak request z formularu obsahuje subor(obrazok), updatuje sa
		if($request->hasFile('blog_photo')) {
            $fileName = $this->setPhoto($request->file('blog_photo'), $this->post);

            // ak uzivatel zmenil obrazok postu, stary obrazok vymazeme
            $this->deletePhoto($this->post);

            // nazov obrazku je ulozeny fo db
            $this->post->blog_photo = $fileName;
            $this->post->save();
        }

        $this->handleTags($request->input('tags'), $this->post);

        return $this->post;
	}

	// vymazanie clanku
	public function deletePost($id) {
		// najdeme dany clanok
		$this->post = Post::findOrFail($id);
		$tags = $this->post->tags;
		$category = $this->post->category;
		// vymazeme post
		$this->post->delete();
		// vymazeme obrazok clanku
		$this->deletePhoto($this->post);
		// prejdeme kazdy tag a skontrolujeme ci ho nejaky clanok obsahuje
		foreach ($tags as $tag) {
			$this->checkTagExistence($tag);
		}
		// ak kategoria nepatri mezi zakladnych 6 kategorii a ziaden
		// blog nepatri do tejto kategorie, vymazeme ju
		$this->checkCategoryExistence($category);

		// pri vymazani postu sa vyvola event, ktory znizi pocet postov 
        // prihlaseneho uzivatela a aktualizuje citanost clankov uzivatela
        event(new PostDeleted());
	}

	// vrat dany post ak existuje a vyvolaj event
	public function showPost($id) {
		// event inkrementuje pocet zobrazeni postu
        event(new PostViewed($id));
        
        // ziskaj post s uz aktualizovanym poctom zobrazeni
		$this->post = Post::findOrFail($id);

        return $this->post;
	}

	public function handleTags($tags, $post) {
		// pole tagov
		$splitTagsArray = [];
		$splitTagsArray = explode(",", $tags);

		// vytvorenie tagov, ak nejake su
		if(!empty($splitTagsArray[0])) {
			$tagIds = $this->tagService->createTags($splitTagsArray);
			// synchronizacia tagov s modelom
	        $post->tags()->sync( $tagIds ?: [] );
		}
	}

	public function incrReadability($id) {
    	$this->post = Post::findOrFail($id);
    	$this->post->unique_views++;
    	$this->post->save();
    }

    // kontrola existencie tagu
    public function checkTagExistence($tag) {
    	// ak tento tag nema ziadny post, vymazeme ho
    	if(!count($tag->posts)) {
    		$tag->delete();
    	}
    }

    // kontrola existencie kategorie
    public function checkCategoryExistence($category) {
    	if( ($category->id > 7) && (count($category->posts) == 0) )
    		$category->delete();
    }

}