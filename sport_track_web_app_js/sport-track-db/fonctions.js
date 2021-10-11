const fs = require('fs');



const calculDistance2PointsGPS = (lat1, long1, lat2, long2)=>{
    let R=6378.137;
    lat1 = Math.PI*lat1/180;
    long1 = Math.PI*long1/180;
    lat2 = Math.PI*lat2/180;
    long2 = Math.PI*long2/180;
    let d = R*Math.acos(Math.sin(lat2)*Math.sin(lat1)+Math.cos(lat2)*Math.cos(lat1)*Math.cos(long2-long1));
    return d;
}

const calculDistanceTrajet = (parcours) =>{
    parcours = parcours['data'];
    let distance =0;
    for (let i = 1; i < parcours.length; i++) {
        distance += calculDistance2PointsGPS(parcours[i-1]['latitude'], parcours[i-1]['longitude'], parcours[i]['latitude'], parcours[i]['longitude']);   
    }
    return distance;
}

var activity = fs.readFileSync('./donnees.json', 'utf-8');
activity = JSON.parse(activity);

  console.log(calculDistanceTrajet(activity));