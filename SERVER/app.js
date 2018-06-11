var express = require('express'),
	bodyParser = require('body-parser')
	morgan = require('morgan')
	cors = require('cors');

var SanPhamController = require('./Controller/SanPhamController');
var LoaiSanPhamController = require('./Controller/LoaiSanPhamController');
var ThamSoController = require('./Controller/ThamSoController');
var HinhController = require('./Controller/HinhController');
var LoaiTaiKhoanController = require('./Controller/LoaiTaiKhoanController');
var TaiKhoanController = require('./Controller/TaiKhoanController');
var TinhTrangPhieuDauGiaController = require('./Controller/TinhTrangPhieuDauGiaController');
var TinhTrangPhienDauGiaController = require('./Controller/TinhTrangPhienDauGiaController');
var PhienDauGiaController = require('./Controller/PhienDauGiaController');

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
app.use('/hinh', HinhController);
app.use('/loaitaikhoan', LoaiTaiKhoanController);
app.use('/taikhoan', TaiKhoanController);
app.use('/tinhtrangphieudaugia', TinhTrangPhieuDauGiaController);
app.use('/tinhtrangphiendaugia', TinhTrangPhienDauGiaController);
app.use('/phiendaugia', PhienDauGiaController);

app.listen(3000, () => {
	console.log('API running on port 3000');
});