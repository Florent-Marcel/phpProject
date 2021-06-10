class Message{
    constructor(pseudo, message, dateHeure, id){
        this.pseudo = pseudo;
        this.message = message;
        this.dateHeure = dateHeure;
        this.id = id;
    }

    getPseudo(){
        return this.pseudo;
    }

    getMessage(){
        return this.message;
    }

    getDateHeure(){
        return this.dateHeure;
    }

    getId(){
        return this.id;
    }
}