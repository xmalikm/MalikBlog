<?php

namespace app\Services;

use App\Events\PostCreated;
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
		return Post::all();
	}

	public function createNewPost($request) {

		// prihlaseny uzivatel
        $user = $this->getLoggedUser();
        // najskor sa ulozi nadpis, text clanku a kategoria
        $this->post = $user->posts()->create($request->only(['title', 'text','category_id']));
        
        // nasledne sa vytvori obrazok a do db sa ulozi jeho nazov
        // ak request z formularu obsahuje subor(obrazok)
        if($request->hasFile('blog_photo')) {
            $fileName = $this->setPhoto($request->file('blog_photo'), $this->post);
            // nazov obrazku je ulozeny fo db
            $this->post->blog_photo = $fileName;
            $this->post->save();
        }

        $this->handleTags($request->input('tags'), $this->post);

        // pri vytvoreni postu sa vyvola event, ktory zvysi pocet postov prihlaseneho uzivatela
        event(new PostCreated());

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
            // nazov obrazku je ulozeny fo db
            $this->post->blog_photo = $fileName;
            $this->post->save();
        }

        $this->handleTags($request->input('tags'), $this->post);

        return $this->post;
	}

	// vrat dany post ak existuje a vyvolaj event
	public function showPost($id) {
		$this->post = Post::findOrFail($id);
		// event inkrementuje pocet zobrazeni postu
        event(new PostViewed($this->post->id));

        return $this->post;
	}

	public function handleTags($tags, $post) {
		// pole tagov
		$splitTagsArray = [];
		$splitTagsArray = explode(",", $tags);

		// vytvorenie tagov
		$tagIds = $this->tagService->createTags($splitTagsArray);

		// synchronizacia tagov s modelom
        $post->tags()->sync( $tagIds ?: [] );
	}

}