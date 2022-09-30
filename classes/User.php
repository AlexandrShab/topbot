<?php
require_once __DIR__ . '/BaseAPI.php';

class User
{
    public $isAdmin = false;
    public $id;
    public $first_name;
    public $last_name;
    public $username;
    public $photo_url;
    public $player_id_arr;

    
    public function __construct($arrUser)
    {   
        foreach ($arrUser as $key => $value) 
        {
                $this->$key = $value;
        }
    }

    public function init()
    {
        $base = new Connect;
        $query = "SELECT * FROM users WHERE id ='$this->id' LIMIT 1";
        
        $data = $base->prepare($query);
        $data->execute();
        $obj = $data->fetch(PDO::FETCH_OBJ);
        if (strlen($obj->player_id_arr)>0)
        {
            $obj->player_id_arr = explode(',', $obj->player_id_arr);
        }
        return $obj;
    }

    public function isInBase()
    {
        $base = new Connect;
        $query = "SELECT * FROM users WHERE id ='$this->id' LIMIT 1";
        
        $data = $base->prepare($query);
        $data->execute();
        return $data->fetch(PDO::FETCH_ASSOC);
    }
    public function checkAdmin()
    {
        $base = new Connect;
        $query = "SELECT is_admin FROM users WHERE id ='$this->id' LIMIT 1";
        
        $data = $base->prepare($query);
        $data->execute();
        $arr = $data->fetch(PDO::FETCH_ASSOC);
        $this->isAdmin = $arr['is_admin']; 
        return $this->isAdmin;
    }
    public function addToBase()
    {
        $base = new Connect;
        $query = "INSERT INTO users (id, first_name, last_name, username, photo_url, auth_date) 
                VALUES ('$this->id', '$this->first_name', '$this->last_name', '$this->username', '$this->photo_url', '$this->auth_date');";
        
        $data = $base->prepare($query);
        $data->execute();
        return true;
    }
    
   public function getUserBox()
    {   $output = "<div class=\"user-box\">";
        $output .= "<h2>Данные Телеграм</h2><hr/>
            <h2 class=\"user-name\">$this->first_name  $this->last_name </h2>
            <a href=\"$this->photo_url\"><img src=\"$this->photo_url\" alt=\"$this->first_name $this->last_name\"
            style=\"width:80px;height:80px;border: 2px solid white;box-shadow: 1px 3px 12px 0px;\"></a><br/><br/>
            <text>UserName: $this->username</text><br/>
            <text>UserID  : $this->id </text><br/>";
           $this->checkAdmin();
        if ($this->isAdmin == '1')
        {
            $output .= "<strong>Админ</strong><br/><br/>";
        }
        if (count($this->player_id_arr)>0)
        {
            foreach($this->player_id_arr as $i=>$player_id)
            {
                $i++;
                $output .= "$i. <strong>$player_id</strong><br/><br/>";
                
            }
        }
        if(strlen($this->username)>1)
        {
            $output .= "<button class=\"btn-get\" onclick=\"window.location.href='https://t.me/$this->username';\">Написать в личку</button>";
            //$output .= "<a class='btn-get' href='https://t.me/$this->username'>Написать в личку</a>";
        }
    $output .="</div>";
    return $output;
    }
}

