<?php
  
echo "<div class='content' 
            style='background: $colors[$team]; 
                    padding: 20px;
                    border: solid gray 2px;'>";
    $output = "<p><strong>$teamName</strong></p>";
    $output .= "<div class=\"name-page\"><h1>$player->name</h1></div><hr/>";
/*    if(strlen($player->friend_link)>6)
    {
        $output .= "Добавить в друзья -> <a href='$player->friend_link'>$player->friend_link</a><hr/>";
    }
    $output .= "
    <table class='player-info'>
        <tr> <td>ID игрока:</td> <td><strong>$player->id</strong></td></tr>
        <tr> <td>Team ID: </td> <td><strong>$player->team</strong></td></tr>
        <tr><td>На данный момент в команде?</td><td><strong>$player->present</strong></td</tr>
        <tr><td> Дата вступления:</td><td><strong>$player->date_in</strong></td></tr>
        <tr><td> Дата выхода:</td><td><strong>$player->date_out</strong></td></tr>
    </table>";
    if($player->present == 'Yes')
    {
        $output .= "<br/>                    
            <form method='post' action='/api/delplayer.php' >
                <input type='text' name='id' value='$player->id' style='display: none;'>
                <button type='submit' class='btn-get' >Удалить</button>
            </form>
            <form method='post' action='/api/moveplayer.php' >
                <input type='text' name='id' value='$player->id' style='display: none;'>
                Выбор команды для перевода<br/><br/>
                <select name='team' style='height: 50px;
                                            border:none;' required>
                    <option disabled value=''>Выбор команды</option>
                    <option value='1'>Top Team</option>
                    <option value='5'>5</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='2'>2</option>
                    <option value='6'>6</option>
                    <option value='7'>7</option>
                </select>
                
                <button type='submit' class='btn-get'>Перевести</button>
            </form><hr/>";
        
    }  if($player->present == 'No')
    {
        $output .= "<br/>                    
            <form method='post' action='/api/restoreplayer.php' >
                <input type='text' name='id' value='$player->id' style='display: none;'>
                Выбор команды для восстановления<br/><br/>
                <select name='team' style='height: 50px;
                                    border:none;' required>
                    <option disabled value=''>Выбор команды</option>
                    <option value='1'>Top Team</option>
                    <option value='5'>5</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='2'>2</option>
                    <option value='6'>6</option>
                    <option value='7'>7</option>
                </select>
                
                <button type='submit' class='btn-get'>Восстановить</button>
            </form><hr/>";
    }  
    $output .= "<h2>Данные Телеграм</h2><hr/><br/>";
    if($photoHtml){
        $output .= $photoHtml."<br/>";
    }
    $output .= $user->getUserBox();
    if($player->username != 'Отсутствует')
    {
        $output .= "<a class='btn-get' href='https://t.me/$player->username'>Написать в личку</a>";
    }
    */
echo $output;
echo '</div>';
echo '<script src="/script/getPlayerInfo.js"></script>';
?>