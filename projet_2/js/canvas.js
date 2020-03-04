
var canvas = {
    canvasElt:document.createElement("canvas"),
    clickX : new Array(),
    clickY : new Array(),
    clickDrag :new Array(),
    paint:false,
    effacer:document.createElement("button"),
    i:0,
    init:function(address){
        document.getElementById("canvas").innerHTML = "";                                                                                                                                           
        document.getElementById("canvas").appendChild(this.canvasElt);
        document.getElementById("canvas").style.display = "block";
        document.getElementById("canvas").style.width= "16%";
        document.getElementById("canvas").style.height = "155px";
        this.activationDessin();
        var context = this.canvasElt.getContext("2d");
        this.effacer.id = "effacer";
        this.effacer.textContent = "Effacer";
        document.getElementById("canvas").appendChild(this.effacer);
        var send = document.createElement("button");
        send.id = "send";
        send.textContent = "Envoyez";
        document.getElementById("canvas").appendChild(send);
        this.envoyer(address,send,context,this.clickY,this.clickX,this.clickDrag);
        this.clear(context,this.clickY,this.clickX,this.clickDrag);
    },
    activationDessin:function(){
        $('#canvas').mousedown(function(e){
            var mouseX = e.pageX - this.offsetLeft;
            var mouseY = e.pageY - this.offsetTop;  
            this.paint = true;
            canvas.addClick(mouseX,mouseY);
            canvas.redraw();
          });
          $('#canvas').mousemove(function(e){
            if(this.paint){
              canvas.addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
              canvas.redraw();
            }
          });
          $('#canvas').mouseup(function(e){
            this.paint = false;
          });
        },
    addClick:function(x,y,dragging){
        this.clickX.push(x);
        this.clickY.push(y);
        this.clickDrag.push(dragging);
    },
    redraw:function(){
            var context = this.canvasElt.getContext("2d");
            context.clearRect(0, 0, context.canvas.width, context.canvas.height);
            context.strokeStyle = "#000";
            context.lineJoin = "round";
            context.lineWidth = 5;
            for(var i=0; i < this.clickX.length; i++) {		
              context.beginPath();
             if(this.clickDrag[i] && i){
                context.moveTo(this.clickX[i-1], this.clickY[i-1]);
              }else{
                 context.moveTo(this.clickX[i]-1, this.clickY[i]);
               }
               context.lineTo(this.clickX[i],this.clickY[i]);
               context.closePath();
               context.stroke();
            }
    },
    envoyer:function(address,send,context,clickY,clickX,clickDrag){
        send.addEventListener("click",function(){
            document.getElementById("canvas").style.display = "none";
            context.clearRect(0, 0, context.canvas.width, context.canvas.height);
            clickDrag.length = 0;
            clickX.length = 0;
            clickY.length = 0;
            var Mytimer = Object.create(timer);
            Mytimer.init(address);
        })
    },
    clear:function(context,clickY,clickX,clickDrag){
    this.effacer.addEventListener("click",function(){
        context.clearRect(0, 0, context.canvas.width, context.canvas.height);
        clickDrag.length = 0;
        clickX.length = 0;
        clickY.length = 0;
    });
    }
}