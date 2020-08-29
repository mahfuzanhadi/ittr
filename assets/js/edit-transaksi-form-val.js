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

		// var no_rekam_medis = $('#no_rekam_medis').val();
		// $.ajax({
		// 	type: "POST",
		// 	url: "<?php echo base_url() ?>transaksi/isExist",
		// 	data: "no_rekam_medis=" + no_rekam_medis,
		// 	success: function (response) {
		// 		if (response != '') {
		// 			$('#error_no_rm').text(response);
		// 			$('#no_rekam_medis').addClass('has-error');
		// 		} else {
		// 			error_no_rm = '';
		// 			$('#error_no_rm').text(error_no_rm);
		// 			$('#no_rekam_medis').removeClass('has-error');
		// 		}
		// 	}
		// });

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
			// if (error_no_rm == '') {
			//     return false;
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

		if ($.trim($('#tindakan1').val()).length == 0) {
			error_tindakan = 'Tindakan wajib diisi';
			$('#error_tindakan').text(error_tindakan);
			$('#tindakan1').addClass('has-error');
		} else {
			error_tindakan = '';
			$('#error_tindakan').text(error_tindakan);
			$('#tindakan1').removeClass('has-error');
		}

		if ($.trim($('#diagnosa1').val()).length == 0) {
			error_diagnosa = 'Diagnosa wajib diisi';
			$('#error_diagnosa').text(error_diagnosa);
			$('#diagnosa1').addClass('has-error');
		} else {
			error_diagnosa = '';
			$('#error_diagnosa').text(error_diagnosa);
			$('#diagnosa1').removeClass('has-error');
		}

		if ($.trim($('#biaya1').val()).length == 0) {
			error_biaya = 'Biaya wajib diisi';
			$('#error_biaya').text(error_biaya);
			$('#biaya1').addClass('has-error');
		} else {
			error_biaya = '';
			$('#error_biaya').text(error_biaya);
			$('#biaya1').removeClass('has-error');
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
		$('#list_detail_obat').removeClass('active active_tab1');
		$('#list_detail_obat').removeAttr('href data-toggle');
		$('#detail_obat').removeClass('active');
		$('#list_detail_obat').addClass('inactive_tab1');
		$('#list_detail_transaksi').removeClass('inactive_tab1');
		$('#list_detail_transaksi').addClass('active_tab1 active');
		$('#list_detail_transaksi').attr('href', '#detail_transaksi');
		$('#list_detail_transaksi').attr('data-toggle', 'tab');
		$('#detail_transaksi').removeClass('fade');
		$('#detail_transaksi').addClass('active in');
	});

	$('#previous_btn_transaksi').click(function () {
		$('#list_detail_transaksi').removeClass('active active_tab1');
		$('#list_detail_transaksi').removeAttr('href data-toggle');
		$('#detail_transaksi').removeClass('active in');
		$('#list_detail_transaksi').addClass('inactive_tab1');
		$('#list_detail_obat').removeClass('inactive_tab1');
		$('#list_detail_obat').addClass('active_tab1 active');
		$('#list_detail_obat').attr('href', '#detail_obat');
		$('#list_detail_obat').attr('data-toggle', 'tab');
		$('#detail_obat').addClass('active in');
	});

	$('#btn_detail_transaksi').click(function () {
		var diskon = $('#diskon').val();
		var hasil = 0;
		if (diskon == null || diskon == '') {
			hasil = 0;
			$('#diskon').val(hasil);
		} else {
			hasil = parseFloat(diskon.replace(/[^0-9-.]/g, ''));
			$('#diskon').val(hasil);
		}

		$('#transaksi_form').submit();
	});
});
