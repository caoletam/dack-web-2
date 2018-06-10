var express = require('express');
var LoaiSanPham = require('../Model/LoaiSanPham');

var router = express.Router();

router.get('/', (req, res) => {
    LoaiSanPham.loadAll().then(rows => {
        console.log(typeof rows);
        res.json(rows);
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
		LoaiSanPham.load(id).then(rows => {
            console.log(Object.keys(rows).length);
			if (Object.keys(rows).length > 0) {
				res.json(rows);
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
	LoaiSanPham.add(req.body)
		.then(insertId => {
			var poco = {
                maloaisanpham: insertId,
                tenloaisanpham: req.body.tenloaisanpham,
            };
			res.statusCode = 201;
			res.json(poco);
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

		LoaiSanPham.delete(id).then(rowCount => {
			res.json({
                "affectedRow": rowCount,
                "id": id
			});
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

		LoaiSanPham.update(id, req.body).then(updateId => {
            var poco = {
                maloaisanpham: updateId,
                tenloaisanpham: req.body.tensanpham,
            };
			res.statusCode = 201;
			res.json(poco);
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