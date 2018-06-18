var pg = require('pg'),
	q = require('q');

const _HOST = '127.0.0.1',
	_PORT = '9999',
	_USER = 'postgres',
	_PWD = '123456',
	_DB = 'QLDG';


var conString = "postgres://"+_USER+":"+_PWD+"@"+_HOST+":"+_PORT+"/"+_DB;

exports.load = function (sql) {
	var d = q.defer();
	var cn = new pg.Client(conString);

	cn.connect();
	cn.query(sql, function (error, rows, fields) {
		if (error) {
			d.reject(error);
		} else {
			d.resolve(rows);
		}

		cn.end();
	});
    console.log(d.promise);
	return d.promise;
}

exports.load = function(sql) {
	var d = q.defer();
	var cn = new pg.Client(conString);

	cn.connect();
	cn.query(sql, function (error, rows, fields) {
		if (error) {
			console.log(error);
		} else {
            // console.log(rows);
            d.resolve(rows);
			// fn(rows);
		}
		cn.end();
    });
    return d.promise;
}

exports.insert = function (sql) {
    var d = q.defer();
	var cn = new pg.Client(conString);

	cn.connect();
	cn.query(sql, function (error, value) {
		if (error) {
			d.reject(error);
		} else {
			// console.log(value);
			d.resolve(value);
		}

		cn.end();
	});
	return d.promise;	
}

exports.delete = function (sql) {
	var d = q.defer();
    var cn = new pg.Client(conString);

	cn.connect();
	cn.query(sql, function (error, value) {
		if (error) {
			d.reject(error);
		} else {
			d.resolve(value.rowCount);
		}

		cn.end();
	});

	return d.promise;	
}

exports.update = function (sql){
    var d = q.defer();
    var cn = new pg.Client(conString);

	cn.connect();
	cn.query(sql, function (error, value) {
		if (error) {
			d.reject(error);
		} else {
			d.resolve(value);
		}

		cn.end();
	});

	return d.promise;
}
