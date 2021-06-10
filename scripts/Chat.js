class Chat{
    constructor(){
        this.messages = [];
        this.nbMessages = 0;
        this.maxNbMessages = 10;
        this.lastIDMessage = 0;
    }

    
        

    removeLastMessage(){
        this.messages.pop();
        this.nbMessages--;
        var elt = document.getElementById('chat');
        elt.removeChild(elt.firstChild);
    }

    addMessage(message){
        this.messages.unshift(message);
        this.lastIDMessage = message.getId();
        this.nbMessages++;
        if(this.nbMessages >= this.maxNbMessages){
            this.removeLastMessage();
        }
        let elt = document.getElementById('chat');
        let pe = document.createElement("p");
        pe.innerHTML = "<em>" + message.getPseudo() + " à " + message.getDateHeure() + "</em> - " + message.getMessage();
        elt.appendChild(pe);
        //elt.insertafter(pe, elt.lastChild);
    
        
    }

    getMessage(positionMessage){
        if(positionMessage < this.nbMessages){
            return this.messages[positionMessage];
        } else{
            return false;
        }
    }

    getData(){
        var req = new XMLHttpRequest();
        req.open("GET", "./ajax/ajax.php?AjaxUc=getMessages&id="+this.lastIDMessage, false);
        req.send(null);
        if(req.responseXML != 0)
        {
            //alert(req.responseXML);
        }
        var text;
        var login;
        var dateFR;
        var id;
        var nbMessages = req.responseXML.getElementsByTagName('nbMessages')[0].textContent;
        var message;
        for(let i=nbMessages-1; i>=0; i--){

            login = req.responseXML.getElementsByTagName('login')[i].textContent;
            text = req.responseXML.getElementsByTagName('text')[i].textContent;
            dateFR = req.responseXML.getElementsByTagName('dateFR')[i].textContent;
            id = req.responseXML.getElementsByTagName('id')[i].textContent;

            
            this.addMessage(new Message(login, text, dateFR, id));
        }
    }

    updateDisplay(){
        for(let i = 0; i<this.nbMessages; i++){
            alert(this.messages[i].getPseudo());
            let elt = document.getElementById('chat');
            let pe = document.createElement("p");
            pe.innerHTML = "<em>" + this.messages[i].getPseudo() + " à " + this.messages[i].getDateHeure() + "</em> - " + this.messages[i].getMessage();
            //elt.appendChild(pe);
            elt.insertBefore(pe, elt.firstChild);
        }
    }
}