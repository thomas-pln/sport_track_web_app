
var inst;
let pdo;

    function construct(){
        try{
            this.pdo = new PDO('sqlite:../BDD/sport_track.db'); 
            this.pdo.setAttribute(PDO.ATTR_PERSISTENT, true);
            this.pdo.setAttribute(PDO.ATTR_ERRMODE, PDO.ERRMODE_EXCEPTION);
        }
        catch (e) {
            console.log( "Error!: " + e.getMessage() + "\n");
            die();
        }

        
    }

        function getInstance(){
            if(inst === undefined) {
                this.inst = new SqliteConnection();
            }
            return inst;
        }
        
        function getConnection(){
            return this.pdo;
        }
    
    // Query to mysql server 
    mysqlJson.query(mysqlQuery, callback);

    // Insert a new row with JSON data 
    mysqlJson.insert(tableName, dataToInsert, callback);

    // Update some row(s) matching with JSON conditions 
    mysqlJson.update(tableName, data, conditions, callback);

    // Delete some row(s) matching with JSON conditions 
    mysqlJson.delete(tableName, conditions, callback);


throw "Erreur2"; // type String
throw 32;        // type Numberthrow true;      // type Boolean
throw {toString: function() {return "je suis un objet !";}};
throw "Erreur2"; // type Stringthrow 32;        // type Number
throw true;      // type Boolean
throw {toString: function() {return "je suis un objet !";}};
try{
    écrireFichier(données); // une erreur peut se produire
}
catch(e){
    gérerException(e); // On gère le cas où on a une exception    
} finally{
    fermetFichier(); // On n'oublie jamais de fermer le flux.}
try{
    écrireFichier(données); // une erreur peut se produire
}catch(e){
    gérerException(e); // On gère le cas où on a une exception    
} finally{
    fermetFichier(); // On n'oublie jamais 
