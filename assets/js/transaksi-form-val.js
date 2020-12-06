$(document).ready(function () {
	$('#btn_rekam_medis').click(function () {
		var error_no_rm = '';
		var error_dokter = '';
		var error_perawat = '';

		if ($.trim($('#no_rekam_medis').val()).length == 0) {
			error_no_rm = 'Nomor Rekam Medis wajib diisi';
			$('#error_no_rm').text(error_no_rm);
			$('#no_rekam_medis').addClass('has-error');
		} else {
			error_no_rm = '';
			$('#error_no_rm').text(error_no_rm);
			$('#no_rekam_medis').removeClass('has-error');
		}

		if ($.trim($('#dokter').val()).length == 0) {
			error_dokter = 'Data dokter wajib diisi';
			$('#error_dokter').text(error_dokter);
			$('#dokter').addClass('has-error');
		} else {
			error_dokter = '';
			$('#error_dokter').text(error_dokter);
			$('#dokter').removeClass('has-error');
		}

		if ($.trim($('#perawat').val()).length == 0) {
			error_perawat = 'Data perawat wajib diisi';
			$('#error_perawat').text(error_perawat);
			$('#perawat').addClass('has-error');
		} else {
			error_perawat = '';
			$('#error_perawat').text(error_perawat);
			$('#perawat').removeClass('has-error');
		}

		if (error_no_rm != '' || error_dokter != '' || error_perawat != '') {
			return false;
		} else {
			$('#list_rekam_medis').removeClass('active active_tab1');
			$('#list_rekam_medis').removeAttr('href data-toggle');
			$('#rekam_medis').removeClass('active');
			$('#list_rekam_medis').addClass('inactive_tab1');
			$('#list_detail_tindakan').removeClass('inactive_tab1');
			$('#list_detail_tindakan').addClass('active_tab1 active');
			$('#list_detail_tindakan').attr('href', '#detail_tindakan');
			$('#list_detail_tindakan').attr('data-toggle', 'tab');
			$('#detail_tindakan').removeClass('fade');
			$('#detail_tindakan').addClass('active in');
		}
	});

	$('#previous_btn_tindakan').click(function () {
		$('#list_detail_tindakan').removeClass('active active_tab1');
		$('#list_detail_tindakan').removeAttr('href data-toggle');
		$('#detail_tindakan').removeClass('active in');
		$('#list_detail_tindakan').addClass('inactive_tab1');
		$('#list_rekam_medis').removeClass('inactive_tab1');
		$('#list_rekam_medis').addClass('active_tab1 active');
		$('#list_rekam_medis').attr('href', '#rekam_medis');
		$('#list_rekam_medis').attr('data-toggle', 'tab');
		$('#rekam_medis').addClass('active in');
	});

	$('#btn_detail_tindakan').click(function () {
		var error_tindakan = '';
		var error_biaya = '';
		var error_diagnosa = '';

		if ($.trim($('#tindakan').val()).length == 0) {
			error_tindakan = 'Tindakan wajib diisi';
			$('#error_tindakan').text(error_tindakan);
			$('#tindakan').addClass('has-error');
		} else {
			error_tindakan = '';
			$('#error_tindakan').text(error_tindakan);
			$('#tindakan').removeClass('has-error');
		}

		if ($.trim($('#diagnosa').val()).length == 0) {
			error_diagnosa = 'Diagnosa wajib diisi';
			$('#error_diagnosa').text(error_diagnosa);
			$('#diagnosa').addClass('has-error');
		} else {
			error_diagnosa = '';
			$('#error_diagnosa').text(error_diagnosa);
			$('#diagnosa').removeClass('has-error');
		}

		if ($.trim($('#biaya').val()).length == 0) {
			error_biaya = 'Biaya wajib diisi';
			$('#error_biaya').text(error_biaya);
			$('#biaya').addClass('has-error');
		} else {
			error_biaya = '';
			$('#error_biaya').text(error_biaya);
			$('#biaya').removeClass('has-error');
		}

		if (error_tindakan != '' || error_biaya != '' || error_diagnosa != '') {
			return false;
		} else {
			$('#list_detail_tindakan').removeClass('active active_tab1');
			$('#list_detail_tindakan').removeAttr('href data-toggle');
			$('#detail_tindakan').removeClass('active');
			$('#list_detail_tindakan').addClass('inactive_tab1');
			$('#list_detail_obat').removeClass('inactive_tab1');
			$('#list_detail_obat').addClass('active_tab1 active');
			$('#list_detail_obat').attr('href', '#detail_obat');
			$('#list_detail_obat').attr('data-toggle', 'tab');
			$('#detail_obat').removeClass('fade');
			$('#detail_obat').addClass('active in');
		}
	});

	$('#previous_btn_obat').click(function () {
		$('#list_detail_obat').removeClass('active active_tab1');
		$('#list_detail_obat').removeAttr('href data-toggle');
		$('#detail_obat').removeClass('active in');
		$('#list_detail_obat').addClass('inactive_tab1');
		$('#list_detail_tindakan').removeClass('inactive_tab1');
		$('#list_detail_tindakan').addClass('active_tab1 active');
		$('#list_detail_tindakan').attr('href', '#detail_tindakan');
		$('#list_detail_tindakan').attr('data-toggle', 'tab');
		$('#detail_tindakan').addClass('active in');
	});

	$('#btn_detail_obat').click(function () {
		var error_jumlah = '';
		var error_jumlah2 = '';
		var error_jumlah3 = '';
		var error_jumlah4 = '';
		var error_jumlah5 = '';
		var error_jumlah6 = '';
		var error_dosis = '';
		var error_dosis2 = '';
		var error_dosis3 = '';
		var error_dosis4 = '';
		var error_dosis5 = '';
		var error_dosis6 = '';

		if ($.trim($('#obat').val()).length != 0 && $.trim($('#dosis').val()).length == 0 && $('#jumlah').val() == 0) {
			error_jumlah = 'Jumlah wajib diisi';
			$('#error_jumlah').text(error_jumlah);
			$('#jumlah').addClass('has-error');

			error_dosis = 'Dosis wajib diisi';
			$('#error_dosis').text(error_dosis);
			$('#dosis').addClass('has-error');
		} else if ($.trim($('#obat').val()).length != 0 && $.trim($('#dosis').val()).length == 0 && $('#jumlah').val() != 0) {
			error_dosis = 'Dosis wajib diisi';
			$('#error_dosis').text(error_dosis);
			$('#dosis').addClass('has-error');

			error_jumlah = '';
			$('#error_jumlah').text(error_jumlah);
			$('#jumlah').removeClass('has-error');
		} else if ($.trim($('#obat').val()).length != 0 && $('#jumlah').val() == 0 && $.trim($('#dosis').val()).length != 0) {
			error_jumlah = 'Jumlah wajib diisi';
			$('#error_jumlah').text(error_jumlah);
			$('#jumlah').addClass('has-error');

			error_dosis = '';
			$('#error_dosis').text(error_dosis);
			$('#dosis').removeClass('has-error');
		} else {
			error_jumlah = '';
			$('#error_jumlah').text(error_jumlah);
			$('#jumlah').removeClass('has-error');

			error_dosis = '';
			$('#error_dosis').text(error_dosis);
			$('#dosis').removeClass('has-error');
		}

		if ($.trim($('#obat2').val()).length != 0 && $.trim($('#dosis2').val()).length == 0 && $('#jumlah2').val() == 0) {
			error_jumlah2 = 'Jumlah wajib diisi';
			$('#error_jumlah2').text(error_jumlah2);
			$('#jumlah2').addClass('has-error');

			error_dosis2 = 'Dosis wajib diisi';
			$('#error_dosis2').text(error_dosis2);
			$('#dosis2').addClass('has-error');
		} else if ($.trim($('#obat2').val()).length != 0 && $.trim($('#dosis2').val()).length == 0 && $('#jumlah2').val() != 0) {
			error_dosis2 = 'Dosis wajib diisi';
			$('#error_dosis2').text(error_dosis2);
			$('#dosis2').addClass('has-error');

			error_jumlah2 = '';
			$('#error_jumlah2').text(error_jumlah2);
			$('#jumlah2').removeClass('has-error');
		} else if ($.trim($('#obat2').val()).length != 0 && $('#jumlah2').val() == 0 && $.trim($('#dosis2').val()).length != 0) {
			error_jumlah2 = 'Jumlah wajib diisi';
			$('#error_jumlah2').text(error_jumlah2);
			$('#jumlah2').addClass('has-error');

			error_dosis2 = '';
			$('#error_dosis2').text(error_dosis2);
			$('#dosis2').removeClass('has-error');
		} else {
			error_jumlah2 = '';
			$('#error_jumlah2').text(error_jumlah2);
			$('#jumlah2').removeClass('has-error');

			error_dosis2 = '';
			$('#error_dosis2').text(error_dosis2);
			$('#dosis2').removeClass('has-error');
		}

		if ($.trim($('#obat3').val()).length != 0 && $.trim($('#dosis3').val()).length == 0 && $('#jumlah3').val() == 0) {
			error_jumlah3 = 'Jumlah wajib diisi';
			$('#error_jumlah3').text(error_jumlah3);
			$('#jumlah3').addClass('has-error');

			error_dosis3 = 'Dosis wajib diisi';
			$('#error_dosis3').text(error_dosis3);
			$('#dosis3').addClass('has-error');
		} else if ($.trim($('#obat3').val()).length != 0 && $.trim($('#dosis3').val()).length == 0 && $('#jumlah3').val() != 0) {
			error_dosis3 = 'Dosis wajib diisi';
			$('#error_dosis3').text(error_dosis3);
			$('#dosis3').addClass('has-error');

			error_jumlah3 = '';
			$('#error_jumlah3').text(error_jumlah3);
			$('#jumlah3').removeClass('has-error');
		} else if ($.trim($('#obat3').val()).length != 0 && $('#jumlah3').val() == 0 && $.trim($('#dosis3').val()).length != 0) {
			error_jumlah3 = 'Jumlah wajib diisi';
			$('#error_jumlah3').text(error_jumlah3);
			$('#jumlah3').addClass('has-error');

			error_dosis3 = '';
			$('#error_dosis3').text(error_dosis3);
			$('#dosis3').removeClass('has-error');
		} else {
			error_jumlah3 = '';
			$('#error_jumlah3').text(error_jumlah3);
			$('#jumlah3').removeClass('has-error');

			error_dosis3 = '';
			$('#error_dosis3').text(error_dosis3);
			$('#dosis3').removeClass('has-error');
		}

		if ($.trim($('#obat4').val()).length != 0 && $.trim($('#dosis4').val()).length == 0 && $('#jumlah4').val() == 0) {
			error_jumlah4 = 'Jumlah wajib diisi';
			$('#error_jumlah4').text(error_jumlah4);
			$('#jumlah4').addClass('has-error');

			error_dosis4 = 'Dosis wajib diisi';
			$('#error_dosis4').text(error_dosis4);
			$('#dosis4').addClass('has-error');
		} else if ($.trim($('#obat4').val()).length != 0 && $.trim($('#dosis4').val()).length == 0 && $('#jumlah4').val() != 0) {
			error_dosis4 = 'Dosis wajib diisi';
			$('#error_dosis4').text(error_dosis4);
			$('#dosis4').addClass('has-error');

			error_jumlah4 = '';
			$('#error_jumlah4').text(error_jumlah4);
			$('#jumlah4').removeClass('has-error');
		} else if ($.trim($('#obat4').val()).length != 0 && $('#jumlah4').val() == 0 && $.trim($('#dosis4').val()).length != 0) {
			error_jumlah4 = 'Jumlah wajib diisi';
			$('#error_jumlah4').text(error_jumlah4);
			$('#jumlah4').addClass('has-error');

			error_dosis4 = '';
			$('#error_dosis4').text(error_dosis4);
			$('#dosis4').removeClass('has-error');
		} else {
			error_jumlah4 = '';
			$('#error_jumlah4').text(error_jumlah4);
			$('#jumlah4').removeClass('has-error');

			error_dosis4 = '';
			$('#error_dosis4').text(error_dosis4);
			$('#dosis4').removeClass('has-error');
		}

		if ($.trim($('#obat5').val()).length != 0 && $.trim($('#dosis5').val()).length == 0 && $('#jumlah5').val() == 0) {
			error_jumlah5 = 'Jumlah wajib diisi';
			$('#error_jumlah5').text(error_jumlah5);
			$('#jumlah5').addClass('has-error');

			error_dosis5 = 'Dosis wajib diisi';
			$('#error_dosis5').text(error_dosis5);
			$('#dosis5').addClass('has-error');
		} else if ($.trim($('#obat5').val()).length != 0 && $.trim($('#dosis5').val()).length == 0 && $('#jumlah5').val() != 0) {
			error_dosis5 = 'Dosis wajib diisi';
			$('#error_dosis5').text(error_dosis5);
			$('#dosis5').addClass('has-error');

			error_jumlah5 = '';
			$('#error_jumlah5').text(error_jumlah5);
			$('#jumlah5').removeClass('has-error');
		} else if ($.trim($('#obat5').val()).length != 0 && $('#jumlah5').val() == 0 && $.trim($('#dosis5').val()).length != 0) {
			error_jumlah5 = 'Jumlah wajib diisi';
			$('#error_jumlah5').text(error_jumlah5);
			$('#jumlah5').addClass('has-error');

			error_dosis5 = '';
			$('#error_dosis5').text(error_dosis5);
			$('#dosis5').removeClass('has-error');
		} else {
			error_jumlah5 = '';
			$('#error_jumlah5').text(error_jumlah5);
			$('#jumlah5').removeClass('has-error');

			error_dosis5 = '';
			$('#error_dosis5').text(error_dosis5);
			$('#dosis5').removeClass('has-error');
		}

		if ($.trim($('#obat6').val()).length != 0 && $.trim($('#dosis6').val()).length == 0 && $('#jumlah6').val() == 0) {
			error_jumlah6 = 'Jumlah wajib diisi';
			$('#error_jumlah6').text(error_jumlah6);
			$('#jumlah6').addClass('has-error');

			error_dosis6 = 'Dosis wajib diisi';
			$('#error_dosis6').text(error_dosis6);
			$('#dosis6').addClass('has-error');
		} else if ($.trim($('#obat6').val()).length != 0 && $.trim($('#dosis6').val()).length == 0 && $('#jumlah6').val() != 0) {
			error_dosis6 = 'Dosis wajib diisi';
			$('#error_dosis6').text(error_dosis6);
			$('#dosis6').addClass('has-error');

			error_jumlah6 = '';
			$('#error_jumlah6').text(error_jumlah6);
			$('#jumlah6').removeClass('has-error');
		} else if ($.trim($('#obat6').val()).length != 0 && $('#jumlah6').val() == 0 && $.trim($('#dosis6').val()).length != 0) {
			error_jumlah6 = 'Jumlah wajib diisi';
			$('#error_jumlah6').text(error_jumlah6);
			$('#jumlah6').addClass('has-error');

			error_dosis6 = '';
			$('#error_dosis6').text(error_dosis6);
			$('#dosis6').removeClass('has-error');
		} else {
			error_jumlah6 = '';
			$('#error_jumlah6').text(error_jumlah6);
			$('#jumlah6').removeClass('has-error');

			error_dosis6 = '';
			$('#error_dosis6').text(error_dosis6);
			$('#dosis6').removeClass('has-error');
		}

		//hilangkan koma pada biaya dan harga
		var biaya = $('#biaya').val();
		var hasil = parseFloat(biaya.replace(/[^0-9-.]/g, ''));
		$('#biaya').val(hasil);

		var harga = $('#harga').val();
		if (harga != '') {
			var hasil = parseFloat(harga.replace(/[^0-9-.]/g, ''));
			$('#harga').val(hasil);
		}

		for (var i = 2; i < 11; i++) {
			var biaya = $('#biaya' + i + '').val();
			if (biaya != null) {
				var hasil = parseFloat(biaya.replace(/[^0-9-.]/g, ''));
				$('#biaya' + i + '').val(hasil);
			}
		}

		for (var i = 2; i < 7; i++) {
			var harga = $('#harga' + i + '').val();
			if (harga != null) {
				var hasil = parseFloat(harga.replace(/[^0-9-.]/g, ''));
				$('#harga' + i + '').val(hasil);
			}
		}

		if (error_jumlah != '' || error_jumlah2 != '' || error_jumlah3 != '' || error_jumlah4 != '' || error_jumlah5 != '' || error_jumlah6 != '' || error_dosis != '' || error_dosis2 != '' || error_dosis3 != '' || error_dosis4 != '' || error_dosis5 != '' || error_dosis6 != '') {
			return false;
		} else {
			$('#reviewModal').modal('show');
		}
	});
});
