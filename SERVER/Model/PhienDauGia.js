var db = require('../DB/db');

exports.loadAll = function() {
	var sql = 'select * from phiendaugia order by maphiendaugia asc';
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

exports.updateDeactive = function(poco) {
	var sql = `update phiendaugia set thoigiandau = '${poco.thoigiandau}',giathapnhat = '${poco.giathapnhat}',giahientai = '${poco.giahientai}',maphieuthang = '${poco.maphieuthang}',matinhtrangphiendaugia = '${poco.matinhtrangphiendaugia}' where masanpham = ${poco.masanpham} RETURNING *`;
	return db.update(sql);
}

exports.count = function(poco){
	var sql = `select count (*) as count from phiendaugia where masanpham = '${poco.masanpham}'`;
	return db.load(sql);
}

exports.getStatusByProductID = function(id) {
	var sql = `select matinhtrangphiendaugia from phiendaugia where masanpham = ${id}`;
	return db.update(sql);
}

exports.updateStatus = function(id, poco){
	var sql = `update phiendaugia set matinhtrangphiendaugia = '${poco.status}' where maphiendaugia = ${id} RETURNING *`;
	return db.update(sql);
}

exports.updateTime = function(id, poco){
	var sql = `update phiendaugia set thoigiandau = '${poco.time}' where maphiendaugia = ${id} RETURNING *`;
	return db.update(sql);
}

exports.getIDProduct = function(id) {
	var sql = `select masanpham from phiendaugia where maphiendaugia = ${id}`;
	return db.update(sql);
}

exports.getAuctionByIDProduct = function(id) {
	var sql = `select * from phiendaugia where masanpham = ${id}`;
	return db.load(sql);
}

exports.getTimeByIDProduct = function(id) {
	var sql = `select thoigiandau from phiendaugia where masanpham = ${id}`;
	return db.load(sql);
}

exports.updateWhenWinner = function(poco) {
	var sql = `update phiendaugia set giahientai = '${poco.giahientai}', maphieuthang = '${poco.maphieuthang}' where maphiendaugia = ${poco.maphiendaugia} RETURNING *`;
	return db.update(sql);
}

// exports.test = function(id) {
// 	var sql = `select thoigiandau from phiendaugia where masanpham = ${id}`;
// 	return db.load(sql);
// }
