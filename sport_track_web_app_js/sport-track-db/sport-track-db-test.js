var user_dao = require('./sport-track-db').user_dao;
var db = require('./sport-track-db').db_connection;

/*
let values = {"fName":"Hector", "lName":"Henri", "birthday":"25/01/2000", "sexe":"F", "height":156, "weight":52, "email":"haha@pigeon.fr", "pwd":"ddejzuLLLeku"};
user_dao.insert(values);*/

var tests = async function(){
    let users = await user_dao.findAll();
    console.log(users);
}


tests();