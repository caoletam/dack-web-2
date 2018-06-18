var db = require('../DB/db');
const bcrypt = require('bcrypt-nodejs');

exports.loadAll = function() {
	var sql = 'select * from taikhoan';
	return db.load(sql);
}

exports.load = function(id) {
	var sql = `select * from taikhoan where mataikhoan = ${id}`;
	return db.load(sql);
}

exports.add = function(poco) {
	var sql = `insert into taikhoan(tendangnhap,matkhau,tenhienthi,email,dienthoai,diachi,maloaitaikhoan) values('${poco.tendangnhap}','${bcrypt.hashSync(poco.matkhau, null)}','${poco.tenhienthi}','${poco.email}','${poco.dienthoai}','${poco.diachi}','${poco.maloaitaikhoan}') RETURNING *`;
	return db.insert(sql);
}

exports.delete = function(id) {
	var sql = `delete from taikhoan where mataikhoan = ${id} RETURNING *`;
	return db.delete(sql);
}

exports.update = function(id, poco) {
	var sql = `update taikhoan set tendangnhap = '${poco.tendangnhap}', matkhau = '${poco.matkhau}', tenhienthi = '${poco.tenhienthi}', email = '${poco.email}', dienthoai = '${poco.dienthoai}', diachi = '${poco.diachi}', maloaitaikhoan = '${poco.maloaitaikhoan}' where mataikhoan = ${id} RETURNING *`;
	return db.update(sql);
}

exports.getInfoByEmail = function(poco) {
	var sql = `select * from taikhoan where email = '${poco.email}'`;
	return db.load(sql);
}

exports.getInfoByUsername = function(poco) {
	var sql = `select * from taikhoan where tenhienthi = '${poco.tenhienthi}'`;
	return db.load(sql);
}