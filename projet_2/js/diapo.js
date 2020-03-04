var diapo ={
    i : 0,
    tabImg:[],
    j:0,
    text1:document.createElement("h1"),
    text2:document.createElement("h1"),
    text3:document.createElement("h1"),
    init: function(img1,img2,img3){
        this.tabImg = [img1,img2,img3];
        this.i = 0;
        this.ajoutDiapo(img1,img2,img3);
        this.nextDiapo(img1,img2,img3);
    },
    ajoutDiapo:function(img1,img2,img3){
        document.getElementById("diapo").innerHTML = "";
        this.tabImg = [img1,img2,img3];
        var descrip = document.createElement("div");
        descrip.id = "description";
        if (this.i === 0)
            descrip.textContent = "Bienvenue sur le site de vélo en location de Lyon";
        if (this.i === 1)
            descrip.textContent = "Choisissez le lieu de location de vélo sur la carte";
        if (this.i === 2)
            descrip.textContent = "Cliquez sur reservez, signez et le vélo est à vous!";
        document.getElementById("diapo").appendChild(descrip);
        var img = document.createElement("img");
        img.src = this.tabImg[this.i];
        img.style.width = "100%";
        document.getElementById("diapo").appendChild(img);
        var buttonLeft = document.createElement("button");
        buttonLeft.id = "buttonLeft";
        buttonLeft.textContent = "<";
        document.getElementById("diapo").appendChild(buttonLeft);
        buttonLeft.addEventListener("click",function(){
            diapo.leftDiapo(img1,img2,img3);
        })
        var buttonRight = document.createElement("button");
        buttonRight.id = "buttonRight";
        buttonRight.textContent = ">";
        document.getElementById("diapo").appendChild(buttonRight);
        buttonRight.addEventListener("click",function(){
            diapo.rightDiapo(img1,img2,img3);
        })
    },
    nextDiapo:function(img1,img2,img3){
        window.addEventListener("keydown", function(e) {
            if (e.keyCode === 37) {
               diapo.leftDiapo(img1,img2,img3);
            } else if (e.keyCode === 39) {
                diapo.rightDiapo(img1,img2,img3);
            }
        })
    },
    leftDiapo:function(img1,img2,img3){
        console.log("LEFT");
        if(this.i !== 0)
            this.i--;
        this.ajoutDiapo(img1,img2,img3);
    },
    rightDiapo:function(img1,img2,img3){
        if(this.i !== 2)
            this.i++;
        this.ajoutDiapo(img1,img2,img3);
    }
};
