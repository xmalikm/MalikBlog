<?php
/**
 *	Controller na live vyhladavanie clankov z databazi pouzitim ajaxu
 */
namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class SearchController extends Controller
{

	/**
	 *	apenduje url-ku clanku ako atribut post modelu
	 */
	public function appendURL($data, $prefix)
	{
		// premenna 'item', ktora je predavana odkazom, predstavuje atributy post modelu
		foreach ($data as $key => & $item) {
			if($prefix == 'post')
				// modelu pridame novy atribut 'url' -> co je url-ka k danemu clanku
				$item['url'] = url($prefix.'/'.$item['id'].'/'.$item['slug']);
		}
		return $data;		
	}

	/**
	 *	apenduje hodnotu ako atribut post modelu
	 */
	public function appendValue($data, $type, $element)	{
		// premenna 'item', ktora je predavana odkazom, predstavuje atributy post modelu
		foreach ($data as $key => & $item) {
			// modelu pridame novy atribut '$element' s hodnotou '$type'
			$item[$element] = $type;
		}
		return $data;		
	}

	/**
	 *	hlavna metoda, ktora sa vola pri ajax volani
	 */
	public function index()	{
		// string z inputu, podla ktoreho sa vyhladava
		$query = e(Input::get('q',''));

		// ak je input prazdny
		if(!$query && $query == '')
			return Response::json(array(), 400);

		// vyhladanie 10 clankov podla daneho stringu 
		$posts = Post::where('title','like','%'.$query.'%')
			->orderBy('title','asc')
			->take(10)
			->get(array('id', 'title', 'slug', 'blog_photo'))->toArray();

		// apendneme url-ku ako atribut post modelu
		$posts = $this->appendURL($posts, 'post');
		// apendneme novy atribut k post modelu
		$posts = $this->appendValue($posts, 'clanok', 'class');
		
		// vratime data ako json pole
		return Response::json(array(
			'data'=>$posts
		));
	}

}
