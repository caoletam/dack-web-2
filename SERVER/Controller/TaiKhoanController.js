var express = require('express');
var TaiKhoan = require('../Model/TaiKhoan');
const bcrypt = require('bcrypt-nodejs');
var passwordHashed = require('password-hash');

var router = express.Router();



// KIEM TRA LOGIN
router.post('/kiemtradangnhap', (req, res) => {
	TaiKhoan.loadAll().then(data => {
		console.log(req.body);
		data.rows.forEach(element => {
			if (element.maloaitaikhoan === 2){
				if (element.email.toString().trim() === req.body.txtEmail){
					var match = bcrypt.compareSync(req.body.txtPassword, element.matkhau);
					if(match===true){
						res.end('1');
					}
				}
			}
		});
		res.end('0');
	}).catch(err=>{
		res.end('Lỗi rồi');
	});
});

router.get('/', (req, res) => {
	console.log('a');
    TaiKhoan.loadAll().then(data => {
        res.json(data.rows);
    }).catch(err => {
        console.log(err);
        res.statusCode = 500;
        res.end('View error log on console.');
    });
});

// 
// hocsinh/5

router.get('/:id', (req, res) => {
	if (req.params.id) {
		var id = req.params.id;
		if (isNaN(id)) {
			res.statusCode = 400;
			res.end();
			return;
		}
		TaiKhoan.load(id).then(data => {
			if (Object.keys(data).length > 0) {
				res.json(data.rows);
			} else {
				res.statusCode = 204;
				res.end();
            }
		}).catch(err => {
			console.log(err);
			res.statusCode = 500;
			res.json('error');
		});
	} else {
		res.statusCode = 400;
		res.json('error');
	}
});

router.post('/', (req, res) => {
	TaiKhoan.add(req.body)
		.then(data => {
			res.statusCode = 201;
			res.json(data.rows);
		})
		.catch(err => {
			console.log(err);
			res.statusCode = 500;
			res.end();
		});
});



router.delete('/:id', (req, res) => {
	if (req.params.id) {
		var id = req.params.id;

		if (isNaN(id)) {
			res.statusCode = 400;
			res.end();
			return;
		}

		TaiKhoan.delete(id).then(data => {
			res.json(data);
		}).catch(err => {
			console.log(err);
			res.statusCode = 500;
			res.json('error');
		});
	} else {
		res.statusCode = 400;
		res.json('error');
	}
});

router.post('/:id', (req, res) => {
	if (req.params.id) {
		var id = req.params.id;

		if (isNaN(id)) {
			res.statusCode = 400;
			res.end();
			return;
		}

		TaiKhoan.update(id, req.body).then(data => {
			res.statusCode = 201;
			res.json(data.rows);
		}).catch(err => {
			console.log(err);
			res.statusCode = 500;
			res.json('error');
		});
	} else {
		res.statusCode = 400;
		res.json('error');
	}
});


module.exports = router;