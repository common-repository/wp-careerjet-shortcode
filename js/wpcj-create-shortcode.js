function wpcj_create_shortcode(){
	var scLocation 	= document.getElementById("sc-location").value;
    	var scJobTitle 	= document.getElementById("sc-job-title").value;
	var scListings 	= document.getElementById("sc-job-listings").value;
	var scLength 	= document.getElementById("sc-length").value;
	var scCType 	= document.getElementById("sc-contract-type").value;
	var scCPeriod 	= document.getElementById("sc-contract-period").value;
	var scSort 	= document.getElementById("sc-sort").value;


	var wpcj_open = '[wpcj ';

	if (scJobTitle == '') {
		var job_title = '';
	}
	else {
		var job_title = `q="${scJobTitle}" `;
	}

	if (scListings == '') {
		var limit = '';
	}
	else {
		var limit = `results="${scListings}" `;
	}

	if (scLength == '') {
		var length = '';
	}
	else {
		var length = `length="${scLength}" `;
	}
	
	if (scCType == 'all') {
		var contractType = '';
	}
	else {
		var contractType = `contracttype="${scCType}" `;
	}

	if (scCPeriod == 'all') {
		var contractPeriod = '';
	}
	else {
		var contractPeriod = `contractperiod="${scCPeriod}" `;
	}

	if (scSort == 'relevance') {
		var sort = '';
	}
	else {
		var sort = `sort="${scSort}" `;
	}
	
	if (scLocation == '') {
		var location = '';
	}
	else {
		var location = `l="${scLocation}" `;
	}
	
	if (document.getElementById('sc-list-yes').checked) {
		var list = 'list="1" ';
	}
	else {
		var list = '';
	}

	var wpcj_close = ']';



	var complete_shortcode = wpcj_open + job_title + location + limit + list + contractType + contractPeriod + sort + length + wpcj_close;
	var display = document.getElementById('display')
    	display.innerHTML=complete_shortcode;
	document.getElementById('display').value = complete_shortcode;
    	return false;
}