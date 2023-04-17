async function getTeamNames(){
    let team_names = [];
    let resp = await fetch('http://topbots.site/api/getTeamNames.php')
        if (!resp.ok) {
          console.log('Ответ сети был не ok.');
        }  
        let teamNames = await resp.json()
        
        for(i in teamNames){
            team_names.push(teamNames[i])
        }
        console.log(team_names)
  }