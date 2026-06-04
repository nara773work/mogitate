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
    <aside class="aside">
        <h1>商品一覧</h1>
        <form action="search" method="get">
            <input class="search" type="text" name="name" placeholder="商品名で検索"><br>
            <button class="submit" type="submit">検索</button>
            <div>
                <form action="" method="get">
                    <select name="" id="">
                        <option value="" disabled selected>並び替えを選択</option>
                        <option value="DESC">高い順に表示</option>
                    </select>               
                </form>
            </div>
        </form>
    </aside>

    <div class="wrap_img">
        @foreach($products as $item)
        <div class="card">
            <img class="img" src="{{ asset($item->image) }}"><br>
            {{$item->name}}
            ￥{{$item->price}} 
        </div>
        @endforeach
    </div>
</div>
    
<div class="page">
    {{ $products->links('pagination::semantic-ui') }}
</div>
</div>
</body>
</html>