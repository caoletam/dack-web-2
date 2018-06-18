var express = require('express');
var PhieuDauGia = require('../Model/PhieuDauGia');

var router = express.Router();

router.post('/soluong/maphieudaugia/', (req, res) => {
	PhieuDauGia.countCouponByAuctionID(req.body).then(data => {
		res.statusCode = 201;
		res.json(data.rows);
	}).catch(err => {
		console.log(err);
		res.statusCode = 500;
		res.json('error');
	});
});

// Truyền vào mã phiên đấu giá và cập nhật tình trang phiếu đấu giá (id là mã phiên)
router.post('/capnhat/giahientai/', (req, res) => {
	PhieuDauGia.updateCurrencyByCouponID(req.body).then(data => {
		res.statusCode = 201;
		res.json(data.rows);
	}).catch(err => {
		console.log(err);
		res.statusCode = 500;
		res.json('error');
	});
});


// Truyền vào mã phiên đấu giá và cập nhật tình trang phiếu đấu giá (id là mã phiên)
router.post('/kiemtratontai/maphieudaugia/', (req, res) => {
	PhieuDauGia.checkExistsUserID(req.body).then(data => {
		res.statusCode = 201;
		res.json(data.rows);
	}).catch(err => {
		console.log(err);
		res.statusCode = 500;
		res.json('error');
	});
});

// Truyền vào mã phiên đấu giá và cập nhật tình trang phiếu đấu giá (id là mã phiên)
router.put('/capnhattinhtrang/maphieudaugia/:id', (req, res) => {
	if (req.params.id) {
		var id = req.params.id;

		if (isNaN(id)) {
			res.statusCode = 400;
			res.end();
			return;
		}

		PhieuDauGia.updateStatusCouponByCouponID(id, req.body).then(data => {
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

router.get('/mataikhoan/:id', (req, res) => {
	if (req.params.id) {
		var id = req.params.id;
		if (isNaN(id)) {
			res.statusCode = 400;
			res.end();
			return;
		}
		PhieuDauGia.getIDCouponByUserID(id).then(data => {
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

// Truyền vào ID phiên để tìm ra người chiến thắng hiện tại của phiên này
router.get('/nguoichienthang/maphien/:id', (req, res) => {
	if (req.params.id) {
		var id = req.params.id;
		if (isNaN(id)) {
			res.statusCode = 400;
			res.end();
			return;
		}
		PhieuDauGia.getWinnerCurrentByAuctionId(id).then(data => {
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


// Truyền vào mã phiên đấu giá và cập nhật tình trang phiếu đấu giá (id là mã phiên)
router.put('/capnhattinhtrang/maphiendaugia/:id', (req, res) => {
	if (req.params.id) {
		var id = req.params.id;

		if (isNaN(id)) {
			res.statusCode = 400;
			res.end();
			return;
		}

		PhieuDauGia.updateStatusCouponByAuctionID(id, req.body).then(data => {
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

router.get('/giacaonhat/maphien/:id', (req, res) => {
	if (req.params.id) {
		var id = req.params.id;
		if (isNaN(id)) {
			res.statusCode = 400;
			res.end();
			return;
		}
		PhieuDauGia.getMaxCurrencyByAuctionID(id).then(data => {
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

router.get('/', (req, res) => {
    PhieuDauGia.loadAll().then(data => {
        res.json(data.rows);
    }).catch(err => {
        console.log(err);
        res.statusCode = 500;
        res.end('View error log on console.');
    });
});

router.get('/', (req, res) => {
    PhieuDauGia.loadAll().then(data => {
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
		PhieuDauGia.load(id).then(data => {
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
	PhieuDauGia.add(req.body)
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

		PhieuDauGia.delete(id).then(data => {
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

		PhieuDauGia.update(id, req.body).then(data => {
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