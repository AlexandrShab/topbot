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
        $query = "SELECT max(id) FROM kc_list;";
        $data = $db->prepare($query);
        $data->execute();
        $id = $data->fetch(PDO::FETCH_ASSOC);

        $table = 'kc_0' . $id['max(id)'];
        $query = "INSERT INTO kc_list (name, table_name) VALUES ('$name', '$table');";
        //print_r($query);
        $data = $db->prepare($query);
        $data->execute();
        echo $table;
        $query = "CREATE TABLE `$table` (
            `id` INT(10) NOT NULL AUTO_INCREMENT,
            `player_id` INT(10) NOT NULL,
            `res_1` INT(10) NULL DEFAULT NULL,
            `res_2` INT(10) NULL DEFAULT NULL,
            `res_3` INT(10) NULL DEFAULT NULL,
            `res_4` INT(10) NULL DEFAULT NULL,
            PRIMARY KEY (`id`) USING BTREE
        )
        COLLATE='utf8mb4_bin'
        ENGINE=InnoDB
        ;";
        $data = $db->prepare($query);
        $data->execute();
        return true;
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
}
