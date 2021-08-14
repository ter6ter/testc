$(document).on('click', '#filter-variants div', function (e) {
	var text = $(e.target).text();
	$('#filter-text').val(text);
	$('#filter-variants').hide();
});
function update_slider() {
	for (var i=0;i<2;i++) {
		if ($('.slider-comment:eq(' + i + ')').length) {
			$('.slider-comment:eq(' + i + ')').show();
		}
	}
	for (var i=2;i<5;i++) {
		if ($('.slider-comment:eq(' + i + ')').length) {
			$('.slider-comment:eq(' + i + ')').hide();
		}
	}
}
$(document).ready(function (e) {
	update_slider();
	$('#show-login-form').click(function () {
		$(this).closest('div').hide();
		$('#login-form').show();
	});
	$('#add-comment input[type=button]').click(function () {
		var text = $('#add-comment textarea').val();
		if (text.length == 0) {
			window.alert('Введите текст коментария');
			return false;
		}
		$('#comments .error-message').remove();
		$.post('index.php?method=add_comment', {'text': text}, function (data) {
			$('#comments').prepend(data);
			$('#add-comment textarea').val('');
		});
	});
	$('#show-more').click(function () {
		$.post('index.php?method=get_comments',
			{'start': $('#show-more').attr('data-loaded')},
			function (data) {
				$('#show-more').closest('div').before(data);
			}
		);
	});
	$('#filter-text').keyup(function () {
		if ($(this).val().length > 2) {
			$.post('index.php?method=get_authors', {'start': $(this).val(), 'json': 1}, function (res) {
				res = $.parseJSON(res);
				if (res.data.variants && res.data.variants.length > 0) {
					$('#filter-variants').empty();
					res.data.variants.forEach(function (item, i) {
						$('#filter-variants').append('<div>' + item + '</div>');
					});
					$('#filter-variants').show();
				} else {
					$('#filter-variants').hide();
				}
			});
		} else {
			$('#filter-variants').hide();
		}
	});
	$('#slider-next').click(function () {
		var comment = $('.slider-comment:first').clone();
		$('.slider-comment:first').remove();
		$('.slider-comment:last').after(comment);
		update_slider();
	});
	$('#slider-prev').click(function () {
		var comment = $('.slider-comment:last').clone();
		$('.slider-comment:last').remove();
		$('.slider-comment:first').before(comment);
		update_slider();
	});
});