<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/error.css') }}">
    <title>Productregister</title>
</head>
<body>
<header class="header">
    mogitate
</header>
<div class="main">
    <form action="/products/store" method="post" enctype="multipart/form-data">
    @csrf
    <h1>商品登録</h1>
    <span>商品名</span>　<span class="required">必須</span>
    @error('name')
    <span class="error">{{ $message }}</span>
    @enderror<br>
    <input class="text" type="text" name="name" placeholder="商品名を入力"><br>

    値段 　<span class="required">必須</span>
    @error('price')
    <span class="error">{{ $message }}</span>
    @enderror<br>
    <input class="text" type="text" name="price" placeholder="値段を入力"><br>

    商品画像　<span class="required">必須</span>
    @error('image')
    <span class="error">{{ $message }}</span>
    @enderror<br>
    <input class="text" type="file" name="image" ><br>

    季節　<span class="required">必須</span>
    <span style="color:red;font-size:12px">複数選択可能</span><br>
    @error('season_ids')
    <span class="error">{{ $message }}</span>
    @enderror
    @foreach($seasons as $season)
        <input type="checkbox" value="{{ $season->id }}"  name ="season_ids[]">                
        {{ $season->name }}
    @endforeach<br>

    商品説明　<span class="required">必須</span>
    @error('description')
    <span class="error">{{ $message }}</span>
    @enderror<br>
    <textarea class="textarea" name="description" id="" placeholder="商品の説明を入力"></textarea>
</div>

<div class="wrap_return_update">
    <div>
        <button type="submit" class="update" >登録</button>
    </form>
    </div>    
    <div>
        <form action="/products" method="get">
        <button type="submit" class='back'>戻る</button>
        </form>
    </div>
</div>
</body>
</html>