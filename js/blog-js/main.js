// hlavny js skript aplikacie
$(document).ready(function(){

	// navigacne menu
	var blogNavbar = $('.navbar-blog');

	// searchbar na dynamicke vyhladavanie clankov -> pouzitie kniznice selectize.js
	$('#searchbox').selectize({
		// atribut pouzity ako hodnota pri vybere zo zoznamu vysledkov
        valueField: 'url',
        // atribut pouzity ako label
        labelField: 'title',
        // vyhladavanie podla nazvu clanku
        searchField: ['title'],
        // maximalny pocet zobrazenych vysledkov
        maxOptions: 10,
        options: [],
        create: false,
        // vysledky vyhladavania zobrazime vo forme: foto clanku - nadpis clanku
        render: {
            option: function(item, escape) {
                	return '<div class = "search-result"><img src="'+root_dir+'/uploads/blog_photos/'+ item.blog_photo +'" class = "search-img"><a href = '+ item.url +'> '+ escape(item.title) +'</a></div>';
            }
        },
        // atribut, podla ktoreho sa zgrupuju vysledky
        optgroups: [
            {value: 'clanok', label: 'Clanky'},
        ],
        optgroupField: 'class',
        optgroupOrder: ['clanok'],
        // ajax volanie metody SearchController@index
        load: function(query, callback) {
        	// ak v inpute nie je zadane nic
            if (!query.length) return callback();
            $.ajax({
                url: root_dir+'/search',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        },
        onChange: function(){
            window.location = this.items[0];
        }
    });

	// fixnuty navbar pri zoskrolovani stranky
	function stickNavbar(){
		// ak je zoskrolovane viac ako 230px
		if($(this).scrollTop() > 230) {
			// skry cely header
			$('header').css('display', 'none');
			// navbaru pridaj triedu
			blogNavbar.addClass('navbar-scrolled');
		}
		// ak je zoskrolovane menej ako 230px
		else {
			blogNavbar.removeClass('navbar-scrolled');
			// navbaru odober triedu
			$('header').css('display', 'block');
		}
	};

	// volanie metody stickNavbar ihned po nacitani stranky
	// ak je na stranke zoskrolovane hned po nacitani stranky -> fixni navbar
	stickNavbar();
	// volanie metody stickNavbar pri skrolovani
	setActiveLink();

	$(window).scroll(stickNavbar);

	// dynamicka zmena aktivneho linku v navbare
	function setActiveLink(){
		// aktualna url-ka
		var url = window.location;

		// v zozname najdeme li element, ktory obsahuje link s danou url-kou, a pridame mu triedu 'active'
		// bude fungovat iba ak string v href atribute linku je totozny s url-kou
		$('ul.nav a[href="'+ url.href.slice(0,-1) +'"]').parent().addClass('active');

		// bude fungovat aj pre relativne a absolutne href atributy
		$('ul.nav a').filter(function() {
		    return this.href == url;
		}).parent().addClass('active');
	}

});