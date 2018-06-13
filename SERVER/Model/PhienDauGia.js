var db = require('../DB/db');

exports.loadAll = function() {
	var sql = 'select * from phiendaugia';
	return db.load(sql);
}

exports.load = function(id) {
	var sql = `select * from phiendaugia where maphiendaugia = ${id}`;
	return db.load(sql);
}

exports.add = function(poco) {
	var sql = `insert into phiendaugia(masanpham,thoigiandau,giathapnhat,giahientai,maphieuthang,matinhtrangphiendaugia) values('${poco.masanpham}','${poco.thoigiandau}','${poco.giathapnhat}','${poco.giahientai}','${poco.maphieuthang}','${poco.matinhtrangphiendaugia}') RETURNING *`;
	return db.insert(sql);
}

exports.delete = function(id) {
	var sql = `delete from phiendaugia where maphiendaugia = ${id} RETURNING *`;
	return db.delete(sql);
}

exports.update = function(id, poco) {
	var sql = `update phiendaugia set masanpham = '${poco.masanpham}',thoigiandau = '${poco.thoigiandau}',giathapnhat = '${poco.giathapnhat}',giahientai = '${poco.giahientai}',maphieuthang = '${poco.maphieuthang}',matinhtrangphiendaugia = '${poco.matinhtrangphiendaugia}' where maphiendaugia = ${id} RETURNING *`;
	return db.update(sql);
}