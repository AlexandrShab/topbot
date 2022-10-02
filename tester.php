<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/autoload.php';
        $player_id = 334;
        
        $kol_kc = 0;
        $db = new Connect;
        $query = "SELECT * FROM kc_list ORDER BY id DESC";// В порядку обратном добавлению кс
        $data = $db->prepare($query);
        $data->execute();
        while ($out_data = $data->fetch(PDO::FETCH_ASSOC)){
            $kc_table_data[] = $out_data;
        }    
            if(!$kc_table_data) return false;
            if(!$kol_kc or (count($kc_table_data) < $kol_kc)) $kol_kc = count($kc_table_data);

        for ($i = 0; $i < $kol_kc; $i++)
        {   
            $kc_name = $kc_table_data[$i]['name'];
            $table = $kc_table_data[$i]['table_name'];
            
            $query = "SELECT * FROM $table WHERE player_id = $player_id LIMIT 1;";
            $data = $db->prepare($query);
            $data->execute();
            $kc_data = $data->fetch(PDO::FETCH_ASSOC);
            
            if ($kc_data)
            {   
                $resy = [];
                $kc_data = array($kc_data['res_1'],$kc_data['res_2'],$kc_data['res_3'],$kc_data['res_4']);
                foreach($kc_data as $key=>$val)
                {
                    if(($val != null) || ($val > 0))
                    {
                        $resy[] = $val;
                    }
                }
                $arr['kc_name'] = $kc_name;
                $arr['results'] = $resy;
                $all_kc_data[] = $arr;
            }
            
        }
            if(!$all_kc_data) return false;
            
            var_dump($all_kc_data);
            for ($i=0;$i<$kol_kc;$i++)
            {
                $kc = $all_kc_data[0]['results'];
                echo '<pre>';
                var_dump($kc);
                echo '</pre>'; 
                $sum = 0;
                
                foreach($kc as $val)
                {
                    $sum += $val;

                }
                $avg = $sum/count($kc);
            echo intval($avg);
            
            }
            





            return $all_kc_data;