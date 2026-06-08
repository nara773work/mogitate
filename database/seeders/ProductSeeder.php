<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product1 = Product::create([
            'name' => 'キウイ',
            'price' => '800',
            'description' => 'キウイは甘みと酸味のバランスが絶妙なフルーツです。ビタミンCなどの栄養素も豊富のため、美肌効果や疲労回復効果も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
            'image' => 'storage/products/kiwi.png',
        ]);
        $product1->seasons()->attach([3, 4]);

        $product2 = Product::create([
            'name' => 'ストロベリー',
            'price' => '1200',
            'description' => '大人から子供まで大人気のストロベリー。当店では鮮度抜群の完熟いちごを使用しています。ビタミンCはもちろん食物繊維も豊富なため、腸内環境の改善も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
            'image' => 'storage/products/strawberry.png',
        ]);
        $product2->seasons()->attach([1]);

        $product3 = Product::create([
            'name' => 'オレンジ',
            'price' => '850',
            'description' => '当店では酸味と甘みのバランスが抜群のネーブルオレンジを使用しています。酸味は控えめで、甘さと濃厚な果汁が魅力の商品です。もぎたてフルーツのスムージをお召し上がりください！',
            'image' => 'storage/products/orange.png',
        ]);
        $product3->seasons()->attach([4]);

        $product4 = Product::create([
            'name' => 'スイカ',
            'price' => '700',
            'description' => '甘くてシャリシャリ食感が魅力のスイカ。全体の90％が水分のため、暑い日の水分補給や熱中症予防、カロリーが気になる方にもおすすめの商品です。もぎたてフルーツのスムージーをお召し上がりください！',
            'image' => 'storage/products/watermelon.png',
        ]);
        $product4->seasons()->attach([2]);

        $product5 = Product::create([
            'name' => 'ピーチ',
            'price' => '1000',
            'description' => '豊潤な香りととろけるような甘さが魅力のピーチ。美味しさはもちろん見た目の可愛さも抜群の商品です。ビタミンEが豊富なため、生活習慣病の予防にもおすすめです。もぎたてフルーツのスムージーをお召し上がりください！',
            'image' => 'storage/products/peach.png',
        ]);
        $product5->seasons()->attach([2]);

        $product6 = Product::create([
            'name' => 'シャインマスカット',
            'price' => '1400',
            'description' => '爽やかな香りと上品な甘みが特長的なシャインマスカットは大人から子どもまで大人気のフルーツです。疲れた脳や体のエネルギー補給にも最適の商品です。もぎたてフルーツのスムージーをお召し上がりください！',
            'image' => 'storage/products/muscat.png',
        ]);
        $product6->seasons()->attach([2, 3]);

        $product7 = Product::create([
            'name' => 'パイナップル',
            'price' => '800',
            'description' => '甘酸っぱさとトロピカルな香りが特徴のパイナップル。当店では甘さと酸味のバランスが絶妙な国産のパイナップルを使用しています。もぎたてフルーツのスムージをお召し上がりください！',
            'image' => 'storage/products/pineapple.png',
        ]);
        $product7->seasons()->attach([1, 2]);

        $product8 = Product::create([
            'name' => 'ブドウ',
            'price' => '1100',
            'description' => 'ブドウの中でも人気の高い国産の「巨峰」を使用しています。高い糖度と適度な酸味が魅力で、鮮やかなパープルで見た目も可愛い商品です。もぎたてフルーツのスムージーをお召し上がりください！',
            'image' => 'storage/products/grapes.png',
        ]);
        $product8->seasons()->attach([2, 3]);

        $product9 = Product::create([
            'name' => 'バナナ',
            'price' => '600',
            'description' => '低カロリーでありながら栄養満点のため、ダイエット中の方にもおすすめの商品です。1杯でバナナの濃厚な甘みを存分に堪能できます。もぎたてフルーツのスムージーをお召し上がりください！',
            'image' => 'storage/products/banana.png',
        ]);
        $product9->seasons()->attach([2]);

        $product10 = Product::create([
            'name' => 'メロン',
            'price' => '900',
            'description' => '香りがよくジューシーで品のある甘さが人気のメロンスムージー。カリウムが多く含まれているためむくみ解消効果も抜群です。もぎたてフルーツのスムージーをお召し上がりください！',
            'image' => 'storage/products/melon.png',
        ]);
        $product10->seasons()->attach([1, 2]);
    }
}
