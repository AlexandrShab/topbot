import { initializeApp } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js";
import { getDatabase, ref, onValue } from 	"https://www.gstatic.com/firebasejs/9.17.1/firebase-database.js";
var pl_id = ''
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
        getData(pl_id){
            const firebaseConfig = {
                apiKey: "AIzaSyDnDemJoEbEiuVrfqQiRXhw7VJKSZKVUXE",
                authDomain: "homecloud-c5483.firebaseapp.com",
                databaseURL: "https://homecloud-c5483-default-rtdb.europe-west1.firebasedatabase.app",
                projectId: "homecloud-c5483",
                storageBucket: "homecloud-c5483.appspot.com",
                messagingSenderId: "949737672869",
                appId: "1:949737672869:web:1bba3953d5e6a50b82fd4c"
            };
            if(pl_id !=''){
            const db = getDatabase(initializeApp(firebaseConfig));      // Initialize Firebase
            const pl_data = ref(db, pl_id);
            
                onValue(pl_data, (snapshot) => {
                    const playerData = snapshot.val();
                    //document.getElementById('stata').innerHTML = JSON.stringify(playerData);
                    if(playerData){
                        this.setValues(pl_id, playerData)
                    }else{document.getElementById('container').innerHTML += `<p1>По игроку с id <strong>${pl_id}</strong> Нет Данных...</p1>`}
                });
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

  