<?php
//require_once __DIR__ . '/mysql.php';

class Player
{
    public $num;
    public $id;
    public $name;
    public $team;
    public $user_id;
    public $fname;
    public $lname;
    public $username;
    public $date_in;
    public $date_out;
    public $friend_link;
    public $teamName;

    public function __get($name)
    {
        return $this->$name;
    }
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    
    public function init($arr)
    {
        foreach ($arr as $key=>$value)
        {
            $this->$key = $value;
        }
    }
    
    public function setProperties($arr)
    {
        foreach ($arr as $key) {
            if ($arr[$key] == '') {

                $arr[$key] = null;
            }
        }
        $this->id = $arr[4];
        $this->name = $arr[1];
        $this->team = $arr[3];
        $this->user_id = $arr[2];
        $this->fname = $arr[8];
        $this->lname = $arr[9];
        $this->username = $arr[7];
        if (strlen($arr[5]) > 5) {
            $datein = new DateTime($arr[5]);
            $this->date_in = $datein->format('Y-m-d');
        } else $this->date_in = '1111-11-11';
        if (strlen($arr[6]) > 5) {
            $dateout = new DateTime($arr[6]);
            $this->date_out = $dateout->format('Y-m-d');
        } else $this->date_out = '1111-11-11';
        $this->friend_link = $arr[0];

        return $this;
    }
    

    public function addToBase()
    {
        $base = new Connect;
        $query = "INSERT INTO players (id, name, team, present, date_in) VALUES ('$this->id', '$this->name', '$this->team', '1', '$this->date_in');";
        //print_r($query);
        $data = $base->prepare($query);
        $data->execute();

        $query = "UPDATE `variables` SET value = '$this->id' WHERE name ='last_play_id';";
        //print_r($query);
        $data = $base->prepare($query);
        $data->execute();
        return true;
    }
    public function move()
    {
        $base = new Connect;
        $query = "UPDATE players SET team='$this->team' WHERE id ='$this->id';";
        //print_r($query);
        $data = $base->prepare($query);
        $data->execute();

        return true;
    }
    public function restore()
    {
        $base = new Connect;
        $query = "UPDATE players SET team='$this->team', present = '1', date_in = '$this->date_in' WHERE id ='$this->id';";
        //print_r($query);
        $data = $base->prepare($query);
        $data->execute();

        return true;
    }
    public function delete()
    {
        $base = new Connect;
        $query = "UPDATE players SET present ='0', date_out = '$this->date_out' WHERE id ='$this->id';";
        //print_r($query);
        $data = $base->prepare($query);
        $data->execute();

        return true;
    }
    public function storeFriendLink()
    {
         $base = new Connect;
        $query = "UPDATE players SET friend_link = '$this->friend_link' WHERE id ='$this->id';";
        //print_r($query);
        $data = $base->prepare($query);
        $data->execute();

        return true;
    }
    public function storeTelegaInfo()
    {
        $base = new Connect;
        $query = "UPDATE players SET user_id = '$this->user_id', fname = '$this->fname', lname = '$this->lname', username = '$this->username', WHERE id ='$this->id';";
        //print_r($query);
        $data = $base->prepare($query);
        $data->execute();

        return true;
    }
    
    public function getInfo()
    {
        
        $db = new Connect;
        $query = "SELECT * FROM players WHERE id ='$this->id';";
        $data = $db->prepare($query);
        
        $data->execute();
        $OutputData = $data->fetch(PDO::FETCH_ASSOC);
        
                $this->num         = $OutputData['num'];
                $this->id          = $OutputData['id'];
                $this->name        = $OutputData['name'];
                $this->team        = $OutputData['team'];
                $this->present     = $OutputData['present'];
                $this->user_id     = $OutputData['user_id'];
                $this->fname       = $OutputData['fname'];
                $this->lname       = $OutputData['lname'];
                $this->username    = $OutputData['username'];
                $this->date_in     = $OutputData['date_in'];
                $this->date_out    = $OutputData['date_out'];
                $this->friend_link = $OutputData['friend_link'];
        return $this;
    }
    function setPresent($id)
    {
        $db = new Connect;
        
        $data = $db->prepare("UPDATE players SET present='1' WHERE  id ='$id';");
        $data->execute();
        return 'OK';
    }
    public function getPlayerAsHtml()
    {   $colors = ["#DCDCDC", "#C3FBD8", "#C6D8FF", "#FED6BC", "#ffccff", "#CCCC66", "#98FB98", "#f5ff8c", "#e999ff"];;
    $team_id = $this->team;
        $color = $colors[$team_id];
        $base = new BaseAPI;
        $teamNames = $base->getTeamNames(); 

        $output =  "<div class=\"content\" 
            style=\"background: $color; 
                    padding: 20px;
                    margin-top: 0px;
                    border: solid gray 2px;\">";

    $output .= "<p><strong>$this->teamName</strong></p>";
    
    $output .= "<div class=\"name-page\"><h1>$this->name</h1></div>";
    $output .="<button class=\"btn-get\" onclick='document.location.href=\"server?action=edit_player&player_id=$this->id\"'>Изменить</button><hr/>";
    if(strlen($this->friend_link)>6)
    {
        $output .= "Добавить в друзья -> <a href='$this->friend_link'>$this->friend_link</a><hr/>";
    }
    $output .= "
    <table class='player-info'>
        <tr> <td>ID игрока:</td> <td><strong>$this->id</strong></td></tr>
        <tr> <td>Team ID: </td> <td><strong>$this->team</strong></td></tr>
        <tr><td>На данный момент в команде?</td><td><strong>$this->present</strong></td</tr>
        <tr><td> Дата вступления:</td><td><strong>$this->date_in</strong></td></tr>
        <tr><td> Дата выхода:</td><td><strong>$this->date_out</strong></td></tr>
    </table>";
    if($this->present == 'Yes' || $this->present == '1')
    {
        $output .= "<br/>                    
            <form method=\"post\" action=\"/api/delplayer.php\" >
                <input type=\"text\" name=\"id\" value=\"$this->id\" style=\"display: none;\">
                <button type=\"submit\" class=\"btn-get\" >Удалить</button>
            </form>
            <form method=\"post\" action=\"/api/moveplayer.php\" >
                <input type=\"text\" name=\"id\" value=\"$this->id\" style=\"display: none;\">
                Выбор команды для перевода<br/><br/>
                <select name=\"team\" style=\"height: 50px;
                                            border:none;\" required>
                    <option disabled value=\"\">Выбор команды</option>";
                        for($i=0; $i < count($teamNames); $i++){
                            $idx = $i+1;
                            $output .= "<option value=\"$idx\">$teamNames[$i]</option>";
                        }
            $output .="</select>
                
                <button type='submit' class='btn-get'>Перевести</button>
            </form><hr/>";
       
    }  if($this->present == 'No' || $this->present == '0')
    {
        $output .= "<br/>                    
            <form method=\"post\" action=\"/api/restoreplayer.php\" >
                <input type=\"text\" name=\"id\" value=\"$this->id\" style=\"display: none;\">
                Выбор команды для восстановления<br/><br/>
                <select name=\"team\" style=\"height: 50px;
                                    border:none;\" required>
                    <option disabled value=\"\">Выбор команды</option>";
                    for($i=0; $i < count($teamNames); $i++){ 
                           $idx = $i+1;
                            $output .= "<option value=\"$idx\">$teamNames[$i]</option>";
                        }
                 $output .="</select>
                
                <button type=\"submit\" class=\"btn-get\">Восстановить</button>
            </form><hr/>";
    }  
        $output .= "<h2>💡Текущая статистика</h2><br/>";
        if($this->present == 'Yes' || $this->present == '1')
        {   //блок статистики игрока
            $bot_url = $base->getBotUrl();
           $url = $bot_url->value . '?getStat=true&id=' . $this->id;
            //var_dump($url);
            $stata = file_get_contents($url);
            $player_data = json_decode($stata);
            //var_dump($player_data);
            $output .="
                <div class=\"results-box\">
                    <table style=\"width:90%;border-collapse: collapse;margin:0 auto;\"> 
                 <tbody>
                  <style type=\"text/css\">
                    td { 
                        text-align: center;
                        padding: 6px;
                        border: solid gray 1px;
                      }
                  </style>
                    <tr>   
                        <td>
                            <strong>📈 Средний рез. за 5КС</strong>
                        </td>
                        <td>
                            <strong>$player_data->avg_res</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>🏆 Позиция среди игроков</strong> 
                        </td>
                        <td>
                            <strong>$player_data->place</strong> 
                        </td>                                        
                    </tr>
                    <tr>
                        <td>
                            <strong>🏅 Позиция в команде</strong> 
                        </td>
                        <td>
                            <strong>$player_data->team_place</strong> 
                        </td>                                        
                    </tr>
                    <tr>
                        <td>
                            <strong>🚕 Гараж🛠</strong> 
                        </td>
                        <td>
                            <strong>$player_data->garage</strong> 
                        </td>
                    </tr>
                    <tr>     
                        <td>
                            <strong>📊 Средние КМ за 4 недели</strong> 
                        </td>
                        <td>
                            <strong>$player_data->km</strong> 
                        </td> 
                    </tr>    
                      
                    <tr>
                        <td>
                            <strong>⛔️Пропущено заездов</strong> 
                        </td>
                        <td>
                            <strong>$player_data->propuski</strong> 
                        </td>                                        
                    </tr>              
                 </tbody>
                </table><br/>
            </div>";
            
        }
        $output .="<button class=\"btn-get\" onclick='document.location.href=\"getPlayerResults?id=$this->id\"'>Все данные</button></br><p1>
        Получение всех данных из базы ТЕПЕРЬ МОМЕНТАЛЬНО!!!!</p1><hr/>";    
        $output.= '</div>';
       
        $output.=  "<script src=\"/script/getPlayerInfo.js\"></script>";
        return $output;
    }

    function update()
    {
        $db = new Connect;
        $query = "UPDATE players SET name = '$this->name', team = '$this->team', present = '$this->present', user_id = '$this->user_id', fname = '$this->fname', lname = '$this->lname', username = '$this->username',date_in = '$this->date_in', date_out = '$this->date_out',  friend_link = '$this->friend_link' WHERE id ='$this->id';";
        $data = $db->prepare($query);
        $data->execute();
        return $query;
    }
   /**
     * Получение всех результатов игрока из базы
     */
    public function getAllResults()
    {
        $id = $this->id;
        //Получаем гараж
        $db = new Connect;
        $query = "SELECT date, gar FROM garage WHERE player_id ='$id' ORDER BY date;";
        $data = $db->prepare($query);
        $data->execute();
        $gars = [];
        while($OutputData = $data->fetch(PDO::FETCH_ASSOC))
        {
            $gars[] = $OutputData;
        }
        $this->garages = $gars;
        //Получаем КМ
        $query = "SELECT date, km FROM chest WHERE player_id ='$id' ORDER BY date;";
        $data = $db->prepare($query);
        $data->execute();
        $km = [];
        while($OutputData = $data->fetch(PDO::FETCH_ASSOC))
        {
            $km[] = $OutputData;
        }
        $this->km = $km;

        //Получаем все Резы КС
        // 1.соберем данные о названиях и таблицах
        $query = "SELECT * FROM kc_list ORDER BY id;";
        $data = $db->prepare($query);
        $data->execute();
        $kc_data = [];
        while($OutputData = $data->fetch(PDO::FETCH_ASSOC))
        {
            $kc_data[] = $OutputData;
        }
        $kc_results = [];
        foreach ($kc_data as $kc)
        {
            $table = $kc['table_name'];
            $kc_name = $kc['name'];

            $query = "SELECT res_1, res_2, res_3, res_4 FROM $table WHERE player_id = '$id';";
            $data = $db->prepare($query);
            $data->execute();
            $OutputData = $data->fetch(PDO::FETCH_ASSOC);
            if($OutputData) 
            {
                $kc_results[$kc_name] = $OutputData;
            }
            
        }
        $this->results_kc = $kc_results;
        
        return $this;
    }
    
}
