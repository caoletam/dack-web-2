var express = require('express');
var PhienDauGia = require('../Model/PhienDauGia');

var router = express.Router();



router.get('/masanpham/:id', (req, res) => {
	if (req.params.id) {
		var id = req.params.id;
		if (isNaN(id)) {
			res.statusCode = 400;
			res.end();
			return;
		}
		PhienDauGia.getAuctionByIDProduct(id).then(data => {
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

router.get('/masanpham/sanpham/:id', (req, res) => {
	if (req.params.id) {
		var id = req.params.id;
		if (isNaN(id)) {
			res.statusCode = 400;
			res.end();
			return;
		}
		PhienDauGia.getIDProduct(id).then(data => {
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


router.put('/capnhatthoigian/:id', (req, res) => {
	console.log(req.body);
	var id = req.params.id;
	if (isNaN(id)) {
		res.statusCode = 400;
		res.end();
		return;
	}

	PhienDauGia.updateTime(id,req.body)
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

router.put('/capnhattinhtrang/:id', (req, res) => {
	console.log(req.body);
	var id = req.params.id;
	if (isNaN(id)) {
		res.statusCode = 400;
		res.end();
		return;
	}

	PhienDauGia.updateStatus(id,req.body)
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


router.get('/tinhtrangphiendaugia/sanpham/:id', (req, res) => {
	if (req.params.id) {
		var id = req.params.id;
		if (isNaN(id)) {
			res.statusCode = 400;
			res.end();
			return;
		}
		PhienDauGia.getStatusByProductID(id).then(data => {
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

router.post('/kiemtratontai', (req, res) => {
	console.log(req.body);
	PhienDauGia.count(req.body)
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


router.post('/capnhatphiendaugia', (req, res) => {
	console.log(req.body);
	PhienDauGia.updateDeactive(req.body)
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

router.get('/', (req, res) => {
    PhienDauGia.loadAll().then(data => {
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
		PhienDauGia.load(id).then(data => {
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
	console.log(req.body);
	PhienDauGia.add(req.body)
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

		PhienDauGia.delete(id).then(data => {
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

router.put('/:id', (req, res) => {
	if (req.params.id) {
		var id = req.params.id;

		if (isNaN(id)) {
			res.statusCode = 400;
			res.end();
			return;
		}

		PhienDauGia.update(id, req.body).then(data => {
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