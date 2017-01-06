<?php

// domovska stranka: home/
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', url('/'));
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

// editacia profilu prihlaseneho uzivatela: home/profil/uprava profilu
Breadcrumbs::register('editMyProfile', function($breadcrumbs) {
    $breadcrumbs->parent('showMyProfile');
    $breadcrumbs->push('Úprava profilu', url('profile/edit'));
});

// profil konkretneho uzivatela: home/meno uzivatela
Breadcrumbs::register('showUser', function($breadcrumbs, $user) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($user->name, url('user', $user->id));
});

// vsetky kategorie: home/vsetky kategorie
Breadcrumbs::register('categories', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push("Všetky kategórie", route('category.index'));
});