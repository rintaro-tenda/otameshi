<?php

const HIGH_CARD = 'high card';
const PAIR = 'pair';
const STRAIGHT = 'straight';

const CARDS = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
// 以下は２点が最低点でそこから点数が上がっていく配列
// 下記の$cardRanks[$card] = $index;　で以下のようになる
// CARD_RANK = [
//     "2" => 0,
//     "3" => 1,
//     "4" => 2,
// ]

const HAND_RANK = [
    HIGH_CARD => 1,
    PAIR =>2,
    STRAIGHT => 3,
];
define('CARD_RANK', (function(){
    $cardRanks = [];
    foreach (CARDS as $index => $card){
        $cardRanks[$card] = $index;
    }
    return $cardRanks;
})());

// 各プレイヤーがカードを2枚取り、それぞれを引数に入れると役をそれぞれ判定、勝利P番号
function showdown(string $card11, string $card12, string $card21, string $card22): array
{
    # カードをランクに変換する関数を作っておく
    $cardRanks = convertToCardRanks([$card11, $card12, $card21, $card22]);
    # 各役を判定する
    $playerCardsRanks = array_chunk($cardRanks, 2);
    $hands = array_map(fn ($playerCardRank) => checkHand($playerCardRank[0], $playerCardRank[1]),
    $playerCardsRanks);
    $winner = decideWinner($hands[0], $hands[1]);
    # 勝者を判定する
    return [$hands[0]['name'], $hands[1]['name'], $winner];
}

function convertToCardRanks(array $cards): array
{
    return array_map(fn ($card) => CARD_RANK[substr($card, 1, strlen($card) - 1)], $cards);
}

function checkHand(int $cardRank1, int$cardRank2): array
{
    $primary = max($cardRank1, $cardRank2);
    $secondary = min($cardRank1, $cardRank2);
    $name = HIGH_CARD;

    if (isStraight($cardRank1, $cardRank2)){
        $name = STRAIGHT;
        if (isMinMax($cardRank1, $cardRank2)){
            $primary = min(CARD_RANK);
            $secondary = max(CARD_RANK);
        }
    }elseif (isPair($cardRank1, $cardRank2)) {
        $name = PAIR;
    }

    return [
        'name' => $name,
        'rank' => HAND_RANK[$name],
        'primary' => $primary,
        'secondary' => $secondary,
    ];
}

function isStraight(int $cardRank1, int $cardRank2): bool
{ //なぜここでisMinMaxを使うのか
    return abs($cardRank1 - $cardRank2) === 1 || isMinMax($cardRank1, $cardRank2);
}

function isMinMax(int $cardRank1, int $cardRank2): bool
{
    return abs($cardRank1 - $cardRank2) === (max(CARD_RANK) - min(CARD_RANK));
}

function isPair(int $cardRank1, int $cardRank2): bool
{
    return $cardRank1 === $cardRank2;
}

function decideWinner(array $hand1, array $hand2): int
{
    foreach (['rank', 'primary', 'secondary'] as $k) {
        if ($hand1[$k] > $hand2[$k]){
            return 1;
        }

        if ($hand1[$k] < $hand2[$k]) {
            return 2;
        }
    }

    return 0;
}
