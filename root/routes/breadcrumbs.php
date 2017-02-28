<?php
/**
 *    breadcrumbs pre jednolive stranky
 */

// domovska stranka: home/
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', url('/'), ['icon' => 'home.png']);
});

// chybova stranka
Breadcrumbs::register('404error', function($breadcrumbs)
{
    $breadcrumbs->push('Stránka nenájdená', url('/'));
});

// cookies na stranke
Breadcrumbs::register('cookies', function($breadcrumbs)
{
    $breadcrumbs->push('Cookies na stránkach', url('/'));
});

// info o projekte
Breadcrumbs::register('projectInfo', function($breadcrumbs)
{
    $breadcrumbs->push('Informácie o projekte', url('/'));
});

// vsetky clanky: home/vsetky clanky/
Breadcrumbs::register('allPosts', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push("Všetky články", url('post'));
});

// konkretny clanok: home/vsetky clanky/meno clanku
Breadcrumbs::register('showPost', function($breadcrumbs, $post) {
    $breadcrumbs->parent('allPosts');
    $breadcrumbs->push($post->title, url('post', $post->id));
});

// uprava clanku: home/vsetky clanky/meno clanku/edit
Breadcrumbs::register('editPost', function($breadcrumbs, $post) {
    $breadcrumbs->parent('showPost', $post);
    $breadcrumbs->push('Úprava článku', route('post.edit', $post->id));
});

// vytvorenie noveho clanku: home/novy clanok
Breadcrumbs::register('createPost', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Nový článok', url('post/create'));
});

// profil prihlaseneho uzivatela: home/profil
Breadcrumbs::register('showMyProfile', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Môj profil', url('profile'));
});

// profil prihlaseneho uzivatela: home/profil
Breadcrumbs::register('showMyPosts', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Môje články', url('profile/my-posts'));
});

// editacia profilu prihlaseneho uzivatela: home/profil/uprava profilu
Breadcrumbs::register('editMyProfile', function($breadcrumbs) {
    $breadcrumbs->parent('showMyProfile');
    $breadcrumbs->push('Úprava profilu', url('profile/edit'));
});

// profil konkretneho uzivatela: home/meno uzivatela
Breadcrumbs::register('blogers', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push("Všetci blogery", url('blogers'));
});

// profil konkretneho uzivatela: home/meno uzivatela
Breadcrumbs::register('showUser', function($breadcrumbs, $user) {
    $breadcrumbs->parent('blogers');
    $breadcrumbs->push($user->name, url('user', $user->id));
});

// konkretna kategoria: home/kategoria
Breadcrumbs::register('category', function($breadcrumbs, $category) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($category->name, url('category', $category->id));
});

// konkretny tag: home/tag
Breadcrumbs::register('tag', function($breadcrumbs, $tag) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($tag->name, url('tag', $tag->id));
});