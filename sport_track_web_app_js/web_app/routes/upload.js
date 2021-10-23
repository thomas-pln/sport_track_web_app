var express = require('express');
var uploadFile = require('express-fileupload');
var calculDistance = require('sport-track-db').calculDistance;
var activity_dao = require('sport-track-db').activity_dao;
var activity_entry_dao = require('sport-track-db').activity_entry_dao;


   var router = express.Router();
   var user_dao = require('sport-track-db').user_dao;

   
   router.get('/', asyncMiddleware(async (request, response, next) => {
     if(request.session.logged == true){
      response.render("upload");
     }else{
       response.redirect("/connect"/*, {success : "Connectez vous pour importer vos activités."}*/)
     }
  }))
  
  /**
   * Traite l'envoie du fichier de données d'une nouvelle activité
   */
  router.post('/', asyncMiddleware(async (req, res)=> {
    let content = req.files.actFile.data.toString('utf-8');
    let json = JSON.parse(content);  //Contenu du fichier

    let activity_date = json['activity']['date'];
    let activity_description = json['activity']['description'];
    let distance = calculDistance.calculDistanceTrajet(json); //Calcul distance

    //Calcul de durée de l'activité
    let d1 = new Date(`${json['activity']['date']} ${json['data'][0]['time']}`);
    let d2 = new Date(`${json['activity']['date']} ${json['data'][json['data'].length-1]['time']}`);
    let diff = Math.abs(d1 - d2);
    let options = {minute: "numeric", second: "numeric", hour12: false};
    let timeDiff = new Intl.DateTimeFormat("fr-FR", options).format(diff);

    let activity = {idAct:req.files.actFile.name, date:activity_date, description:activity_description, distance: distance, startTime: json['data'][0]['time'], ttTime:timeDiff, refUser:req.session.idUser};
    try{
      let insertedAct = await activity_dao.insert(activity);

      for(data of json['data']){
        let dataAct = {time:data['time'], cardio:data['cardio_frequency'], long:data['latitude'], lat:data['longitude'], alti:data['altitude'], dataAct:req.files.actFile.name};
        await activity_entry_dao.insert(dataAct);
      }
      if(insertedAct){
        res.redirect('/activities');
      }else{
        res.render("upload", {state: "Le fichier n'a pas pu être importé"})
      }
    }catch(e){
      //Si il y a une erreur c'est probablement que l'activité existe déjà
      res.render("upload", {state: "L'activité est déjà existante"})
    }
  }));

   module.exports = router;

   function asyncMiddleware(fn) {
    return (req, res, next) => {
      Promise.resolve(fn(req, res, next)).catch(next);
    }
  }