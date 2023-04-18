

const vueApp = Vue.createApp({
    data() {
      return {
        player_id : '',
        garages:[],
        chests:[],
        ks_resultes:''
              }
    }, 
    methods: {
        async getData(pl_id){
            
            if(pl_id !=''){
                    loading()
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
                    console.log(playerData);
                    
                    //document.getElementById('stata').innerHTML = JSON.stringify(playerData);
                    if(playerData){
                        this.setValues(pl_id, playerData)
                    }else{document.getElementById('container').innerHTML += `<p1>По игроку с id <strong>${pl_id}</strong> Нет Данных...</p1>`}
               
            }
        },
        setValues(pl_id, playerData){
            this.player_id = pl_id;
            this.garages = playerData.garages;
            this.chests = playerData.km;
            this.ks_resultes = playerData.results_kc ;
            console.log(this.player_id, this.garages)
            hideloading()
      
        }
      },
    beforeMount(){
      //this.getData(pl_id);
    },
  })
  vueApp.mount('#container')

  