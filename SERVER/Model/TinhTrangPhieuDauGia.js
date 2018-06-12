var db = require('../DB/db');

exports.loadAll = function() {
	var sql = 'select * from tinhtrangphieudaugia';
	return db.load(sql);
}

exports.load = function(id) {
	var sql = `select * from tinhtrangphieudaugia where matinhtrangphieudaugia = ${id}`;
	return db.load(sql);
}

exports.add = function(poco) {
	var sql = `insert into tinhtrangphieudaugia(tentinhtrang) values('${poco.tentinhtrang}') RETURNING *`;
	return db.insert(sql);
}

exports.delete = function(id) {
	var sql = `delete from tinhtrangphieudaugia where matinhtrangphieudaugia = ${id} RETURNING *`;
	return db.delete(sql);
}

exports.update = function(id, poco) {
	var sql = `update tinhtrangphieudaugia set tentinhtrang = '${poco.tentinhtrang}' where matinhtrangphieudaugia = ${id} RETURNING *`;
	return db.update(sql);
}