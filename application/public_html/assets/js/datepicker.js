jQuery.datetimepicker.setLocale('id')
$('#picker').datetimepicker({
	timepicker: false,
	datepicker: true,
	format: 'Y-m-d', // formatDate
	mask: true,
	lang: 'id',
	il8n: {
		month: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
		dayOfWeek: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
	}
});
