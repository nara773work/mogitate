<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Index.css') }}">
    <title>ProductsI\ndex</title>
</head>
<body>
    <header class="header">
        mogitate
    </header>
<div class="wrap_aside_card">
    <div>
        <aside class="aside">
            <h1>商品一覧</h1>

            <form action="search" method="get" id="search-form">
                <input class="search" type="text" name="name" placeholder="商品名で検索"><br>
                <button class="submit" type="submit">検索</button><br>

                <button type="button" class="open" onclick="toggleModal(true)">
                    並び替え
                </button>

                <div id="sort-modal" class="overlay" onclick="toggleModal(false)">
                    <div class="content" onclick="event.stopPropagation()">
                    <div class="cancel_modal">
                        <label class="sort-option">
                        <input type="radio" name="sort" value="DESC" {{ request('sort') === 'DESC' ? 'checked' : '' }} onchange="submitWithModal()">
                        <span class="span">価格の高い順に表示</span>
                        </label>
                        <button type="submit" name="sort" value="clear" class="cancel" >×</button>
                    </div>
                    
                    <div class="cancel_modal">
                        <label class="sort-option">
                        <input type="radio" name="sort" value="ASC" {{ request('sort') === 'ASC' ? 'checked' : '' }} onchange="submitWithModal()">
                        <span class="span">価格の低い順に表示</span>
                        </label>  
                        <button type="submit" name="sort" value="clear" class="cancel" >×</button>
                    </div>
                    </div>
                </div>
            </form>
        </aside>
    </div>
<div class="wrap_img">
@foreach($products as $product)
    <div class="card">
    <img class="img" src="{{ asset($product->image) }}"><br>
        {{$product->name}}
        ￥{{$product->price}} 
    </div>
    @endforeach
</div> 
<div class="page">
    {{ $products->links('pagination::semantic-ui') }}
</div>

<script>
window.addEventListener('DOMContentLoaded', () => {
    const hasSort = @json(request()->has('sort'));  
    if (hasSort) {
        toggleModal(true);
    }
});

function toggleModal(show) {
    const modal = document.getElementById('sort-modal');
    if (show) {
        modal.classList.add('is-open');
    } else {
        modal.classList.remove('is-open');
    }
}

function submitWithModal() {
    document.getElementById('search-form').submit();
}
</script>
</body>
</html>