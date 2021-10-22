var db_connection = require('./sqlite_connection');
var user_dao = require('./user_dao');
var activityDAO = require('./activity_dao');
var activityEntryDAO = require('./activity_entry_dao');
var calculDistance = require('./distance')
module.exports = {db: db_connection, user_dao: user_dao, activity_dao : activityDAO, activity_entry_dao : activityEntryDAO, calculDistance};