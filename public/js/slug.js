$(document).ready(function () {
	$('#management-add-title').keyup(function (e) {
		var title = $(this).val();
		if(!title) {
			return;
		}
		var slug = to_slug(title);
		$('input#management-add-uri').val(slug);
	});
});
function to_slug(title) {
	var slug = title.toLowerCase();
	slug = slug.trim(slug);
	slug = slug.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/gi, 'a');
	slug = slug.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/gi, 'e');
	slug = slug.replace(/ì|í|ị|ỉ|ĩ/gi, 'i');
	slug = slug.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/gi, 'o');
	slug = slug.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/gi, 'u');
	slug = slug.replace(/ỳ|ý|ỵ|ỷ|ỹ/gi, 'y');
	slug = slug.replace(/đ/gi, 'd');
	slug = slug.replace(/[^a-z0-9]/gi, ' ');
	slug = slug.replace(/[\s]+/gi, '-');
	return slug;
}