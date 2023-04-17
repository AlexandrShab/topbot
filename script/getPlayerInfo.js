async function getTeamNames(team){
    team = parseInt(team)
    let resp = await fetch('http://topbots.site/api/getTeamNames.php')
        if (!resp.ok) {
          console.log('Ответ сети был не ok.');
        }  
        let teamNames = await resp.json()
        console.log(teamNames)
        let teams = teamNames.split(',')
        console.log(teams)
        let team_name = String(teams[team-1])
        console.log(team_name)
        return team_name
  }
  async function getPlayerResultsLink(id){
          window.location.href = '/getPlayerResults?id='+id;
        }