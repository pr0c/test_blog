<html>
<div class="search-bar">
    <input id="keywords" type="text" placeholder="Search..." value="{{ $selectedKeywords }}" onchange="searchArticle()">
</div>
<div class="page">
    <div class="sidebar">
        <div class="filter-block">
            <div class="filters">
                <div class="title">Categories</div>
                @foreach($categories as $category)
                <div class="filter">
                    <span>{{ $category->title }}</span>
                    <input type="checkbox" name="categories[]" {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }} value="{{ $category->id }}" onchange="searchArticle()">
                </div>
                @endforeach
            </div>
        </div>
        <div class="filter-block">
            <div class="filters">
                <div class="title">Tags</div>
                @foreach($tags as $tag)
                    <div class="filter">
                        <span>{{ $tag->title }}</span>
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }} onchange="searchArticle()">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="content">
        <div class="articles">
            @foreach($articles as $article)
                <div class="article">
                    <div class="title">{{ $article->category->title }} | {{ $article->title }}</div>
                    <div class="description">{{ $article->description }}</div>
                    <div class="tags">Tags:
                        @foreach($article->tags as $tag)
                        <span>{{ $tag->title }}</span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    html, body {
        padding: 0;
        margin: 0;
    }

    .page {
        display: flex;
        flex-direction: row;
        margin-top: 10px;
    }

    .sidebar {
        margin: 5px;
    }

    .articles {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }

    .article {
        flex: 1 1 auto;
        border: 1px solid #d3d3d3;
        text-align: center;
        margin: 5px;
        width: 350px;
    }

    .article .title {
        padding: 5px;
        border-bottom: 1px solid rgba(211, 211, 211, 0.3);
    }

    .article .tags {
        border-top: 1px solid #d3d3d3;
    }

    .article .description {
        padding: 15px;
    }

    .search-bar {
        display: flex;
        flex-direction: row;
        justify-content: center;
        width: 97%;
        border: 1px solid #d3d3d3;
        padding: 10px;
        margin: 0 auto;
    }

    .search-bar input {
        width: 90%;
        padding: 4px;
    }

    .filter-block {
        border: 1px solid #d3d3d3;
        width: 150px;
    }

    .filters {
        display: flex;
        flex-direction: column;
    }

    .filters .title {
        border-bottom: 1px solid #d3d3d3;
        padding: 5px;
    }

    .filters .filter {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding-left: 5px;
        padding-right: 5px;
    }

    .filter-block:not(:first-child) {
        margin-top: 10px;
    }
</style>

<script>
    function getCategories() {
        let categories = [...document.getElementsByName('categories[]')];
        let selectedCategories = [];
        for(let i = 0; i < categories.length; i++) {
            if(categories[i].checked) selectedCategories.push(categories[i].value);
        }

        return selectedCategories;
    }

    function getTags() {
        let tags = [...document.getElementsByName('tags[]')];
        let selectedTags = [];
        for(let i = 0; i < tags.length; i++) {
            if(tags[i].checked) selectedTags.push(tags[i].value);
        }

        return selectedTags;
    }

    function searchArticle() {
        let url = location.protocol + '//' + location.host + location.pathname;
        if(url.indexOf('?') == -1) url += '?';

        let categories = getCategories();
        for(i = 0; i < categories.length; i++) {
            url += '&categories[]='+categories[i];
        }

        let tags = getTags();
        for(i = 0; i < tags.length; i++) {
            url += '&tags[]='+tags[i];
        }

        let keywords = document.getElementById('keywords').value;
        if(keywords.length > 0) {
            url += '&keywords='+keywords;
        }

        window.location.href = url;
    }
</script>
