<?php 
define('MEMORY_TO_ALLOCATE', '100M');
define('DEFAULT_QUALITY', 100);
define('CURRENT_DIR', dirname(__FILE__));
define('CACHE_DIR_NAME', '/imagecache/');
define('CACHE_DIR', CURRENT_DIR . CACHE_DIR_NAME);

    include('phpgraphlib.php');
    $graph = new PHPGraphLib(600,300);

    $data1 = unserialize(urldecode(stripslashes($_GET['mydata1'])));

    $line1 = array_column($data1, 'line1');
    $line2 = array_column($data1, 'line2');


    $graph->addData($line1,$line2);
    //$graph->setTitle('bloodsugar');
    $graph->setBars(false);
    //$graph->setGrid(false);
    $graph->setGridColor("238, 238, 238");
    $graph->setLine(true);
    $graph->setDataPoints(true);
    $graph->setDataPointColor('160,160,160');
    $graph->setDataValues(true);
    $graph->setDataValueColor('0,0,0');
    $graph->setGoalLine(.0025);
    $graph->setGoalLineColor('red');
    $graph->setLineColor("255, 167, 78", "67, 162, 255","blue");
    //$graph->setLegend(true);
    //$graph->setLegendTitle("Apples", "Pears");
    $graph->createGraph();


?>