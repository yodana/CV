var timer = {
    minutes:20,
    secondes:0,
    minutesElt:document.createElement("h1"),
    secondesElt:document.createElement("h1"),
    reservationElt : document.createElement("h1"),
    timerElt:document.createElement("div"),
    donne: document.createElement("p"),
    i:1,
    j:0,
    init:function(address){
        this.timerElt.id = "timerElt";
        document.getElementById("timer").innerHTML = "";
        this.reservationElt.textContent = "La reservation pour la station " + address + " s'annule dans: ";
        this.reservationElt.id = "reservation";
        this.minutesElt.id = "minutes";
        this.secondesElt.id = "secondes";
        document.getElementById("timer").appendChild(this.reservationElt);
        document.getElementById("timer").appendChild(this.timerElt);
        this.donne.textContent = "ok";
        if (this.j === 0){
            setInterval("timer.start()",1000);
            this.donne.textContent = "pasok";
        }
    },
    start:function(){
        this.j++;
        if(this.donne.textContent === "ok"){
            this.minutes = 20;
            this.secondes = 0;
            this.i = 1;
            this.donne.textContent = "pasok";
        }
        if(this.i <= 0)
            this.secondes--;
        this.i--;
        if(this.minutes < 10){
            this.minutesElt.textContent = "0" + this.minutes + ":";
        }
        else
            this.minutesElt.textContent = " " + this.minutes + ":";
        if(this.secondes < 10){
            this.secondesElt.textContent = "0" + this.secondes;
            if(this.secondes <= 0 && this.minutes !== 0){
                this.secondes = 60;
                this.minutes--;
            }
        }
        else
            this.secondesElt.textContent = this.secondes;
        if(this.minutes === 0 && this.secondes <= 0){
            document.getElementById("reservation").innerHTML = "La reservation est annulée";
            document.getElementById("minutes").innerHTML = "";
            document.getElementById("secondes").innerHTML = "";
            this.minutes = 0;
            this.secondes = 0;
        }
        document.getElementById("timerElt").appendChild(this.minutesElt);
        document.getElementById("timerElt").appendChild(this.secondesElt);
    }
}