const fs = require('fs');

function CalculDistance(){
}

CalculDistance.prototype.calculDistance2PointsGPS = function(lat1, long1, lat2, long2){
    let R=6378.137;
    lat1 = Math.PI*lat1/180;
    long1 = Math.PI*long1/180;
    lat2 = Math.PI*lat2/180;
    long2 = Math.PI*long2/180;
    let d = R*Math.acos(Math.sin(lat2)*Math.sin(lat1)+Math.cos(lat2)*Math.cos(lat1)*Math.cos(long2-long1));
    return d;
}


CalculDistance.prototype.calculDistanceTrajet = function(parcours){
    parcours = parcours['data'];
    var distance =0;
    for (let i = 1; i < parcours.length; i++) {
        distance += this.calculDistance2PointsGPS(parcours[i-1]['latitude'], parcours[i-1]['longitude'], parcours[i]['latitude'], parcours[i]['longitude']);   
    }
    return distance;
}


let calculDist = new CalculDistance();
let donnees = JSON.parse(fs.readFileSync('./donnees.json', 'utf-8'));
console.log(calculDist.calculDistanceTrajet(donnees));