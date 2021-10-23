var express = require('express');
var router = express.Router();
var user_dao = require('sport-track-db').user_dao;

/**
 * Déconnexion, suppression de la variable de session
 */
router.get('/',(req,res) => {
    req.session.logged = false;
    req.session.destroy((err) => {
        if(err) {
            return console.log(err);
        }
        res.redirect('/connect');
    });
    //req.session.email = null;

});

module.exports = router;