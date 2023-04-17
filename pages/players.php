<div class="name-page">
        <h1>Игроки</h1>
    </div>
<div class="container" id="container">
    <div class="findbar">
        <label for="find" id="find-label">Поиск игрока: </label><span>{{ fName }}</span><br/>
        <input type="text" id="find" v-model="fName" class="input-item" @keyup.enter="findPlayerByName()" placeholder="Введите имя или его часть">
        <button class="btn-find"  @click="findPlayerByName()">Найти</button>
        <br/>
        
            <!-- -->
    </div>
       
    <!--
    <div class="list" id="list" > -->
        <input type="button" class="btn-get" value="Все команды" @click="getPresent()">
        <input type="button" class="btn-get" value="Удаленные" @click="getDeleted()">
        <input type="button" class="btn-get" value="Вся база" @click="getAllPlayers()">
        <br/>
        <text style="margin-left: 40px;">Просмотр по командам</text><br/>
        <input type="button" class="btn-min" value="1" @click="getTeam(1)">
        <input type="button" class="btn-min" value="2" @click="getTeam(2)">
        <input type="button" class="btn-min" value="3" @click="getTeam(3)">
        <input type="button" class="btn-min" value="4" @click="getTeam(4)">
        <input type="button" class="btn-min" value="5" @click="getTeam(5)">
        <input type="button" class="btn-min" value="6" @click="getTeam(6)">
        <input type="button" class="btn-min" value="7" @click="getTeam(7)">
        <input type="button" class="btn-min" value="8" @click="getTeam(8)">
        
        <br/><br/><br/><br/>
        <table style="width:100%;border-collapse: collapse;"> 
            <thead>
                <tr v-if="typeof players === 'object'" style="background: lightgray;">
                    <th>
                        №
                    </th>
                    <th >
                        ID
                    </th>
                    <th >
                        Team
                    </th>
                    <th >
                        Player Name
                    </th>
                    <th >
                        Active?
                    </th>
                    
                </tr>
                </thead>
            <tbody>
            
                
                    <tr v-for="(player, index) in players"  
                        :style=" { backgroundColor: colors[player.team]  }" 
                        @click="getPlayerLink(player.id)"
                        >
                        <!--@click="player.active = !player.active"-->
                        <!-- @mouseover="player.active=true"
                        @mouseout="player.active = false"-->
                        <td>
                            <strong>{{ parseInt(index) + 1 }}</strong>
                        </td>
                        <td>
                            <strong>{{ player.id }}</strong>
                        </td>
                        <td>
                            <strong>{{ player.team }}</strong>
                        </td>
                        <td>
                            <strong v-if="player.active && player.fname">
                                {{player.fname}} {{player.lname}} @{{player.username}}
                            </strong>
                            <strong v-else>{{player.name}}</strong>
                            
                            

                        </td>
                        <td>
                            <strong>{{player.present}}</strong>
                        </td>
                        
                    </tr>                 
            </tbody>
        </table>
       
    </div>
 </div>   
    

    <script src="https://unpkg.com/vue@3.2.36"></script>
    <script src="/script/players.js"></script>
  <!--  <script src="/public/players1.js"></script>-->