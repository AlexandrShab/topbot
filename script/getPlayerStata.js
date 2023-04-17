

const vueApp = Vue.createApp({
    data() {
      return {
        player_id : '',
        garages:[],
        chests:[],
        ks_resultes:[]
              }
    },
    methods: {
        async getData(pl_id){
            
            if(pl_id !=''){
                    let data = {"id":pl_id}
                    const url = "http://topbots.site/api/getPlayerData.php"
                    let options = {
                            method: 'POST',
                            headers: {
                            'Content-Type': 'application/json;charset=utf-8'
                            },
                            body: JSON.stringify(data)
                        }
                    let res = await fetch(url, options);
                 
                    const playerData = await res.json()
                    //document.getElementById('stata').innerHTML = JSON.stringify(playerData);
                    if(playerData){
                        this.setValues(pl_id, playerData)
                    }else{document.getElementById('container').innerHTML += `<p1>По игроку с id <strong>${pl_id}</strong> Нет Данных...</p1>`}
               
            }
        },
        setValues(pl_id, playerData){
            this.player_id = pl_id;
            this.garages = playerData.garage;
            this.chests = playerData.chest;
            this.ks_resultes = playerData.ks_results;
      
        }
      },
    beforeMount(){
      //this.getData(pl_id);
    },
  })
  vueApp.mount('#container')

  