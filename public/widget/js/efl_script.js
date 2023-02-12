

function show_history(teamName, history){

    console.log(teamName);

    h_container = document.getElementById('team-history');
    n_container = document.getElementById('team-name-history');
    document.getElementById('history-container').className = 'history-container show';

    n_container.innerText = teamName;
    h_container.innerText = history;
}

function close_history(){
    document.getElementById('history-container').className = 'history-container';
}