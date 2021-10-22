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
  
  router.post('/', asyncMiddleware(async (req, res)=> {
    console.log(req.files.actFile);
    let content = req.files.actFile.data.toString('utf-8');
    let json = JSON.parse(content); 
    console.log(json);

    let activity_date = json['activity']['date'];
    let activity_description = json['activity']['description'];
    let distance = calculDistance.calculDistanceTrajet(json);


    var msToTime = (duration) =>{
      var milliseconds = parseInt((duration % 1000) / 100),
      seconds = Math.floor((duration / 1000) % 60),
      minutes = Math.floor((duration / (1000 * 60)) % 60),
      hours = Math.floor((duration / (1000 * 60 * 60)) % 24);
  
      hours = (hours < 10) ? "0" + hours : hours;
      minutes = (minutes < 10) ? "0" + minutes : minutes;
      seconds = (seconds < 10) ? "0" + seconds : seconds;
  
      return hours + ":" + minutes + ":" + seconds + "." + milliseconds;
    }

    let diff = new Date(`${json['activity']['date']} ${json['data'][0]['time']}`) - new Date(`${json['activity']['date']} ${json['data'][json['data'].length-1]['time']}`);
    let timeDiff = msToTime(diff);
    console.log(timeDiff);
    let activity = {idAct:req.files.actFile.name, date:activity_date, description:activity_description, distance: distance, startTime: json['data'][0]['time'], ttTime:timeDiff, refUser:req.session.id};
    console.log(activity);
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
  }));

   module.exports = router;

   function asyncMiddleware(fn) {
    return (req, res, next) => {
      Promise.resolve(fn(req, res, next)).catch(next);
    }
  }