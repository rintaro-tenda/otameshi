<?php

const FIRST_ONION_DISCOUNT_NUMBER = 3;
const FIRST_ONION_DISCOUNT_PRICE = 50;
const SECOND_ONION_DISCOUNT_NUMBER = 5;
const SECOND_ONION_DISCOUNT_PRICE = 100;

const SET_DISCOUNT_PRICE = 20;

const BENTO_DISCOUNT_START_TIME = '20:00';

const TAX = 10;
const PRICES = [
    1 => ['price' => 100, 'type' => ''],
    2 => ['price' => 150, 'type' => ''],
    3 => ['price' => 200, 'type' => ''],
    4 => ['price' => 350, 'type' => ''],
    5 => ['price' => 180, 'type' => 'drink'],
    6 => ['price' => 220, 'type' => ''],
    7 => ['price' => 440, 'type' => 'bento'],
    8 => ['price' => 380, 'type' => 'bento'],
    9 => ['price' => 80, 'type' => 'drink'],
    10 => ['price' => 100, 'type' => 'drink'],
];

function calc(string $time, array $items): int
{
    $drink = 0;
    $bento = 0;
    $totalAmount = 0;
    $bentoAmount = 0;
    foreach($items as $item){
        $totalAmount += PRICES[$item]['price'];
        if(PRICES[$item]['type'] === 'drink'){
            $drink++;
        }

        if(PRICES[$item]['type'] === 'bento'){
            $bento++;
            $bentoAmount += PRICES[$item]['price'];
        }
    }

    $totalAmount -=discountOnion(array_count_values($items)[1]);
    $totalAmount -=discountSet($drink, $bento);
    $totalAmount -=discountBento($time, $bentoAmount);

    return $totalAmount * (100 + TAX) / 100;
}

function discountOnion(int $number): int
{
    $discount = 0;
    if ($number >= SECOND_ONION_DISCOUNT_NUMBER) {
        $discount = SECOND_ONION_DISCOUNT_PRICE;
    } elseif ($number >= FIRST_ONION_DISCOUNT_NUMBER) {
        $discount = FIRST_ONION_DISCOUNT_PRICE;
    }

    return $discount;
}

function discountSet(int $drinkNumber, int $bentoNumber): int
{
    return SET_DISCOUNT_PRICE * min([$drinkNumber, $bentoNumber]);
}

function discountBento(string $time, int $bentoAmount): int
{
    if (strtotime(BENTO_DISCOUNT_START_TIME) > strtotime($time)){
        return 0;
    }

    return $bentoAmount / 2;
}
// 購入した商品番号の入った配列をforeach文を使い、番号ごとに処理を書いていく。処理は関数をしてまとめる

// 1.玉ねぎの処理
// 配列の中で弁当、飲み物、野菜でキーを設定する
// 処理を通した後の購入合計金額（税込）を求める

// タスク分解した時のメイン処理から書いていく。大きな処理内容（分けられそうなもの）があった場合は別関数を作る。その際に使った意味のある数値は定数化して後から見やすくする

// 処理でどのような値が出力されるか気になったらデバック機能を起動→特定の場所にブレークポイント→composer phpunit→特定のメソッドとやらをデバックコンソールにて打ってみる
