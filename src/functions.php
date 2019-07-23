<?php
/**
 * Задание #1
 *
 * @param string $fileName
 */

function task1($fileName)
{
    ob_start();
    $data = simplexml_load_file($fileName);

    foreach ($data->attributes() as $attr) {
        echo $attr->getName() . ': ' . $attr . PHP_EOL . PHP_EOL;
    }

    foreach ($data->Address as $key => $val) {
        echo $val->getName() . PHP_EOL;
        echo $val->attributes()->getName() .': ' . $val->attributes()->Type  . PHP_EOL;
        echo  $val->Name->getName() . ': ' . $val->Name->__toString() . PHP_EOL;
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
    $content = ob_get_contents();
    ob_end_clean();
    echo nl2br($content);
}