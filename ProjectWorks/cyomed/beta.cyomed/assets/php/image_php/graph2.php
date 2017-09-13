<?php 

    include('phpgraphlib.php');
    $graph = new PHPGraphLib(600,300);

    $data2 = unserialize(urldecode(stripslashes($_GET['mydata2'])));

    $line1 = array_column($data2, 'line1');
    $line2 = array_column($data2, 'line2');
    $line3 = array_column($data2, 'line3');


    $graph->addData($line1,$line2,$line3);
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
    $graph->setLineColor("255, 167, 78", "67, 162, 255","255, 51, 2555");
    //$graph->setLegend(true);
    //$graph->setLegendTitle("Apples", "Pears");
    $graph->createGraph();


?>