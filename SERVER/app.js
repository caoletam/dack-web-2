var express = require('express'),
	bodyParser = require('body-parser')
	morgan = require('morgan')
	cors = require('cors');

var SanPhamController = require('./Controller/SanPhamController');
var LoaiSanPhamController = require('./Controller/LoaiSanPhamController');
var ThamSoController = require('./Controller/ThamSoController');

var app = express();

app.use(morgan('dev'));
app.use(cors());
app.use(bodyParser.json());

app.get('/', (req, res) => {
	// res.end('hello from nodejs');
	var ret = {
		msg: 'Test API'
	};
	res.json(ret);
});

app.use('/sanpham', SanPhamController);
app.use('/loaisanpham', LoaiSanPhamController);
app.use('/thamso', ThamSoController);

app.listen(3000, () => {
	console.log('API running on port 3000');
});