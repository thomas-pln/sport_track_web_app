var db = require('./sqlite_connection');


var ActivityDAO = function(){
  /**
   * Inserère une nouvelle activité dans la base
   * @param {*} activity 
   * @returns 
   */
    this.insert = function(activity){
            return new Promise((resolve, reject)=>{
                let query = `INSERT INTO Activity(idAct, date, description, distance, startTime, ttTime, refUser) VALUES ("${activity.idAct}","${activity.date}","${activity.description}",${activity.distance},"${activity.startTime}","${activity.ttTime}",${activity.refUser})`;
              db.run(query, (error)=>{
                if (error) {
                    console.log(error);
                  reject(error);
                }
                resolve(true);
              });
            });
        }

        /**
         * Retourne toutes les activités de la base 
         * @returns 
         */
    this.findAll = function(){
        return new Promise((resolve, reject) => {
            let query = `SELECT * FROM Activity`;
          db.all(query, (error, rows) => {
            if (error) {
                reject(error);
            }
            resolve(rows);
          });
        });
    }

    /**
     * Supprime une activité de la base à partir de son identifiant
     * @param {*} activity 
     * @returns 
     */
    this.delete = function(activity){
      return new Promise((resolve, reject)=>{
          let query = `DELETE FROM Activity WHERE idAct = "${activity.idAct}"`;
        db.run(query, (error)=>{
          if (error) {
            reject(error);
          }
          resolve(true);
        });
      });
    }

    /**
     * Retourne toutes les activités liées à un utilisateur
     * @param {*} idUser 
     * @returns 
     */
    this.userActiv = function(idUser){
      return new Promise((resolve, reject) => {
        let query = `SELECT * FROM Activity WHERE refUser = ${idUser}`;
        db.all(query, (error, rows) => {
          if (error) {
              reject(error);
          }
          resolve(rows);
        });
      });
    }
        

    /**
     * Modifie une acitvité
     * @param {*} activity 
     * @returns 
     */
    this.update = function(activity){
      return new Promise((resolve, reject) => {
        let query = `UPDATE Activity SET date="${activity.date}", description="${activity.description}" WEHERE idAct="${activity.idAct}"`;
        db.all(query, (error) => {
          if (error) {
              reject(error);
          }
          resolve(true);
        });
      });
    }
}

var activity_dao = new ActivityDAO();

module.exports = activity_dao;