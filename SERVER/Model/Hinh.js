var db = require('../DB/db');

exports.loadAll = function() {
	var sql = 'select * from hinh';
	return db.load(sql);
}

exports.load = function(id) {
	var sql = `select * from hinh where mahinh = ${id}`;
	return db.load(sql);
}

exports.add = function(poco) {
	var sql = `insert into hinh(duongdan,masanpham) values('${poco.duongdan}','${poco.masanpham}') RETURNING *`;
	return db.insert(sql);
}

exports.delete = function(id) {
	var sql = `delete from hinh where mahinh = ${id} RETURNING *`;
	return db.delete(sql);
}

exports.update = function(id, poco) {
	var sql = `update hinh set duongdan = '${poco.duongdan}', masanpham = '${poco.masanpham}' where mahinh = ${id} RETURNING *`;
	return db.update(sql);
}