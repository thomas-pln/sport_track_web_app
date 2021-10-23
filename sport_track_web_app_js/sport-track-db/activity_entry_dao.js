var db = require('./sqlite_connection');

var ActivityEntryDAO = function(){
  /**
   * Insère une donnée d'une activité dans la base
   * @param {*} data 
   * @returns 
   */
    this.insert = function(data){
            return new Promise((resolve, reject)=>{
                let query = `INSERT INTO Data(time, cardio, long, lat, alti, dataAct) VALUES ("${data.time}",${data.cardio},${data.long},${data.lat},${data.alti},"${data.dataAct}")`;
              db.run(query, (error)=>{
                if (error) {
                  reject(error);
                }
                resolve(true);
              });
            });
        }

        /**
         * Retourne toutes les données de toute les activités
         * @returns
         */
    this.findAll = function(){
        return new Promise((resolve, reject) => {
            let query = `SELECT * FROM Data`;
          db.all(query, (error, rows) => {
            if (error) {
                reject(error);
            }
            resolve(rows);
          });
        });
    }

    /**
     * Supprime une donnée
     * @param {*} data 
     * @returns 
     */
    this.delete = function(data){
      return new Promise((resolve, reject)=>{
          let query = `DELETE FROM Data WHERE idData = ${data.idData}`;
        db.run(query, (error)=>{
          if (error) {
            reject(error);
          }
          resolve(true);
        });
      });
    }

    this.userActiv = function(user){
      return new Promise((resolve, reject) => {
        let query = `SELECT * FROM Data WHERE dataAct = "${activity.idAct}"`;
        db.all(query, (error, rows) => {
          if (error) {
              reject(error);
          }
          resolve(rows);
        });
      });
    }
        

    /**
     * Met à jour une donnée
     * @param {} data 
     * @returns 
     */
    this.update = function(data){
      return new Promise((resolve, reject) => {
        let query = `UPDATE Data SET cardio=${data.cardio}, long=${data.long}, lat=${data.lat}, alti=${data.alti} WHERE ${data.idData} = idData`;
        db.all(query, (error) => {
          if (error) {
              reject(error);
          }
          resolve(true);
        });
      });
    }
}

var activity_entry_dao = new ActivityEntryDAO();

module.exports = activity_entry_dao;