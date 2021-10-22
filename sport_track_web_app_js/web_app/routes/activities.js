var express = require('express');

  var router = express.Router();
  var activity_dao = require('sport-track-db').activity_dao;
  var user_dao = require('sport-track-db').user_dao;
   
   router.get('/', asyncMiddleware(async (request, response, next) => {
    if(request.session.logged == true){
      let users = await user_dao.findByEmail(request.session.email);
      let activities = await activity_dao.userActiv(request.session.id);
      response.render("activities", {data:activities, user:users[0]});
    }else{
      response.redirect("/connect")
    }
  }))
  
   module.exports = router;

   function asyncMiddleware(fn) {
    return (req, res, next) => {
      Promise.resolve(fn(req, res, next)).catch(next);
    }
  }