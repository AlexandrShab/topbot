<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/mysql.php';
 
$inputJSON = file_get_contents('php://input');
if ($inputJSON) {
  //print_r($inputJSON);
  $input = json_decode($inputJSON, TRUE);
    //print_r(json_encode($input));
    //print_r($input);
    /*
        {
          "player_id": 2
        }
    */
      if(isset($input['player_id']))
      {
        $player_id = $input['player_id'];
        $db = new Connect;
        $query = "SELECT team FROM players WHERE id=$player_id LIMIT 1";
        $data = $db->prepare($query);
        $data->execute();
        $team = $data->fetch(PDO::FETCH_ASSOC);
        $team = $team['team'];
 
        $kol_top3 = 0;
        $db = new Connect;
        $query = "SELECT table_name FROM kc_list ORDER BY id DESC LIMIT 5";
         $data = $db->prepare($query);
        $data->execute();
        while ($out_data = $data->fetch(PDO::FETCH_ASSOC)){
            $kc_tables[] = $out_data;
        }    
        
        //echo "<pre>";    var_dump($kc_tables);
        for($i=0;$i<count($kc_tables);$i++){//,kc_024.res_2,kc_024.res_3,kc_024.res_4
            $table_name = $kc_tables[$i]['table_name'];
            //echo "$table_name <br/>";
            for($res=1;$res<5;$res++)
            {
                $db = new Connect;
                $query = "SELECT players.id
                FROM players JOIN $table_name ON players.id=$table_name.player_id 
                WHERE players.team=$team AND players.present=1
                ORDER BY $table_name.res_$res
                DESC LIMIT 3;";
               //echo "$query <br/>";
                $data = $db->prepare($query);
                $data->execute();
                while ($out_data = $data->fetch(PDO::FETCH_ASSOC)){
                   // var_dump($out_data);
                    if($out_data['id'] == $player_id)
                    { 
                        
                        $kol_top3++;
                        break;
                    }
                }

            }  
        }
        $result = [];
        $result['kol_top3'] = $kol_top3;
        //echo "Количество попаданий в TOP 3 среди игроков команды: $kol_top3 раз(а)";
        header('Content-Type: application/json');
        print_r(json_encode($result));
       
    

      }
}