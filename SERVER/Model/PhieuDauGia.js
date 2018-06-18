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

exports.getMaxCurrencyByAuctionID = function(id) {
	var sql = `SELECT max(giadau) as max FROM phieudaugia where maphiendaugia = ${id}`;
	return db.load(sql);
}

exports.updateStatusCouponByAuctionID = function(id,poco) {
	var sql = `update phieudaugia set matinhtrangphieudaugia = '${poco.tinhtrang}' where maphiendaugia = ${id}`;
	return db.update(sql);
}

// Truyền vào ID phiên để tìm ra người chiến thắng hiện tại của phiên này
exports.getWinnerCurrentByAuctionId = function(id) {
	var sql = `SELECT * FROM phieudaugia where matinhtrangphieudaugia = 2 and maphiendaugia = ${id}`;
	return db.load(sql);
}

// Truyền vào ID tài khoản để tìm ra mã phiếu hiện tại
exports.getIDCouponByUserID = function(id) {
	var sql = `select * from phieudaugia where mataikhoan = ${id}`;
	return db.load(sql);
}

exports.updateStatusCouponByCouponID = function(id,poco) {
	var sql = `update phieudaugia set matinhtrangphieudaugia = '${poco.tinhtrang}' where maphieudaugia = ${id}`;
	return db.update(sql);
}

// Check tồn tại mataikhoan trong phiếu đấu giá chưa
exports.checkExistsUserID = function(poco) {
	var sql = `select count(*) as count from phieudaugia where maphiendaugia = ${poco.maphiendaugia} and mataikhoan = ${poco.mataikhoan}`;
	return db.load(sql);
}

exports.updateCurrencyByCouponID = function(poco) {
	var sql = `update phieudaugia set giadau = '${poco.giadau}' where maphieudaugia = ${poco.maphieudaugia}`;
	return db.update(sql);
}

// Check tồn tại mataikhoan trong phiếu đấu giá chưa
exports.countCouponByAuctionID = function(poco) {
	var sql = `select count(*) as count from phieudaugia where maphiendaugia = ${poco.maphiendaugia}`;
	return db.load(sql);
}



