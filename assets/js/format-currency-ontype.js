$('#biaya1').on('input', function () {
	var number, s_number, f_number;

	number = $('#biaya1').val();
	if (number != null) {
		s_number = number.replace(/,/g, '');
		f_number = formatNumber(s_number);

		$('#biaya1').val(f_number);
	}
});
$('#biaya2').on('input', function () {
	var number, s_number, f_number;

	number = $('#biaya2').val();
	if (number != null) {
		s_number = number.replace(/,/g, '');
		f_number = formatNumber(s_number);

		$('#biaya2').val(f_number);
	}
});
$('#biaya3').on('input', function () {
	var number, s_number, f_number;

	number = $('#biaya3').val();
	if (number != null) {
		s_number = number.replace(/,/g, '');
		f_number = formatNumber(s_number);

		$('#biaya3').val(f_number);
	}
});
$('#biaya4').on('input', function () {
	var number, s_number, f_number;

	number = $('#biaya4').val();
	if (number != null) {
		s_number = number.replace(/,/g, '');
		f_number = formatNumber(s_number);

		$('#biaya1').val(f_number);
	}
});
$('#biaya5').on('input', function () {
	var number, s_number, f_number;

	number = $('#biaya5').val();
	if (number != null) {
		s_number = number.replace(/,/g, '');
		f_number = formatNumber(s_number);

		$('#biaya1').val(f_number);
	}
});
$('#biaya6').on('input', function () {
	var number, s_number, f_number;

	number = $('#biaya6').val();
	if (number != null) {
		s_number = number.replace(/,/g, '');
		f_number = formatNumber(s_number);

		$('#biaya6').val(f_number);
	}
});

$('#harga1').on('input', function () {
	var number, s_number, f_number;

	number = $('#harga1').val();
	if (number != null) {
		s_number = number.replace(/,/g, '');
		f_number = formatNumber(s_number);

		$('#harga1').val(f_number);
	}
});
$('#harga2').on('input', function () {
	var number, s_number, f_number;

	number = $('#harga2').val();
	if (number != null) {
		s_number = number.replace(/,/g, '');
		f_number = formatNumber(s_number);

		$('#harga2').val(f_number);
	}
});
$('#harga3').on('input', function () {
	var number, s_number, f_number;

	number = $('#harga3').val();
	if (number != null) {
		s_number = number.replace(/,/g, '');
		f_number = formatNumber(s_number);

		$('#harga3').val(f_number);
	}
});
$('#harga4').on('input', function () {
	var number, s_number, f_number;

	number = $('#harga4').val();
	if (number != null) {
		s_number = number.replace(/,/g, '');
		f_number = formatNumber(s_number);

		$('#harga4').val(f_number);
	}
});
$('#harga5').on('input', function () {
	var number, s_number, f_number;

	number = $('#harga5').val();
	if (number != null) {
		s_number = number.replace(/,/g, '');
		f_number = formatNumber(s_number);

		$('#harga5').val(f_number);
	}
});
$('#harga6').on('input', function () {
	var number, s_number, f_number;

	number = $('#harga6').val();
	if (number != null) {
		s_number = number.replace(/,/g, '');
		f_number = formatNumber(s_number);

		$('#harga6').val(f_number);
	}
});

$('#diskon').on('input', function () {
	var number, s_number, f_number;

	number = $('#diskon').val();
	s_number = number.replace(/,/g, '');
	f_number = formatNumber(s_number);

	$('#diskon').val(f_number);
});

$('#diskon').change(function () {
	var diskon = $('#diskon').val();
	var hasil = parseFloat(diskon.replace(/[^0-9-.]/g, ''));
	if (hasil > 100) {
		document.getElementById('jenis_diskon').textContent = "(Rp.)";
	} else {
		document.getElementById('jenis_diskon').textContent = "(%)";
	}
});

function formatNumber(num) {
	return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
