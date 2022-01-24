<?php
$weight_list = [
    'カレーライス' => 25,
    'さんまの塩焼き' => 25,
    'チャーハン' => 25,
    'オムレツ' => 25,
];

$result_number = random_int(1, array_sum($weight_list));// 1~100

$total_weight = 0;
foreach ($weight_list as $name => $weight)
{
    $total_weight += $weight;
    if ($result_number <= $total_weight)
    {
        $result = $name;
        break;
    }
}

echo "<script>alert('$result');</script>";
//var_dump($result);
exit;
?>
