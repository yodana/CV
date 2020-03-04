var googleMap ={
    carte : document.createElement("div"),
    i:0,
    init:function(){
       this.carte.id = "carte";
       document.getElementById("map").appendChild(this.carte);
         map = new google.maps.Map(document.getElementById('carte'),{
            center: {lat: 45.750, lng: 4.830},
           zoom: 13
          });
        },
         placerMarqueur:function(stations){
            stations.forEach(function(station) {
                if(station.status === "OPEN" && station.available_bikes > 0){
                var marqueur = new google.maps.Marker({
                map:map,
                position:station.position,
                icon:"http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|008100"
            });
            marqueur.addListener("click",function(){
                googleMap.infoVelo(station);
            })
            }
            else if (station.status === "OPEN" && station.available_bikes <= 0){
                var marqueur = new google.maps.Marker({
                    map:map,
                    position:station.position,
                    icon:"http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|FFFF00"
                });
                 marqueur.addListener("click",function(){
                googleMap.infoVelo(station);
            })
            }
            else{
            var marqueur = new google.maps.Marker({
                map:map,
                position:station.position,
                icon:"http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|FE7569"
            })
            marqueur.addListener("click",function(){
                googleMap.infoVelo(station);
            })
        }
            })
        },
    infoVelo:function(station){
        var cadre = document.createElement("div");
        cadre.id = "cadre";
        var error = document.createElement("p");
        error.id = "error";
        document.getElementById("map").appendChild(cadre);
        document.getElementById("cadre").innerHTML = "";
        if (station.status === "OPEN"){
            var nom = document.createElement("p");
            nom.id = "nom";
            var adresse = document.createElement("p");
            var veloDispo = document.createElement("p");
            var buttonReserver = document.createElement("button");
            buttonReserver.id = "reserver";
            buttonReserver.textContent = "Reserver";
            if (station.available_bikes > 0){
                veloDispo.textContent = "Velos disponibles: " + station.available_bikes;
                nom.textContent = "Nom: " + station.name;
                adresse.textContent = "Adresse: " + station.address;
                document.getElementById("carte").style.width = "50%";
                document.getElementById("carte").style.marginLeft = "25%";
                document.getElementById("cadre").appendChild(nom);
                document.getElementById("cadre").appendChild(adresse);
                document.getElementById("cadre").appendChild(veloDispo);
                document.getElementById("cadre").appendChild(buttonReserver);
                buttonReserver.addEventListener("click",function(){
                    var myCanvas = Object.create(canvas);
                    myCanvas.init(station.name);
                });
                }
            else{
                document.getElementById("carte").style.width = "50%";
                document.getElementById("carte").style.marginLeft = "25%";
                error.textContent = "Pas de vélo disponible";
                document.getElementById("cadre").appendChild(error);
            }
        }
        else{
            document.getElementById("carte").style.width = "50%";
            document.getElementById("carte").style.marginLeft = "25%";
            error.textContent = "Station fermée";
            document.getElementById("cadre").appendChild(error);
        }
    }
}

ajaxGet("https://api.jcdecaux.com/vls/v1/stations?contract=lyon&apiKey=fcc6a363a626574d3a760bb57cad5c89b446200b",function(reponse){
            var stations = JSON.parse(reponse);
            var myGoogleMap = Object.create(googleMap);
            myGoogleMap.init();
            myGoogleMap.placerMarqueur(stations);
})