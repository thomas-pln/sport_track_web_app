var express = require('express');

   var router = express.Router();
   var user_dao = require('sport-track-db').user_dao;

   
   router.get('/', asyncMiddleware(async (request, response, next) => {
    response.render("users");
  }))
  
  router.post('/', asyncMiddleware(async (req, res)=> {
    console.log(req.body);

    let users = await user_dao.findByEmail(req.body.emailA);

    console.log(users);

    if(users.length>0){
      res.render("users", {errMail : "Email déjà utilisée"})
    }else{
      let insert = false;
      try{
        insert = await user_dao.insert({fName:req.body.fname, lName:req.body.lname, sexe:req.body.gender, birthday:req.body.birthday, height:req.body.height, weight:req.body.weight, email:req.body.emailA, pwd:req.body.pwd});
      }catch(e){
      }
      if(insert){
        console.log("Ok");
        res.render("users", {success: "Félicitation, vous venez de créer votre compte !"});
      }else{
        res.render("users", {success: "La création de votre compte a échoué :("});
      }
    }
  }));


   module.exports = router;

   function asyncMiddleware(fn) {
    return (req, res, next) => {
      Promise.resolve(fn(req, res, next)).catch(next);
    }
  }