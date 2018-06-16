var db = require('../DB/db');

exports.loadAll = function() {
	var sql = 'select * from sanpham order by masanpham asc';
	return db.load(sql);
}

exports.load = function(id) {
	var sql = `select * from sanpham where masanpham = ${id}`;
	return db.load(sql);
}

exports.add = function(poco) {
	var sql = `insert into sanpham(tensanpham,maloaisanpham,dacta,hinhdaidien,tinhtrang) values('${poco.tensanpham}','${poco.maloaisanpham}','${poco.dacta}','${poco.hinhdaidien}',${poco.tinhtrang}) RETURNING *`;
	return db.insert(sql);
}

exports.delete = function(id) {
	var sql = `delete from sanpham where masanpham = ${id} RETURNING *`;
	return db.delete(sql);
}

exports.update = function(id, poco) {
	var sql = `update sanpham set tensanpham = '${poco.tensanpham}', maloaisanpham = '${poco.maloaisanpham}', dacta = '${poco.dacta}', hinhdaidien = '${poco.hinhdaidien}', tinhtrang = '${poco.tinhtrang}' where masanpham = ${id} RETURNING *`;
	return db.update(sql);
}

exports.updateStatus = function(id, poco) {
	// console.log($poco);
	var sql = `update sanpham set tinhtrang = '${poco.status}' where masanpham = ${id} RETURNING *`;
	console.log(sql);
	return db.update(sql);
}

exports.getItemNotExistsAuction = function(){
	var sql = `select * from sanpham sp where not exists (select * from phiendaugia pdg where sp.masanpham = pdg.masanpham)`;
	return db.load(sql);
}

