<div class="user-box">
    <p class="user-name"><?php $this->first_name . ' ' . $this->last_name ?></p>
    <a href=""><img src="<?php $this->profil_url ?>" alt="<?php $this->first_name . ' ' . $this->last_name ?>"></a>
    <text>UserName: <?php $this->username ?></text><br/>
    <text>UserID  : <?php $this->id ?></text>
    <?php 
        if(isset($this->username))
            {
                echo "<a class='btn-get' href=\"https://t.me/$this->username\">Написать в личку</a>";
            }
    ?>
        
</div>