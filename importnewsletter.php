<?php
use Magento\Framework\App\Bootstrap;
require __DIR__ . '/app/bootstrap.php';
$store_id = 1;
$csv_filepath = "M2.csv";
$csv_delimiter = ',';
$csv_enclosure = '"';
$magento_path = __DIR__;

$params = $_SERVER;

$bootstrap = Bootstrap::create(BP, $params);

$obj = $bootstrap->getObjectManager();

$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');

$row = 1;
if (($handle = fopen("M2.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    echo "<p> $num fields in line $row: <br /></p>\n";
    $row++;
    for ($c=0; $c < $num; $c++) {
        $status = $obj->create('Magento\Newsletter\Model\Subscriber')->subscribe($data[$c]);
        echo $data[$c] . "<br />\n";
    }
  }
  fclose($handle);
}
?>
