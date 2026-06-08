<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/error.css') }}">
    <title>Productdetail</title>
</head>
<body>
<header class="header">
    mogitate
</header>

<div class="main">
    <form action="/products/{{$product->id}}/update" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
        <input type="hidden" name="id" value="{{ $product->id }}">
        <div class="wrap_name_price_season">
            <div>
                <img class="img" src="{{ asset($product->image) }}"><br>
                <input type="file" name="image" >
            </div>
            

            <div>
                <div class="circle_wrap_text">
                    商品名
                    <div>
                        <input type="text" value="{{$product->name}}" name="name" class="text">
                        @error('name')
                        <span class="error">{{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="circle_wrap_text">
                    値段
                    <div>
                        <input type="text" value="{{$product->price}}"  name="price" class="text"> 
                        @error('price')
                        <span class="error">{{ $message }}
                        @enderror         
                    </div>
                </div>

                <div class="circle_wrap">
                    季節<br>
                    @foreach($seasons as $season)
                        <input type="checkbox" value="{{ $season->id }}" name="season_ids[]" {{ $product->seasons->contains($season->id) ? 'checked' : '' }}>
                            
                        {{ $season->name }}
                    @endforeach   
                    @error('season_ids')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>           
            </div>
        </div>  

        <div class="circle_sentence_wrap">
            商品説明
                <div>
                    <textarea class="circle_sentence" name="description" id="">{{$product->description}}</textarea>
                    @error('description')
                    <span class="error">{{ $message }}
                    @enderror
                </div>
        </div>

        <div class="wrap_button">
            <div class="wrap_return_update">
                <div>
                    <button type="submit" class="update" >変更を保存</button>
                </div>    
    </form>
                <div>
                    <form action="/products" method="get">
                    <button type="submit" class='back'>戻る</button>
                    </form>
                </div>
            </div>
            
            <div>
                <form action="/products/{{$product->id}}/delete" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">🗑️</button>
                </form>
            </div> 
        </div>   
</div>            
</body>
</html>