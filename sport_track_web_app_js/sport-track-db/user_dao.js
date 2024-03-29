var db = require('./sqlite_connection');

var UserDAO = function(){

  /**
   * Insère un utilisateur dans la base
   * @param {*} user 
   * @returns 
   */
    this.insert = function(user){
        return new Promise((resolve, reject)=>{
            let query =`INSERT INTO User(fName, lName, sexe, birthday, height, weight, email, pwd) VALUES ("${user.fName}", "${user.lName}", "${user.sexe}", "${user.birthday}", ${user.height}, ${user.weight},"${user.email}", "${user.pwd}" )`;
        db.run(query, (error)=>{
            if (error) {
                console.log(error);
              reject(error);
            }
            resolve(true);
          });
        });
    };

    /**
     * Met à jour jour un utilisateur dans la base
     * @param {*} user 
     * @returns 
     */
    this.update = function(user){
        return new Promise((resolve, reject)=>{
            let query =`UPDATE User SET (fName, lName, sexe, birthday, height, weight, email, pwd) VALUES ("${user.fName}", "${user.lName}", "${user.sexe}", "${user.birthday}", ${user.height}, ${user.weight},"${user.email}", "${user.pwd}" ) WHERE idUser = ${user.id}`;
        db.run(query, (error)=>{
            if (error) {
                console.log(error);
              reject(error);
            }
            resolve(true);
          });
        });     
    };

    /**
     * Supprime un utilisateur de la base
     * @param {*} user 
     * @returns 
     */
    this.delete = function(user){
        return new Promise((resolve, reject)=>{
            let query =`DELETE FROM User WHERE idUser = ${user.id}`;
        db.run(query, (error)=>{
            if (error) {
                console.log(error);
              reject(error);
            }
            resolve(true);
          });
        });
    };

    /**
     * Retourne tous les utilisateurs de la base
     * @param {*} user 
     * @returns 
     */
    this.findAll = function(user){
        return new Promise((resolve, reject) => {
            let query = `SELECT * FROM User`;
          db.all(query, (error, rows) => {
            if (error) {
                reject(error);
            }
            resolve(rows);
          });
        });        
    };

    /**
     * Récupère les information d'un utilisateur pas son email
     * @param {*} userEmail 
     * @returns 
     */
    this.findByEmail = function(userEmail){
      return new Promise((resolve, reject) => {
          let query = `SELECT * FROM User WHERE email = "${userEmail}"`;
        db.all(query, (error, rows) => {
          if (error) {
              reject(error);
          }
          resolve(rows);
        });
      });        
  };

    this.findByKey = function(user, key){
        return new Promise((resolve, reject) => {
            let query = `SELECT ${key} FROM User WHERE idUser = ${user.id}`;
          db.get(query, (error, rows) => {
            if (error) {
                reject(error);
            }
            resolve(rows);
          });
        }); 
        //db.get(`SELECT ${user.key} FROM User WHERE idUser = ${user.id}`, callback);
    };

};
var user_dao = new UserDAO();
module.exports = user_dao;