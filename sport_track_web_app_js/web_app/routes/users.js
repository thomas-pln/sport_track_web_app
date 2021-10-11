var express = require('express');

   var router = express.Router();
   var user_dao = require('sport-track-db').user_dao;
   router.get('/', asyncMiddleware(async (request, response, next) => {

    var app = express();
    app.post();

    const users = await user_dao.findAll();
    
    response.render("users", { users });
  }))
   module.exports = router;


   function asyncMiddleware(fn) {
    return (req, res, next) => {
      Promise.resolve(fn(req, res, next)).catch(next);
    }
  }