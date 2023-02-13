

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

// window.addEventListener('load', function(e){
//     this.document.getElementById("#show-all").addEventListener('change', this.fetch('/public/widget/test.php', {
//         method : 'get',
//         body : {
//             action : 'loco'
//         }
//     }).then(function(response){
//         console.log(response)
//     })
        
//     )
// })


// function show_team_select(url){
//     console.log('test')

//     /* var xml = new XMLHttpRequest()
//     xml.open('GET', url)
//     xml.send(null)


//     const select_query = document.getElementById("show-all")
//     select_query.addEventListener('change', function(event){
//         if(xml.readyState == XMLHttpRequest.DONE){
//             document.getElementById('selection-criteria').innerHTML = '<div class="select-league"><select name="" id=""><option value="">LaLiga</option><option value="">'+select_query.value+'</option></select></div>'
//             alert(xml.responseText);
//         } 

//     })*/
//     /* var test = fetch(url, {
//         method : 'get',
//         body : JSON.stringify({
//             action : 'loco'
//         })
//     }).then(data => {
//         console.log(data)
//     }) */

//     /* fetch(url).then(function(responce){
//         console.log(responce.text())
//     }) */
// }

const show_by = document.querySelectorAll('.show-by')

show_by.forEach(item => {
    item.addEventListener('click', e => {
        //e.preventDefault();
        if(item.value == 'league'){
            document.getElementById('select-league').style.display = 'block';
            document.getElementById('keywords-input').style.display = 'none';
            document.getElementById('keywords-input-info').style.display = 'none';
        }
        
        if(item.value == 'all'){
            document.getElementById('keywords-input').style.display = 'none';
            document.getElementById('select-league').style.display = 'none';
            document.getElementById('keywords-input-info').style.display = 'none';
            var settings_button_text = document.getElementById('settings-button-text').value
            var settings_card_shadow = document.getElementById('settings-card-shadow').value
            
            const url = dcms_vars.ajaxurl
    
            const formData = new FormData()
            formData.append('action', 'show_all_teams')
            formData.append('settings_button_text', settings_button_text)
            formData.append('settings_card_shadow', settings_card_shadow)
    
            fetch(url, {
                method : 'POST',
                body : formData,
            })
            .then(res=>res.text())
            .then(data=>{
                document.getElementById('eflw-teamcards-container').innerHTML = data
            })
        }if(item.value == 'keyword'){
            document.getElementById('select-league').style.display = 'none';
            document.getElementById('keywords-input').style.display = 'block';
            document.getElementById('keywords-input-info').style.display = 'block';

            
        }
    })
})

const show_by_league = document.querySelector('#select-league')

show_by_league.addEventListener('change', e => {

    const url = dcms_vars.ajaxurl
    var settings_button_text = document.getElementById('settings-button-text').value
    var settings_card_shadow = document.getElementById('settings-card-shadow').value

    const formData = new FormData()
    formData.append('action', 'teams_by_league')
    formData.append('league_id', e.target.value)
    formData.append('settings_button_text', settings_button_text)
    formData.append('settings_card_shadow', settings_card_shadow)
    
    fetch(url, {
        method : 'POST',
        body : formData,
    })
    .then(res=>res.text())
    .then(data=>{
        document.getElementById('eflw-teamcards-container').innerHTML = data
    })
})


const show_by_keywords = document.querySelector('#keywords-input')

show_by_keywords.addEventListener('input', e => {

    const url = dcms_vars.ajaxurl
    var settings_button_text = document.getElementById('settings-button-text').value
    var settings_card_shadow = document.getElementById('settings-card-shadow').value

    const formData = new FormData()
    formData.append('action', 'teams_by_keyword')
    formData.append('keywords', e.target.value.replace(',', '|').replace(' ', '') )
    formData.append('settings_button_text', settings_button_text)
    formData.append('settings_card_shadow', settings_card_shadow)

    fetch(url, {
        method : 'POST',
        body : formData,
    })
    .then(res=>res.text())
    .then(data=>{
        document.getElementById('eflw-teamcards-container').innerHTML = data
    })
})
