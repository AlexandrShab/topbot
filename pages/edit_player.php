
<h1 class="name-page">Игрок <?php echo $player->name; ?></h1>
<h3 class="name-page">Редактор данных</h3>
<hr/>
<form class="edit-form" method="post" action="/server">
    
    
        
            Player ID:<br/>
            <input id="id" class="input-item" name="id" value="<?php echo $player->id; ?>" disabled></br>
               
            Ник:<br/>
            <input id="name" class="input-item" name="name" value="<?php echo $player->name; ?>" required></br>
               
            Номер команды:<br/>
            <input id="team" class="input-item" type="text" name="team" value="<?php echo $player->team; ?>" required></br>
               
            В команде? -> ('1' - Да, '0' - Нет):<br/>
            <input id="present" class="input-item" type="text" name="present" value="<?php echo $player->present; ?>" required></br>
               
            Telegram ID:<br/>
            <input id="user_id" class="input-item" name="user_id"  value="<?php echo $player->user_id; ?>"></br>
               
            Telegram First Name:<br/>
            <input id="fname" class="input-item" type="text" name="fname" value="<?php echo $player->fname; ?>"></br>
               
            Telegram Second Name:<br/>
            <input id="lname" class="input-item" name="lname" value="<?php echo $player->lname; ?>"></br>
               
            Telegram UserName:<br/>
            <input id="username" class="input-item" name="username" value="<?php echo $player->username; ?>"></br>
               
            Дата вступления:<br/>
            <input id="date_in" class="input-item" name="date_in" value="<?php echo $player->date_in; ?>"></br>
               
            Дата выхода:<br/>
            <input id="date_out" class="input-item" name="date_out" value="<?php echo $player->date_out; ?>"></br>
               
            Ссылка на добавление в друзья:<br/>
            <input id="friend_link" class="input-item" type="url" name="friend_link" value="<?php echo $player->friend_link; ?>"></br>
        <input type="hidden" name="update_player" value="true">
    
    <button class="submit-btn btn-get" type="submit">Save</button>
    <button class="cancel-btn btn-get" type="reset">Cancel</button>
</form>