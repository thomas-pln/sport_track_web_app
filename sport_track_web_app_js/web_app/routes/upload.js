var express = require('express');
var uploadFile = require('express-fileupload');
var distanceCalc = require('sport-track-db').distance;
var activity_dao = require('sport-track-db').activity_dao;
var activity_entry_dao = require('sport-track-db').activity_entry_dao;


   var router = express.Router();
   var user_dao = require('sport-track-db').user_dao;

   
   router.get('/', asyncMiddleware(async (request, response, next) => {
       response.render("upload");
  }))
  
  router.post('/', asyncMiddleware(async (req, res)=> {
    console.log(req.files.actFile);
    let content = req.files.actFile.data.toString('utf-8');
    let json = JSON.parse(content); 
    console.log(json);
    
    var activity_date = json['activity']['date'];
    var activity_description = json['activity']['description'];
    var distance = distanceCalc.calculDistanceTrajet(json);
  }));

   module.exports = router;

   function asyncMiddleware(fn) {
    return (req, res, next) => {
      Promise.resolve(fn(req, res, next)).catch(next);
    }
  }