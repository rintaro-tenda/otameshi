<?php

// タスク分解する

// 入力値を取得する関数(テレビのチャンネル 視聴分数と入力した時、配列に格納)
const SPLIT_LENGTH = 2;

function getInput(array $argv)
{
    // CLIでスクリプトに渡された引数の配列
    $argument = array_slice($argv, 1); //配列で１以降が取れる //配列 切り取る php
    // チャンクごとに分ける（テレビのチャンネル 視聴分数、。。。）
    // [[1, 30], [5, 25], ...]
    return array_chunk($argument, SPLIT_LENGTH); //配列を２つずつでまとめて配列を作る //php 配列 まとめる
}

// チャンネルごとの視聴回数と視聴分数を算出する
function groupChannelViewingPeriods(array $inputs): array
{
    $channelViewingPeriods = [];
    foreach ($inputs as $input) {
        $chan = $input[0];
        $min = $input[1];
        $mins = [$min]; // 視聴分数を数える行為を数えることで視聴回数を導出
        //チャンネルが複数登場した場合を考える
        if (array_key_exists($chan, $channelViewingPeriods)) {
            $mins = array_merge($channelViewingPeriods[$chan], $mins);
        }

        $channelViewingPeriods[$chan] = $mins; //キーに$mins配列を入れる[ch => [min, min], ch => [min, min], ...]
    }
    return $channelViewingPeriods;
}

// テレビの合計視聴時間を算出する関数について
function caluculateTotalHour(array $channelViewingPeriods): float
{
    $viewingTimes = [];
    foreach ($channelViewingPeriods as $period) {
        $viewingTimes = array_merge($viewingTimes, $period);
    }
    $totalMin = array_sum($viewingTimes);

    //array_sum(array_merge(...$channelViewingPeriods)); で上記の処理も可能

    return round($totalMin / 60, 1);
}

function display(array $channelViewingPeriods): void
{ //void 何も値を返さないの意味
    $totalHour = caluculateTotalHour($channelViewingPeriods);
    echo $totalHour . PHP_EOL;
    foreach ($channelViewingPeriods as $chan => $mins) {
        echo $chan . ' ' . array_sum($mins) . ' ' . count($mins) . PHP_EOL;
    }
}



// データ構造を決める
// 入力値を取得する
$inputs = getInput($_SERVER['argv']);
// データを処理しやすい形に変換する
// 合計時間を算出する
// チャンネルごとの視聴回数と視聴分数を算出する
$channelViewingPeriods = groupChannelViewingPeriods($inputs);
// 表示する
display($channelViewingPeriods);
