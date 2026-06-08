<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <title>ProductsIndex</title>
</head>
<body>
    <header class="header">
        mogitate
    </header>

<div class="wrap_aside_card">
    <div>
        <aside class="aside">
            <h1>商品一覧</h1>

            <form action="/products/search" method="get">
            <form action="" method="get">
                
                <input class="search" type="text" name="name" placeholder="商品名で検索"><br>
                <button class="submit" type="submit">検索</button><br>
                価格順に表示<br>

                <select name="sort" class="select">
                    <option value="" disabled selected hidden class="dashboard">価格で並び替え</option>
                    <option value="DESC" name="sort"  {{ request('sort') == 'DESC' ? 'selected' : '' }}>価格の高い順</option>
                    <option value="ASC" name="sort" {{ request('sort') == 'ASC' ? 'selected' : '' }}>価格の低い順</option>
                </select>

                @if(request()->filled('sort'))
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
            @endif

                
            </form>
        </aside>
    </div> 

    <div>
        <div style="position: relative; display: inline-block; width: 100%;">
            <div style="position: absolute; right: 60px;">
                <a class="add_product" href="/products/register">商品を追加</a>
            </div>
        
            <div class="wrap_img">
                @foreach($products as $product)
                <div class="card">
                    <form action="/products/detail/{{$product->id}}">
                    <button type="submit" class="detail">
                    <img class="img" src="{{ asset( $product->image) }}"><br>
                    {{$product->name}}
                    ￥{{$product->price}}
                    </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>    
    </div>
</div>
    
<div class="page">
    {{ $products->appends(request()->query())->links('pagination::semantic-ui') }}
</div>

<script>
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

    window.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        if ( urlParams.has('sort')) {
            toggleModal(true);
        }
        });
</script>
</body>
</html>