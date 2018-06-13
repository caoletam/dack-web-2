var db = require('../DB/db');

exports.loadAll = function() {
	var sql = 'select * from loaisanpham';
	return db.load(sql);
}

exports.load = function(id) {
	var sql = `select * from loaisanpham where maloaisanpham = ${id}`;
	return db.load(sql);
}

exports.add = function(poco) {
	var sql = `insert into loaisanpham(tenloaisanpham) values('${poco.tenloaisanpham}') RETURNING *`;
	return db.insert(sql);
}

exports.delete = function(id) {
	var sql = `delete from loaisanpham where maloaisanpham = ${id} RETURNING *`;
	return db.delete(sql);
}

exports.update = function(id, poco) {
	var sql = `update loaisanpham set tenloaisanpham = '${poco.tenloaisanpham}' where maloaisanpham = ${id} RETURNING *`;
	return db.update(sql);
}