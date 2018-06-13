var express = require('express');
var Hinh = require('../Model/Hinh');

var router = express.Router();

router.get('/', (req, res) => {
    Hinh.loadAll().then(data => {
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
		Hinh.load(id).then(data => {
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
	Hinh.add(req.body)
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

		Hinh.delete(id).then(data => {
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

		Hinh.update(id, req.body).then(data => {
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