var db = require('./sqlite_connection');

var ActivityDAO = function(){
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

    this.userActiv = function(user){
      return new Promise((resolve, reject) => {
        let query = `SELECT * FROM Activity WHERE refUser = "${user.idUser}"`;
        db.all(query, (error, rows) => {
          if (error) {
              reject(error);
          }
          resolve(rows);
        });
      });
    }
        

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