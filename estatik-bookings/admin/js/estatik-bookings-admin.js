jQuery(document).ready(function ($) {

	$(".datepicker").datetimepicker({
		dateFormat: "dd M yy",
		timeFormat: "HH:mm",
		controlType: 'select',
		showButtonPanel: false,
		stepMinute: 15
	});

	$('.booking-metabox').closest('form').submit(function () {
		const startDate = $('#start_date').val();
		const endDate = $('#end_date').val();
		const address = $('#address').val();
		const addressRegex = /^[a-zA-Z0-9\s,'-]*$/;
		const errorMessage = $('.booking-metabox-error');

		if (new Date(endDate) < new Date(startDate)) {
			errorMessage.text('Error: End date must be greater than or equal to start date.');
			return false;
		}

		if (!addressRegex.test(address)) {
			errorMessage.text('Invalid address. Please enter a valid address.');
			return false;
		}

		return true;
	});
});
