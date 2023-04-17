const app = Vue.createApp({
    data() {
      return {
        players: '',
        allPlayers:[],
        playersOfTeam: [],
        teams:[],
        playerName:'',
        newPlayerName:'',
        findExamples: 0,
        selected:'команда не выбрана',
        newPlayerId:'не доступен',
        colors:["#DCDCDC", "#C3FBD8", "#C6D8FF", "#FED6BC", "#ffccff", "#CCCC66", "#98FB98", "#f5ff8c"],
        loaded: false,
        errors: false,
        error:'',
        active: false,
        idel: '',
        fName:'',
        finded:[]
      }
    },
    methods: {
        async getNewPlayerId(){
          let resp = await fetch('http://topbots.site/api/getNewPlayerId.php')
            if (!resp.ok) {
              console.log('Ответ сети был не ok.');
            }  
             this.newPlayerId = await resp.json()
            console.log(this.newPlayerId)
  
        }, 
        async getAllPlayers(){
            
            let resp = await fetch('http://topbots.site/api/getplayers.php')
            if (!resp.ok) {
              console.log('Ответ сети был не ok.');
            }  
            this.players = await resp.json()
            this.loaded = true 
            this.allPlayers = this.players  
            console.log(this.players)
            
        },
         
       async findPlayerByName(){
        //console.log(this.fName)
            this.error = ''
            this.findExamples = 0
            this.finded = [] //очищаем массив после предыдущего поиска
            this.players = this.allPlayers
            
             for (idx in this.players){
                let name = String(this.players[idx].name).toLowerCase()//.indexOf(this.fname)
                this.newPlayerName = this.playerName
                if (name.indexOf(this.playerName.toLowerCase()) >= 0){
                  //console.log(name)   
                  this.finded.push(this.players[idx].name)
                  if(name == this.playerName.toLowerCase()){
                    this.error = this.playerName + ' уже есть в базе!!!'
                  }
                }
              }
                //console.log(this.finded)
            //this.findExamples = this.finded[0].name
            
      },
      async getPlayerLink(id){
        window.location.href = '/api/getPlayer.php?id='+id;
      },
      getTeam(team_id){
        this.playersOfTeam = []
        this.players = this.allPlayers
          for(i in this.players){
            if(this.players[i].team == team_id && this.players[i].present == '1'){
              this.playersOfTeam.push(this.players[i])
            }
          }
          this.players = this.playersOfTeam
      },
      async getTeamNames(){
        let resp = await fetch('http://topbots.site/api/getTeamNames.php')
            if (!resp.ok) {
              console.log('Ответ сети был не ok.');
            }  
            let teamNames = await resp.json()
            console.log(teamNames)
            for(i in teamNames){
            this.teams.push(teamNames[i])
            }
            console.log(this.teams)
      },
     async addPlayer(){
        if ((this.error == '') && (this.newPlayerId != 'не доступен') && (this.playerName !='') && (this.selected != 'команда не выбрана')){
          let data = { 
            "id": this.newPlayerId,
            "name": this.playerName,
            "team": this.teams.indexOf(this.selected)+1,
            "add_player": "1"
        }
        console.log(data) 
          let options = {
            "method": "POST",
            "headers":{
                "Content-Type": "application/json"
              },
            "body": JSON.stringify(data)
          }
          this.error = 'Игрок '+this.playerName+' добавляется... Подождите завершения.';
        let resp = await fetch('http://topbots.site/api/addplayer.php', options)
          
          let res = await resp.json()
          console.log(res.name)
          this.getNewPlayerId()
          this.playerName = ''
          this.selected = 'команда не выбрана'
          this.error = ''
        }
      }
    
      },
    beforeMount() {
      this.getAllPlayers()
      this.getTeamNames()
      this.getNewPlayerId()
    }
  })
  /*app.component(this.playersArr[], {
    template: `<div class="form-item">
                  <label for="Size" class="form-label">Size (MB)</label>
                  <input id="size" type="number" name="size" class="form-input"  required><br>
                  <span>Please, enter size of DVD in MBytes</span>
                 </div>`
  })*/
  
  
  app.mount('#container')
  
  
  