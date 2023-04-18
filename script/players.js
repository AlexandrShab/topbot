const app = Vue.createApp({
    data() {
      return {
        players: '',
        allPlayers:[],
        playersOfTeam: [],
        teams:[],
        newPlayerId:'',
        colors:["#DCDCDC", "#C3FBD8", "#C6D8FF", "#FED6BC", "#ffccff", "#CCCC66", "#98FB98", "#f5ff8c", "#e999ff"],
        loaded: false,
        errors: false,
        active: false,
        idel: '',
        fName:'',
        finded:[]
      }
    },
    methods: {
        async getAllPlayers(){
            loading()
            let resp = await fetch('http://topbots.site/api/getplayers.php');
            if (!resp.ok) {
              console.log('Ответ сети был не ok.');
            }  
            this.players = await resp.json();
            this.loaded = true;
            this.allPlayers = this.players; 
            console.log(this.players)
            hideloading()
            
        },
         async getPresent(){
            let resp = await fetch('http://topbots.site/api/getpresent.php/')
                
            this.players = await resp.json()
            this.loaded = true     
            console.log(this.players)
        },
        async getDeleted(){//'https://alex-shab-test.000webhostapp.com/api/getdeleted.php/'
           let resp = await fetch('http://topbots.site/api/getdeleted.php/')
               
           this.players = await resp.json()
           this.loaded = true     
           console.log(this.players)
       },
       async findPlayerByName(){
        //console.log(this.fName)
            this.finded = [] //очищаем массив после предыдущего поиска
            this.players = this.allPlayers
            this.loaded = true
             for (idx in this.players){
             // if (String(this.players[idx].name).indexOf(this.fname)>-1){
                let name = String(this.players[idx].name).toLowerCase()//.indexOf(this.fname)
                this.fName = this.fName.toLowerCase()
                if (name.indexOf(this.fName) >= 0){
                  //console.log(name)   
                  this.finded.push(this.players[idx])
                }
           
            // }
       }
        //console.log(this.finded)
        this.players = this.finded
        this.fName = ''
      },
      async getPlayerLink(id){
        loading()
        window.location.href = '/getPlayer?id='+id;
        hideloading()
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
      }
    
      },
    beforeMount() {
      this.getAllPlayers()
      
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
  
