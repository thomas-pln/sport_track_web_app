var express = require('express');

   var router = express.Router();
   var user_dao = require('sport-track-db').user_dao;

   
   router.get('/', asyncMiddleware(async (request, response, next) => {
       console.log(request.session);
       response.render("connect");
  }))
  
  router.post('/', asyncMiddleware(async (req, res)=> {
    console.log(req.body);
    req
  }));


   module.exports = router;

   function asyncMiddleware(fn) {
    return (req, res, next) => {
      Promise.resolve(fn(req, res, next)).catch(next);
    }
  }