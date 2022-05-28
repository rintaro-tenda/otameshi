<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . "/../lib/ViewingTimes2.php");

class ViewingTimesTest extends TestCase
{
    public function test()
    {
        // expectOutputStringメソッドの引数でとった変数($output)が宣言したもの($output)と同じであるとテストが通った事になる
        $output = <<<EOD
        1.7
        1 45 2
        5 25 1
        2 30 1

        EOD;
        $this->expectOutputString($output);

        $inputs = getInput(['file', '1', '30', '5', '25', '2', '30', '1', '15']);
        // データを処理しやすい形に変換する
        // 合計時間を算出する
        // チャンネルごとの視聴回数と視聴分数を算出する
        $channelViewingPeriods = groupChannelViewingPeriods($inputs);
        // 表示する
        display($channelViewingPeriods);
    }
}
