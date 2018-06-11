var db = require('../DB/db');

exports.loadAll = function() {
	var sql = 'select * from tinhtrangphiendaugia';
	return db.load(sql);
}

exports.load = function(id) {
	var sql = `select * from tinhtrangphiendaugia where matinhtrangphiendaugia = ${id}`;
	return db.load(sql);
}

exports.add = function(poco) {
	var sql = `insert into tinhtrangphiendaugia(tentinhtrangphiendaugia) values('${poco.tentinhtrangphiendaugia}') RETURNING *`;
	return db.insert(sql);
}

exports.delete = function(id) {
	var sql = `delete from tinhtrangphiendaugia where matinhtrangphiendaugia = ${id} RETURNING *`;
	return db.delete(sql);
}

exports.update = function(id, poco) {
	var sql = `update tinhtrangphiendaugia set tentinhtrangphiendaugia = '${poco.tentinhtrangphiendaugia}' where matinhtrangphiendaugia = ${id} RETURNING *`;
	return db.update(sql);
}