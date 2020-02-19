<?php
/**
 * strictなコーディングをした方が、速度的にも早いということの証明
 */

// E_NOTICE を無視するエラーレベルでも速度に差は出る
// 無視しないレベルにするとより顕著になる
error_reporting(E_WARNING);

$counts = 1000000;

// 行儀の悪いコード
$start = microtime(true);
notStrict($counts);
$end = microtime(true);
echo sprintf("notStrict: %s sec\n", number_format($end - $start, 9));

// 行儀のいいコード
$start = microtime(true);
strict($counts);
$end = microtime(true);
echo sprintf("strict: %s sec\n", number_format($end - $start, 9));

/**
 * 行儀の悪いコード (E_NOTICE発生)
 * @param int $counts 実行回数
 */
function notStrict($counts)
{
    $arr = [];

    for ($i = 0; $i < $counts; $i++) {
        if ($arr['undefined'] === 'foo') {
            // do nothing
        }
    }
}

/**
 * 行儀のいいコード
 * @param int $counts 実行回数
 */
function strict($counts)
{
    $arr = [];

    for ($i = 0; $i < $counts; $i++) {
        if (isset($arr['undefined']) && $arr['undefined'] === 'foo') {
            // do nothing
        }
    }
}
