<?php

namespace app\Services;

use App\Events\PostDeleted;
use App\Post;
use Illuminate\Support\Facades\Auth;
use app\Services\BaseService;
use app\Services\TagService;

/**
 * Service class Post modelu
 * Obsahuje business logiku modelu
 */
class PostService extends BaseService{

	// Service class Tag modelu
	protected $tagService;
	protected $post;

	public function __construct(TagService $tagService) {
		// service class Tag modelu, obsahuje methody na pracu s tagmi
		$this->tagService = $tagService;
	}

	// vytvorenie noveho postu
	public function createNewPost($request) {

		// prihlaseny uzivatel
        $user = Auth::user();
        // najskor sa ulozi nadpis, text clanku a kategoria
        $this->post = $user->posts()->create($request->only(['title', 'text','category_id']));
        // pocet videni a popularitu pri vytvoreni postu inicializuj na 0
        $this->post->unique_views = 0;
        $this->post->popularity = 0.0;
        
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

		// ak sa pridali nove tagy, vytvorime ich
        $this->handleTags($request->input('tags'), $this->post);

        // nakoniec model uloz
        $this->post->save();

        return $this->post;
	}

	// aktualizacia clanku
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

        // ak sa pridali nove tagy, vytvorime ich
        $this->handleTags($request->input('tags'), $this->post);

        return $this->post;
	}

	// vymazanie clanku
	public function deletePost($id) {
		// najdeme dany clanok
		$this->post = Post::findOrFail($id);
		
		// treba nacitat tagy modelu, inak ich neeviduje, neviem preco
		$this->post->tags;
		
		// pred samotnym vymazanim clanku musime vymazat lajky clanku a komentarov
		// pretoze s clankom sa vymazu aj vsetky jeho komentare
		$this->deleteLikes($this->post->id);

		// vymazeme post
		$this->post->delete();
		// vymazeme obrazok clanku
		$this->deletePhoto($this->post);

		// pri vymazani postu sa vyvola event, prejde tagy a kategorie, ktore
		// neprisluchaju ziadnemu postu a vymaze ich
        event(new PostDeleted($this->post));
	}

	// zabezpecuje vytvaranie novych tagov k clanku
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

	public function deleteLikes($post_id) {
		\App\Like::whereIn('likeable_id', function($query) use ($post_id) {
            $query->select('id')
                  ->from('comments')
                  ->where('post_id', $post_id);
        })->orWhere('likeable_id', $post_id)->delete();
	}

}