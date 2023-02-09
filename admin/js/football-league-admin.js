

function select_logo(){
    upload = wp.media({title: 'Select team\'s logo', button: {text: 'Use this image'}}).on('select', function(){
        var attachment = upload.state().get('selection').first().toJSON()
        if(document.getElementById('logo-preview')){
            document.getElementById('logo-preview').remove();
        }
        document.getElementById('logo-preview-container').innerHTML = '<img src="' + attachment.url + '" style="object-fit:contain" width=100 height=100 name="logo-preview" id="logo-preview" style="object-fit: cover;">'
        document.getElementById('logo').value = attachment.url
    }).open()
}

function httpGet(theUrl)
{
    if(confirm('Are you sure you want to delete this item?')){
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
        xmlHttp.send( null );
        return xmlHttp.responseText;
    }
}