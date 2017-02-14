{{-- zoznam kategorii clankov --}}
<section class="categories-list">
    {{-- row --}}
    <div class="row">
        <div class="col-lg-12">
            {{-- napdis --}}
            <h3 class="title title-marker">Kategorie</h3>
            {{-- zoznam kategorii --}}
            <ul>
                @foreach($postsCategories as $category)
                    <li>
                        {{-- nazov kategorie --}}
                        <span class="glyphicon glyphicon glyphicon-chevron-right"></span>&nbsp<a href="{{ url('category', $category->id) }}">{{ $category->name }}</a>
                        {{-- pocet clankov v danej kategorii --}}
                        <span class="badge pull-right" title="Počet článkov kategórie">
                            {{ $category->countPosts }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>{{-- row --}}
</section>{{-- kategorie --}} 