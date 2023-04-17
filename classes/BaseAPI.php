<?php
require_once __DIR__ . '/Connect.php';


class BaseAPI
{
    function getAllPlayers()
    {
        $db = new Connect;
        $players = array();
        $data = $db->prepare('SELECT * FROM players ORDER BY id');
        $data->execute();
        while ($OutputData = $data->fetch(PDO::FETCH_ASSOC)) {
            $players[$OutputData['id']] = array(
                'num'         => $OutputData['num'],
                'id'          => $OutputData['id'],
                'name'        => $OutputData['name'],
                'team'        => $OutputData['team'],
                'present'     => $OutputData['present'],
                'user_id'     => $OutputData['user_id'],
                'fname'       => $OutputData['fname'],
                'lname'       => $OutputData['lname'],
                'username'    => $OutputData['username'],
                'date_in'     => $OutputData['date_in'],
                'date_out'    => $OutputData['date_out'],
                'friend_link' => $OutputData['friend_link']
            );
        };

        return $players;
    }
    function getPresent()
    {
        $db = new Connect;
        $players = array();
        $data = $db->prepare("SELECT * FROM players WHERE present = 1 ORDER BY id ");
        $data->execute();
        while ($OutputData = $data->fetch(PDO::FETCH_ASSOC)) {
            $players[$OutputData['id']] = array(
                'num'         => $OutputData['num'],
                'id'          => $OutputData['id'],
                'name'        => $OutputData['name'],
                'team'        => $OutputData['team'],
                'present'     => $OutputData['present'],
                'user_id'     => $OutputData['user_id'],
                'fname'       => $OutputData['fname'],
                'lname'       => $OutputData['lname'],
                'username'    => $OutputData['username'],
                'date_in'     => $OutputData['date_in'],
                'date_out'    => $OutputData['date_out'],
                'friend_link' => $OutputData['friend_link']
            );
        };

        return $players;
    }
    function getDeleted()
    {
        $db = new Connect;
        $players = array();
        $data = $db->prepare("SELECT * FROM players WHERE present = 0 ORDER BY id ");
        $data->execute();
        while ($OutputData = $data->fetch(PDO::FETCH_ASSOC)) {
            $players[$OutputData['id']] = array(
                'num'         => $OutputData['num'],
                'id'          => $OutputData['id'],
                'name'        => $OutputData['name'],
                'team'        => $OutputData['team'],
                'present'     => $OutputData['present'],
                'user_id'     => $OutputData['user_id'],
                'fname'       => $OutputData['fname'],
                'lname'       => $OutputData['lname'],
                'username'    => $OutputData['username'],
                'date_in'     => $OutputData['date_in'],
                'date_out'    => $OutputData['date_out'],
                'friend_link' => $OutputData['friend_link']
            );
        };

        return $players;
    }
    function getPlayer($id)
    {
        $db = new Connect;
        $data = $db->prepare("SELECT * FROM players WHERE id ='$id'");
        $data->execute();
        $player = $data->fetch(PDO::FETCH_ASSOC);
        /*  {
            $player = array(
                'id'          => $OutputData['id'],
                'id'          => $OutputData['id'],
                'name'        => $OutputData['name'],
                'team'        => $OutputData['team'],
                'user_id'     => $OutputData['user_id'],
                'fname'       => $OutputData['fname'],
                'lname'       => $OutputData['fname'],
                'username'    => $OutputData['id'],
                'date_in'     => $OutputData['id'],
                'date_out'    => $OutputData['id'],
                'friend_link' => $OutputData['id']
            );
      }; */
        return $player;
    }

    function GetSkuList()
    {
        $db = new Connect;
        $arrSku = array();
        $data = $db->prepare('SELECT SKU FROM products');
        $data->execute();
        while ($OutputData = $data->fetch(PDO::FETCH_COLUMN)) {
            $arrSku[] = $OutputData;
        }

        return $arrSku;
    }

    function addPlayer($player)
    {
        $db = new Connect;
        $query = "INSERT INTO players (id, name, team, user_id, fname, lname, username, date_in, date_out, friend_link) VALUES ('$player->id', '$player->name', '$player->team', '$player->user_id', '$player->fname', '$player->lname', '$player->username', '$player->date_in', '$player->date_out', '$player->friend_link');";
        //print_r($query);
        $data = $db->prepare($query);
        $data->execute();
        return true;
    }

    function deleteRow($id)
    {
        $db = new Connect;
        $query = "DELETE FROM products WHERE id = $id;";
        //print_r($query);
        $data = $db->prepare($query);
        $data->execute();
        return true;
    }

    function updatePlayerParam($id, $param, $value)
    {
        $db = new Connect;
        $query = "UPDATE `players`  SET `$param`= $value WHERE id ='$id';";
        $data = $db->prepare($query);
        $data->execute();
        return true;
    }
    function addKc($name)
    {
         $db = new Connect;
        $query = "SELECT name FROM kc_list;";
        $data = $db->prepare($query);
        $data->execute();
        while ($output = $data->fetch(PDO::FETCH_ASSOC)) 
        {
            if ($output['name'] == $name) return "exist";
        }
        
        $db = new Connect;
        $query = "SELECT max(id) FROM kc_list;";
        $data = $db->prepare($query);
        $data->execute();
        $id = $data->fetch(PDO::FETCH_ASSOC);
        $id = intval($id['max(id)'])+1;
        $table = 'kc_0' . $id;
        $query = "INSERT INTO kc_list (name, table_name) VALUES ('$name', '$table');";
        //print_r($query);
        $data = $db->prepare($query);
        $data->execute();
        echo $table;
        $query = "CREATE TABLE `$table` (
            	`id` INT(10) NOT NULL AUTO_INCREMENT,
                `player_id` INT(10) NOT NULL REFERENCES `players` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
                `res_1` INT(10) NULL DEFAULT NULL,
                `res_2` INT(10) NULL DEFAULT NULL,
                `res_3` INT(10) NULL DEFAULT NULL,
                `res_4` INT(10) NULL DEFAULT NULL,
                PRIMARY KEY (`player_id`) USING BTREE,
                UNIQUE `id` (`id`) USING BTREE
            )
            COLLATE='utf8mb4_bin'
            ENGINE=InnoDB
            AUTO_INCREMENT=1
            ;";
        $data = $db->prepare($query);
        $data->execute();
        return true;
    }
    public function renameKS($name)
    {
       
       $db = new Connect;
        $query = "SELECT max(id) FROM kc_list;";
        $data = $db->prepare($query);
        $data->execute();
        $id = $data->fetch(PDO::FETCH_ASSOC);
        $id = intval($id['max(id)']);
        $tableWithResults = 'kc_0' . $id;
        
        $query = "UPDATE `kc_list` SET name ='$name' WHERE id='$id';";
        $data = $db->prepare($query);
        $data->execute();
        
        $query = "SELECT `name` FROM `kc_list`;";
        $data = $db->prepare($query);
        $data->execute();
        $names;
        while ($output = $data->fetch(PDO::FETCH_ASSOC)) {
            $names[] = $output;
        }
        $res = $names;
        return  $res;
    }
    public function saveVars($wurl,$names)
    {
        $db = new Connect;
        $query = "UPDATE `variables` SET name = 'boturl', value = '$wurl' WHERE num =1;";
        //print_r($query);
        $data = $db->prepare($query);
        $data->execute();
        //$query = "INSERT INTO variables (name, value) VALUES ('teamnames', '$names');";
        $query = "UPDATE `variables` SET name = 'teamnames', value = '$names' WHERE num =2;";
        //print_r($query);
        $data = $db->prepare($query);
        $data->execute();
        
        return true;
    }
    
    function getBotUrl()
    {
        $db = new Connect;
        $query = "SELECT value FROM `variables` WHERE name = 'boturl';";
        //print_r($query);
        $data = $db->prepare($query);
        $data->execute();
        $BOT_URL = $data->fetch(PDO::FETCH_OBJ);
        return $BOT_URL;
    }
   
    function getLastPlayerId()
    {
        $db = new Connect;
        
        $query = "SELECT MAX(id) FROM `players`";
       
        $data = $db->prepare($query);
        $data->execute();
        $lastId = $data->fetch(PDO::FETCH_ASSOC);
        return $lastId;
      
    }
    function getTeamNames()
    {
        $db = new Connect;
        $query = "SELECT value FROM `variables` WHERE name ='teamnames';";
        //print_r($query);
        $data = $db->prepare($query);
        $data->execute();
        $team_names = $data->fetch(PDO::FETCH_OBJ);
        return explode(',',$team_names->value);
    }
    function getUserById($id)
    {
        $base = new Connect;
        $query = "SELECT * FROM users WHERE id = $id LIMIT 1";
        
        $data = $base->prepare($query);
        $data->execute();
        return $data->fetch(PDO::FETCH_ASSOC);
    }
    
    function getAllUsers()
    {
        $base = new Connect;
        $query = "SELECT * FROM users";
        
        $data = $base->prepare($query);
        $data->execute();
        $arrUsers = array();
        while($user = $data->fetch(PDO::FETCH_OBJ))
        {
            $arrUsers[] = $user;
        }
        return $arrUsers;
    }
    
     public function setAsAdmin($id)
    {
        $base = new Connect;
        $query = "UPDATE `users` SET is_admin=1 WHERE id ='$id';";
        
        $data = $base->prepare($query);
        $data->execute();
        
        return true;
    }
    public function unsetAsAdmin($id)
    {
        $base = new Connect;
        $query = "UPDATE `users` SET is_admin=0 WHERE id ='$id';";
        
        $data = $base->prepare($query);
        $data->execute();
        
        return true;
    }
    function getKsTableName($ks_name)
    {
      $base = new Connect;
        $query = "SELECT table_name FROM kc_list WHERE name = '$ks_name' LIMIT 1;";
            
            $data = $base->prepare($query);
            $data->execute();
            $table_name = $data->fetch(PDO::FETCH_OBJ);
print_r($table_name->table_name);
            return $table_name->table_name;  
    }
    
    function saveKcResults($table_name, $res_num, $data)
    {
        $res_num = 'res_' . $res_num;
        $base = new Connect;
        
        foreach ($data as $num=>$player)
        {
            $id = $player['id'];
            $res = $player['res']; 
            $query = "INSERT INTO $table_name (player_id, $res_num) 
            VALUES('$id', '$res') ON DUPLICATE KEY UPDATE $res_num = '$res';";
            
            $data = $base->prepare($query);
            $data->execute();   
        }
        return true;
    }
    function saveGarages($garsArr)
    {
        $base = new Connect;
        
        foreach($garsArr as $gar)
        {
            $player_id = $gar['player_id'];
            $date = $gar['date'];
            $arrDate = explode('.', $date);
                $date = $arrDate[2] . '-' . $arrDate[1] .'-' . $arrDate[0];
            $garage = $gar['garage'];
            $query = "INSERT INTO garage (player_id, date, gar) 
                VALUES('$player_id','$date','$garage');";
            $data = $base->prepare($query);
            $data->execute(); 
        }
        return true;
    }
    function saveKm($kmsArr)
    {
        $base = new Connect;
        
        foreach($kmsArr as $chest)
        {
            $player_id = $chest['player_id'];
            $date = $chest['date'];
            $arrDate = explode('.', $date);
                $date = $arrDate[2] . '-' . $arrDate[1] .'-' . $arrDate[0];
            $km = $chest['km'];
            $query = "INSERT INTO chest (player_id, date, km) 
                VALUES('$player_id','$date','$km');";
            $data = $base->prepare($query);
            $data->execute(); 
        }
        return true;
    }
}
