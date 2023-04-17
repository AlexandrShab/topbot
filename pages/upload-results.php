<div class="name-page">
<h1>Загрузка результатов</h1>
</div>
<hr style="height:1px; color:lightgray;"/>
<div class="add-page" id="container">  
<div class="input-block">

    
    

    <form enctype="multipart/form-data"
            id="upload-results" method="post" action="image.php">
        <label for="select">Выбор команды:</label>
        <br/><br/>
        <select class="input-item" id="select-team">

        </select> 
        <br/>
        
        <div>
            
            
        </div>
        <!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000">Выбор файла
        <!-- Название элемента input определяет имя в массиве $_FILES -->
        <input  сlass="input-item" 
                type="file"
                name="screenshot">
        <br/><br/>
        
        <button class="btn-get" type="reset">Очистить форму</button>
        <button class="btn-get" type="submit">Отправить</button>
    </form>
    
</div>
</div>
<script src="/public/upload-res.js"></script>