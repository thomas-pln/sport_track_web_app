var express = require('express');

var router = express.Router();
var user_dao = require('sport-track-db').user_dao;
   
   router.get('/', asyncMiddleware(async (req, res, next) => {
    
    console.log(req.session);
    console.log(req.session.logged );
    res.render("connect");

  }))
  
  router.post('/', asyncMiddleware(async (req, res)=> {
    let email = req.body.emailA;
    let password = req.body.pwd;

    let users = await user_dao.findByEmail(email);
    console.log(users);

    if(users.length == 0){

      res.render("connect", {errUser : "Utilisateur incorrect. Veuillez créer un compte en premier."})
    
    }else{

      if(users[0].pwd === password){

        req.session.logged = true;
        req.session.email = email;
        req.session.id = users[0].idUser;
        console.log("Ok");
        res.render("connect", {success: "Vous êtes connecté."});
      
      }else{
        res.render("connect", {success: "Mot de passe incorrect."});
      
      }
    }
  }));

   module.exports = router;

   function asyncMiddleware(fn) {
    return (req, res, next) => {
      Promise.resolve(fn(req, res, next)).catch(next);
    }
  }