var db = require('../DB/db');

exports.loadAll = function() {
	var sql = 'select * from sanpham';
	return db.load(sql);
}

exports.load = function(id) {
	var sql = `select * from sanpham where masanpham = ${id}`;
	return db.load(sql);
}

exports.add = function(poco) {
	var sql = `insert into sanpham(tensanpham,maloaisanpham,dacta,hinhdaidien) values('${poco.tensanpham}','${poco.maloaisanpham}','${poco.dacta}','${poco.hinhdaidien}') RETURNING *`;
	return db.insert(sql);
}

exports.delete = function(id) {
	var sql = `delete from sanpham where masanpham = ${id} RETURNING *`;
	return db.delete(sql);
}