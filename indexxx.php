<?php
echo 'Hello!<br/>';
$teamnames = ['Team1','Team2','Team3','Team4','Team5','Team6'];
$output = count($teamnames) ; 
echo'Count teams: '. $output . '<br/>';
for($i=0; $i < count($teamnames); $i++){ 
    $idx = $i+1;
    echo 'idx = '.$idx;
    $teamName = $teamnames['1'];
    echo $teamName;
    echo "<option value=\"$idx\">$teamName</option>";
}
echo $output;