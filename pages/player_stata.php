<div class="name-page">
        <h1>Данные Статистики</h1>
    </div>
<div id="container">
    
        <button class="btn-get" v-on:click="getData('<?php echo $player->id;?>')" v-if="player_id==''">Просмотр</button>

    <div class="stata" v-if="player_id">
    <br/><h2>Данные по KC</h2>
        <table style="width:100%;border-collapse: collapse;"> 
            <thead>
                <tr v-if="typeof ks_resultes === 'object'" style="background: lightgray;">
                    <th>
                        Название КС
                    </th>
                    <th >
                        Рез 1
                    </th>
                    <th >
                        Рез 2
                    </th>
                    <th >
                        Рез 3
                    </th>
                    <th >
                        Рез 4
                    </th>
                </tr>
                </thead>
            <tbody>
            
                
                    <tr v-for="ks_results in ks_resultes">   
                        <td>
                            <strong>{{ ks_results.ks_name }}</strong>
                        </td>
                        <td>
                            <strong>{{ ks_results.results[0] }}</strong>
                        </td>
                        <td>
                            <strong>{{ks_results.results[1] }}</strong> 
                        </td>
                        <td>
                            <strong>{{ks_results.results[2] }}</strong> 
                        </td>
                        <td>
                            <strong>{{ks_results.results[3] }}</strong> 
                        </td>    
                                          
                    </tr>                 
            </tbody>
        </table>

    <br/><h2>Данные по Гаражу</h2>
        <table style="width:100%;border-collapse: collapse;"> 
            <thead>
                <tr  v-if="typeof garages === 'object'" style="background: lightgray;"  >
                    <th>
                        Дата
                    </th>
                    <th >
                        Мощность гаража
                    </th>
                    <th >
                        Прирост за неделю
                    </th>
                    
                    
                </tr>
                </thead>
            <tbody>
            
                
                    <tr v-for="garage in garages">   
                        <td>
                            <strong>{{ garage.date }}</strong>
                        </td>
                        <td>
                            <strong>{{ garage.garagePower }}</strong>
                        </td>
                        <td>
                            <strong>{{garage.diff}}</strong> 
                        </td>                      
                    </tr>                 
            </tbody>
        </table>
        <br/><h2>Данные по КМ</h2>
        <table style="width:100%;border-collapse: collapse; border: solid black 1px;"> 
            <thead>
                <tr v-if="typeof chests === 'object'" style="background: lightgray;">
                    <th>
                        Дата
                    </th>
                    <th >
                        KM
                    </th>
                </tr>
                </thead>
            <tbody>
            
                
                    <tr v-for="item in chests" style="border: solid black 1px;">   
                        <td>
                            <strong>{{ item.date }}</strong>
                        </td>
                        <td>
                            <strong>{{ item.km }}</strong>
                        </td>
                                              
                    </tr>                 
            </tbody>
        </table></br>
    </div>
    </div>
    
    

    <script src="https://unpkg.com/vue@3.2.36"></script>
    <script type="module" src="/script/fireBase.js"></script>
  