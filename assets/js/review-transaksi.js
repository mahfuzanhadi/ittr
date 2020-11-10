$(document).ready(function () {
	//SCRIPT DISKON
	$('#discount').change(function () {
		var discount = $('#discount').val();
		var hasil = parseFloat(discount.replace(/[^0-9-.]/g, ''));
		if (hasil > 100) {
			document.getElementById('jenis_diskon').textContent = "(Rp.)";
		} else {
			document.getElementById('jenis_diskon').textContent = "(%)";
		}
	});

	//REVIEW TRANSAKSI
	$('#btn_detail_obat').click(function () {
		var tanggal_transaksi = document.getElementById('picker').value;
		var date = new Date(tanggal_transaksi);
		var tahun = date.getFullYear();
		var bulan = date.getMonth();
		var tanggal = date.getDate();
		switch (bulan) {
			case 0:
				bulan = "Januari";
				break;
			case 1:
				bulan = "Februari";
				break;
			case 2:
				bulan = "Maret";
				break;
			case 3:
				bulan = "April";
				break;
			case 4:
				bulan = "Mei";
				break;
			case 5:
				bulan = "Juni";
				break;
			case 6:
				bulan = "Juli";
				break;
			case 7:
				bulan = "Agustus";
				break;
			case 8:
				bulan = "September";
				break;
			case 9:
				bulan = "Oktober";
				break;
			case 10:
				bulan = "November";
				break;
			case 11:
				bulan = "Desember";
				break;
		}
		var tgl = tanggal + ' ' + bulan + ' ' + tahun;

		document.getElementById('tanggal_transaksi').innerHTML = tgl;
		document.getElementById('no_rm').innerHTML = $('#no_rekam_medis').val();
		document.getElementById('nama').innerHTML = $('#nama_pasien').text();
		document.getElementById('doctor').innerHTML = $('#dokter :selected').text();
		document.getElementById('nurse').innerHTML = $('#perawat :selected').text();

		var arrDiagnosa = [];
		diagnosa1 = document.getElementById('diagnosa').value;
		arrDiagnosa.push(diagnosa1);

		var arrTindakan = [];
		tindakan1 = $('#tindakan :selected').text();
		arrTindakan.push(tindakan1);

		var arrObat = [];
		obat1 = $('#obat :selected').text();
		arrObat.push(obat1);

		var b_tindakan = document.getElementById('biaya').value;
		var c_b_tindakan = parseFloat(b_tindakan.replace(/[^0-9-.]/g, ''));

		var harga_obat = document.getElementById('harga').value;
		var jumlah_biaya_obat = 0;
		if (harga_obat == "" || harga_obat == null) {
			jumlah_biaya_obat = 0;
		} else {
			var c_harga_obat = parseFloat(harga_obat.replace(/[^0-9-.]/g, ''));
			var jumlah_obat = document.getElementById('jumlah').value;
			jumlah_biaya_obat = c_harga_obat * jumlah_obat;
		}

		for (var i = 2; i < 7; i++) {
			var diag = $('#diagnosa' + i).val();
			if (diag == undefined) {
				continue;
			} else {
				arrDiagnosa.push(diag);
			}

			var tind = $('#tindakan' + i + ' :selected').text();
			if (tind == undefined) {
				continue;
			} else {
				arrTindakan.push(tind);
			}

			var biaya = $('#biaya' + i).val();
			if (biaya == undefined) {
				continue;
			} else {
				var c_biaya = parseFloat(biaya.replace(/[^0-9-.]/g, ''));
				c_b_tindakan += c_biaya;
			}
		}

		for (var k = 2; k < 7; k++) {
			var ob = $('#obat' + k + ' :selected').text();
			if (ob == undefined || ob == '') {
				continue;
			} else {
				arrObat.push(ob);
			}
		}

		for (var j = 2; j < 7; j++) {
			var harga = $('#harga' + j).val();
			var jumlah = $('#jumlah' + j).val();
			if (jumlah_biaya_obat != 0) {
				if (harga == undefined || harga == '') {
					continue;
				} else {
					var c_harga = parseFloat(harga.replace(/[^0-9-.]/g, ''));
					var j_harga = c_harga * jumlah
					jumlah_biaya_obat += j_harga;
				}
			} else {
				continue;
			}
		}

		const diagnose = document.getElementById('diagnose');
		diagnose.innerHTML = arrDiagnosa.join("<br />");
		const tindakans = document.getElementById('tindakans');
		tindakans.innerHTML = arrTindakan.join("<br />");
		const obats = document.getElementById('obats');
		obats.innerHTML = arrObat.join("<br/>");

		const t_biaya_tindakan = c_b_tindakan;
		const f_total_biaya = new Intl.NumberFormat(['ban', 'id']).format(t_biaya_tindakan);
		const total_biaya_tindakan = document.getElementById('biaya_tindakan');
		total_biaya_tindakan.innerHTML = 'Rp. ' + f_total_biaya;

		const t_biaya_obat = jumlah_biaya_obat;
		var f_total_biaya_obat = 0;
		if (t_biaya_obat == 0) {
			f_total_biaya_obat = 0;
		} else {
			f_total_biaya_obat = new Intl.NumberFormat(['ban', 'id']).format(t_biaya_obat);
		}
		const total_biaya_obat = document.getElementById('biaya_obat');
		total_biaya_obat.innerHTML = 'Rp. ' + f_total_biaya_obat;

	});

	//SUBMIT REVIEW
	$('#update').click(function () {
		var discount = $('#discount').val();
		var hasil = 0;
		if (discount == null || discount == '') {
			hasil = 0;
			$('#diskon').val(hasil);
		} else {
			hasil = parseFloat(discount.replace(/[^0-9-.]/g, ''));
			$('#diskon').val(hasil);
		}

		var ket = document.getElementById('ket').value;
		document.getElementById('keterangan').value = ket;

		$('#transaksi_form').submit();
	});

});
