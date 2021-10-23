/**
 * Connection à la base de donnée
 */
const sqlite3 = require('sqlite3').verbose();
  
  let db = new sqlite3.Database(__dirname+'/sport_track.db', sqlite3.OPEN_READWRITE, (err) => {
    if (err) {
      return console.error(err.message);
    }
    console.log('Connected to SQlite database.');
   });
   

module.exports = db;

