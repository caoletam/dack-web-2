var db = require('../DB/db');

exports.loadAll = function() {
	var sql = 'select * from phieudaugia';
	return db.load(sql);
}

exports.load = function(id) {
	var sql = `select * from phieudaugia where maphieudaugia = ${id}`;
	return db.load(sql);
}

exports.add = function(poco) {
	var sql = `insert into phieudaugia(maphiendaugia,mataikhoan,giadau,matinhtrangphieudaugia) values('${poco.maphiendaugia}','${poco.mataikhoan}','${poco.giadau}','${poco.matinhtrangphieudaugia}') RETURNING *`;
	return db.insert(sql);
}

exports.delete = function(id) {
	var sql = `delete from phieudaugia where maphieudaugia = ${id} RETURNING *`;
	return db.delete(sql);
}

exports.update = function(id, poco) {
	var sql = `update phieudaugia set maphiendaugia = '${poco.maphiendaugia}', mataikhoan = '${poco.mataikhoan}', giadau = '${poco.giadau}', matinhtrangphieudaugia = '${poco.matinhtrangphieudaugia}' where maphieudaugia = ${id} RETURNING *`;
	return db.update(sql);
}