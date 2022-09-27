<div class="name-page">
        <h1>Добавление игрока</h1>
    </div>
    <hr style="height:1px; color:lightgray;"/>
    <div class="add-page" id="container">  
        <div class="input-block">
            <label for="select">Выбор команды: <strong>{{ selected }}</strong></label>
            <br/>
            <select class="input-item" id="select" v-model="selected">
                    <option disabled>Выбор команды: </option>
                    <option v-for="team in teams"><strong>{{ team }}</strong></option>
                
            </select> 
            <br/>
            <span>ID игрока: <strong>{{newPlayerId}}</strong></span><br/>
            <text style="visibility:hidden;"> Есть такой </text><err style="color: firebrick; margin-left:10px">{{ error }}</err>
            <input class="input-item" 
                    type="text" 
                    v-model.trim="playerName" 
                    placeholder="Введите имя нового игрока"
                    @input="findPlayerByName()">
            <br/>
            <span>Найдены в базе: </span><br/>
                <div class="finded-players"> 
                    {{ finded[0] }}<br/>
                    {{ finded[1] }}<br/>
                    {{ finded[2] }}<br/>
                    {{ finded[3] }}<br/>
                </div>
            <button class="btn-get" @click="findPlayerByName()">Запуск</button>
            

            
        </div>
    </div>
    <script src="https://unpkg.com/vue@3.2.36"></script> 
    <script src="/public/addPlayer.js"></script>
