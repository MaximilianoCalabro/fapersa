var date = new Date();
date.setYear(date.getYear() - 1);

$('.picker').datePicker(
	{
		startDate: date.asString(), 
		endDate: (new Date()).asString(), 
		createButton:false
	}
);

$('#start_date_icon').bind(
	'click',
	function()
	{
		$('#srch_start_date').dpDisplay();
		this.blur();
		return false;
	}
)

$('#end_date_icon').bind(
	'click',
	function()
	{
		$('#srch_end_date').dpDisplay();
		this.blur();
		return false;
	}
)

$('#srch_start_date').bind(
	'dpClosed',
	function(e, selectedDates)
	{
		var d = selectedDates[0];
		if (d) {
			d = new Date(d);
			$('#srch_end_date').dpSetStartDate(d.addDays(1).asString());
		}
	}
);

$('#srch_end_date').bind(
	'dpClosed',
	function(e, selectedDates)
	{
		var d = selectedDates[0];
		if (d) {
			d = new Date(d);
			$('#srch_start_date').dpSetEndDate(d.addDays(-1).asString());
		}
	}
);
