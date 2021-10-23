
var CalculDistance = function(){
    /**
     * Calcul la disntance entre 2 points à partir de 2 points GPS
     * @param {*} lat1 
     * @param {*} long1 
     * @param {*} lat2 
     * @param {*} long2 
     * @returns 
     */
    this.calculDistance2PointsGPS = (lat1, long1, lat2, long2)=>{
        let R=6378.137;
        lat1 = Math.PI*lat1/180;
        long1 = Math.PI*long1/180;
        lat2 = Math.PI*lat2/180;
        long2 = Math.PI*long2/180;
        let d = R*Math.acos(Math.sin(lat2)*Math.sin(lat1)+Math.cos(lat2)*Math.cos(lat1)*Math.cos(long2-long1));
        return d;
    }
    /**
     * Calcul la distance d'un trajet
     * @param {*} parcours 
     * @returns 
     */
    this.calculDistanceTrajet = (parcours) =>{
        parcours = parcours['data'];
        let distance =0;
        for (let i = 1; i < parcours.length; i++) {
            distance += this.calculDistance2PointsGPS(parcours[i-1]['latitude'], parcours[i-1]['longitude'], parcours[i]['latitude'], parcours[i]['longitude']);   
        }
        return distance;
    }

}

var calculDistance = new CalculDistance();

module.exports = calculDistance;