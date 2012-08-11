window.addEvent('domready', function(){
    
    var mainDivID = 'output';
    var lastDivID = 'output';
    
    var handleResponse = function(response){
        if(!$defined(response.access_token)){
            var errormsg = '(' + response.code + ')' +
                response.type + '\n' +
                response.message;
                alert(errormsg);
        }else{
            //$(accessTokenElement).value = response.access_token;
            //postAuthorization();
            
            $(accessTokenElement).value = response.access_token;
            postAuthorization();
        }
    };
    
    var pingServer = function(server){
        var reqUrl = 'index.php';
        var newDivID = 'output'+server;
        var myRequest = new Request.JSON({
            url: reqUrl,
            method: 'post',
            data:{
                'option': 'com_promoter',
                'view': 'ping',
                'format': 'raw',
                'server': server,
                'project': project
            },
            onRequest: function(){
                new Element('div',{
                    id: newDivID,
                    text: 'Starting to ping server ' + serverNames[server] + ''
                }).inject($(mainDivID));
                //$(lastDivID).set('html', '<p>Starting to ping server ' + server + '</p>');
                //$('<p>Starting to ping server ' + server + '</p>').insertAfter('p.'+ lastDivID);
            },
            onSuccess: function(response){
                $(newDivID).set('html', 'Pinging done to server ' + serverNames[server]);
                //$('<p>Pinging done to server ' + server + '</p>').appendTo('p.'+ lastDivID);
                //handleResponse(response);
            },
            onFailure: function(response){
                $(newDivID).set('html', 'Pinging server ' + serverNames[server] + ' failed: ' + response.status);
                //$('<p>Pinging server ' + server + ' failed: ' + response.status + '</p>').appendTo('p.'+ lastDivID);
            },
            onComplete: function(){
                $(newDivID).set('html', 'Pinging server ' + serverNames[server] + ' Completed.');
                //$('<p>Pinging server ' + server + ' Completed. </p>').appendTo('p.'+ lastDivID);
            }
        });
        
        myRequest.cancel().send();    
    };
    
    $each(servers, function(server){
        pingServer(server);
    });
        
});