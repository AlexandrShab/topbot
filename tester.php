<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/autoload.php';


        $top_players['0'] = ['player_id'=> 0];
        $db = new Connect;
        $query = "SELECT table_name FROM kc_list ORDER BY id DESC LIMIT 5";
         $data = $db->prepare($query);
        $data->execute();
        while ($out_data = $data->fetch(PDO::FETCH_ASSOC)){
            $kc_tables[] = $out_data;
        }    
        
        //echo "<pre>";    var_dump($kc_tables);
        $base = new BaseAPI;
        $teamNames = $base->getTeamNames();//array
        //var_dump($teamNames);

        for($i=0;$i<count($kc_tables);$i++){//,kc_024.res_2,kc_024.res_3,kc_024.res_4
            $table_name = $kc_tables[$i]['table_name'];
            //echo "$table_name <br/>";
            for($res=1;$res<5;$res++)
            {
              for($team_n=0;$team_n<count($teamNames);$team_n++)
              {
                $team_id = $taem_n + 1;
                $db = new Connect;
                $query = "SELECT players.id, players.name, players.team
                FROM players JOIN $table_name ON players.id=$table_name.player_id 
                WHERE players.team=$team_id AND players.present=1
                ORDER BY $table_name.res_$res
                DESC LIMIT 3;";
               //echo "$query <br/>";
                $data = $db->prepare($query);
                $data->execute();
                while ($out_data = $data->fetch(PDO::FETCH_ASSOC))
                {
                    
                    for ($j=0;$j<count($top_players);$j++)
                    {
                        var_dump($out_data);echo "<br/><br/>";
                        if ($out_data['player_id'] == $top_players[$j]['player_id'])
                        {
                           $top_players[$j]['kol_top3'] ++;
                        } else $top_players[] = $out_data;
                    }
                }
              }
            }  
        }
        echo "<pre>";
         var_dump($top_players);
      
        //echo "Количество попаданий в TOP 3 среди игроков команды: $kol_top3 раз(а)";
       /* header('Content-Type: application/json');
        print_r(json_encode($result));*/
   
    