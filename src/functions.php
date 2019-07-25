<?php
/**
 * Задание #1
 *
 * @param string $fileName
 */

function task1($fileName)
{
    $data = simplexml_load_file($fileName);

    foreach ($data->attributes() as $attr) {
        echo $attr->getName() . ': ' . $attr . PHP_EOL . PHP_EOL;
    }

    foreach ($data->Address as $key => $val) {
        echo $val->getName() . PHP_EOL;
        echo $val->attributes()->getName() . ': ' . $val->attributes()->Type . PHP_EOL;
        echo $val->Name->getName() . ': ' . $val->Name->__toString() . PHP_EOL;
        $addr = [];
        $addr[] = $val->Street->__toString();
        $addr[] = $val->City->__toString();
        $addr[] = $val->State->__toString();
        $addr[] = $val->Zip->__toString();
        $addr[] = $val->Country->__toString();
        echo implode(', ', $addr) . PHP_EOL . PHP_EOL;
    }

    echo 'DeliveryNotes: ' . $data->DeliveryNotes->__toString() . PHP_EOL . PHP_EOL;

    foreach ($data->Items->Item as $item => $product) {
        echo $product->attributes()->getName() . ': ' . $product->attributes() . PHP_EOL;
        echo $product->ProductName->__toString() . ' ' . $product->Quantity->__toString() . ' pcs' . PHP_EOL;
        echo 'Price ' . $product->USPrice->__toString() . ' US$' . PHP_EOL;
        echo 'Comments: ' . $product->Comment->__toString() . PHP_EOL;
        echo 'Shipping Date: ' . $product->ShipDate->__toString() . PHP_EOL . PHP_EOL;
    }
}

/**
 * Задание #2
 * @param array $arr
 * @param string $fileNameBefore
 * @param string $fileNameAfter
 * @return
 */

function task2_1($arr, $fileNameBefore = 'output.json', $fileNameAfter = 'output2.json')
{
    $json = json_encode($arr);
    $handle = fopen($fileNameBefore, 'w');
    if (!$handle) {
        echo 'Не удалось создать файл ' . $fileNameBefore;
        return null;
    }
    if (!fwrite($handle, $json)) {
        echo "Не могу произвести запись в файл." . PHP_EOL;
        return null;
    }
    echo 'Запись в файл прошла успешно' . PHP_EOL;
    fclose($handle);

    $handle = fopen($fileNameAfter, 'w');
    if (!$handle) {
        echo 'Не удалось открыть файл ' . $fileNameBefore;
        return null;
    }

    if (rand(0, 20) < 10 ) {
        $str = file_get_contents($fileNameBefore);
        $tempArr = json_decode($str, true);
        shuffle($tempArr);
        $jsonNew = json_encode($tempArr);
    }
    if (isset($jsonNew)) {
        echo 'Данные изменены!' . PHP_EOL;
        $json = $jsonNew;
    }

    if (!fwrite($handle, $json)) {
        echo "Не могу произвести запись в файл." . PHP_EOL;
        return null;
    }
    fclose($handle);

    $beforeArr = json_decode(file_get_contents($fileNameBefore), true);
    $afterArr = json_decode(file_get_contents($fileNameAfter), true);

    $diffArr = array_diff_assoc ($beforeArr, $afterArr);
    return $diffArr;
}

/**
 * Задание #3
 *
 * @param int $amount
 * @param string $fileName
 * @return string
 */

function task3($amount, $fileName = 'temp.csv')
{
    $arr = [];
    for ($i = 0; $i < $amount; $i++) {
        $arr[$i] = (array)rand(1, 100);
    }
    $handle = fopen($fileName, 'w');
    if (!$handle) {
        echo 'Не удалось создать файл ' . $fileName;
        return null;
    }
    foreach ($arr as $row) {
        if (!fputcsv($handle, $row, ",")) {
            return null;
        };
    }
    echo 'Запись прошла успешно! ';
    fclose($handle);

    $ret = [];
    $handle = fopen($fileName, 'r');
    while ($str = fgetcsv($handle, 10000, ',')) {
        if ($str[0] % 2 == 0) {
            $ret[] = $str[0];
        }
    }
    fclose($handle);
    $sum = array_sum($ret);
    echo 'В массиве ' . count($ret) . ' четных чисел из ' . $amount . ' общей суммой ' . $sum . PHP_EOL;
    return $sum;
}

/**
 * Задание #4
 * @param string $link
 */

function task4_1($link)
{
    $json = file_get_contents($link);
    $data = json_decode($json, true);
    $idNum = $data['query']['pages']['15580374'];
    echo 'title: ' . $idNum['title'] . PHP_EOL;
    echo 'pageid: ' . $idNum['pageid'] . PHP_EOL;
}

function task4_2($link)
{
    $json = file_get_contents($link);
    $data = json_decode($json);
    $numOfSite = '15580374';
    echo 'title: ' . $data->query->pages->$numOfSite->title . PHP_EOL;
    echo 'pageid: ' . $data->query->pages->$numOfSite->pageid . PHP_EOL;
}