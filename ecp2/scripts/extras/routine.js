function updateForm() {
	var form = document.forms[0];
	clearSelect(form[1]);
	for (i = 0; i < schedules[form[0].selectedIndex].length; i++) {
		var newOption = document.createElement('option');
		newOption.text= schedules[form[0].selectedIndex][i];
		newOption.value = schedules[form[0].selectedIndex][i];
		form[1].add(newOption);
	}
	form.submit();
}

function clearSelect(select) {
	select.options.length = 0;
}