var db = require('../DB/db');

exports.loadAll = function() {
	var sql = 'select * from loaitaikhoan';
	return db.load(sql);
}

exports.load = function(id) {
	var sql = `select * from loaitaikhoan where maloaitaikhoan = ${id}`;
	return db.load(sql);
}

exports.add = function(poco) {
	var sql = `insert into loaitaikhoan(tenloaitaikhoan) values('${poco.tenloaitaikhoan}') RETURNING *`;
	return db.insert(sql);
}

exports.delete = function(id) {
	var sql = `delete from loaitaikhoan where maloaitaikhoan = ${id} RETURNING *`;
	return db.delete(sql);
}

exports.update = function(id, poco) {
	var sql = `update loaitaikhoan set tenloaitaikhoan = '${poco.tenloaitaikhoan}' where maloaitaikhoan = ${id} RETURNING *`;
	return db.update(sql);
}