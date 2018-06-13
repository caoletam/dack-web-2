var db = require('../DB/db');

exports.loadAll = function() {
	var sql = 'select * from thamso';
	return db.load(sql);
}

exports.load = function(id) {
	var sql = `select * from thamso where mathamso = ${id}`;
	return db.load(sql);
}

exports.add = function(poco) {
	var sql = `insert into thamso(tenthamso,giatri) values('${poco.tenthamso}','${poco.giatri}') RETURNING *`;
	return db.insert(sql);
}

exports.delete = function(id) {
	var sql = `delete from thamso where mathamso = ${id} RETURNING *`;
	return db.delete(sql);
}

exports.update = function(id, poco) {
	var sql = `update thamso set tenthamso = '${poco.tenthamso}', giatri = '${poco.giatri}' where mathamso = ${id} RETURNING *`;
	return db.update(sql);
}