var selectChanged = new Boolean();
var processedProducts = {};
selectChanged = false;
process = true;

function changeSelects(type) {
	// SETUP FIELDS
	var srch_brand_id = document.getElementById('srch_brand_id');
	var srch_engine_id = document.getElementById('srch_engine_id');
	
	// RESET FIELDS
	if (type != 'srch_brand_id') {
		srch_brand_id.options.length = 0;
		srch_brand_id.options[0] = new Option('Todas las marcas de productos', '0', true, false);
	}
	
	srch_engine_id.options.length = 0;
	srch_engine_id.options[0] = new Option('Todas las marcas de motores', '0', true, false);
	
	var cid = $('#srch_category_id').val();
	var bid = $('#srch_brand_id').val();
	var eid = $('#srch_engine_id').val();
	
	var vars = 'cid='+cid+'&bid='+bid+'&eid='+eid;
	
	if (process) {
		selectChanged = true;
		
		$.ajax({
			url: 'scripts/search.filter-categories.php', 
			type: 'POST', 
			data: vars, 
			dataType: 'json', 
			success: function(json) {
				if (typeof(json.filters.brands) == 'object') {
					$.each(json.filters.brands, function(key) {
						if (json.filters.brands[key].id != 0) {
							storageKey = srch_brand_id.options.length;
							srch_brand_id.options[storageKey] = new Option(json.filters.brands[key].value, json.filters.brands[key].id, false, false);
						}
					});
				}
				
				if (typeof(json.filters.engines) == 'object') {
					$.each(json.filters.engines, function(key) {
						if (json.filters.engines[key].id != 0) {
							storageKey = srch_engine_id.options.length;
							srch_engine_id.options[storageKey] = new Option(json.filters.engines[key].value, json.filters.engines[key].id, false, false);
						}
					});
				}
			}
		});
	}
}

function isNumeric(what, decimals) {
	var isnumeric = true;
	
	if (!decimals) {
		var strValidChars = "0123456789";
	}else{
		var strValidChars = ".0123456789";
	}
	
	var strChar;
	var strString = what;
	
	if (strString.length == 0 || strString == 0) isnumeric = true;
	
	if (isnumeric == true) {
		for (i = 0; i < strString.length && isnumeric == true; i++){
			strChar = strString.charAt(i);
			if (strValidChars.indexOf(strChar) == -1){
				isnumeric = false;
			}
		}
	}
	
	return isnumeric;
}

function getPrice(id, q, vars) {
	process = true;
	
	if (processedProducts[id] == q) {
		process = false;
	}else{
		processedProducts[id] = q;
	}
	
	var error = false;
	
	if (process) {
		if (typeof(vars) == 'undefined') var vars = 'id='+id+'&q='+q;
		
		if (isNumeric($('#q_'+id).val()) == false) {
			$('#q_'+id).removeClass('ok');
			$('#q_'+id).addClass('error');
		}else{
			if (q == 0) {
				$('#q_'+id).removeClass('error');
				$('#q_'+id).removeClass('ok');
			}else{
				$('#q_'+id).removeClass('error');
				$('#q_'+id).addClass('ok');
			}
		}
		
		$.ajax({
			url: 'scripts/search.calculate-price.php', 
			type: 'POST', 
			data: vars, 
			dataType: 'json', 
			success: function(json) {
				var productTotal = json.returns.productTotal;
				var subtotal = json.returns.subtotal;
				var Qdiscounts = json.returns.Qdiscounts;
				var total = json.returns.total;
				
				$('#sub_'+id).html(productTotal);
				$('#subtotal').html(subtotal);
				$('#Qdiscounts').html(Qdiscounts);
				$('#total').html(total);
			}
		});
	}
}

function exportSearch(site_url) {
	var srch_category_id = $('#srch_category_id').val();
	var srch_brand_id = $('#srch_brand_id').val();
	var srch_engine_id = $('#srch_engine_id').val();
	var srch_code = $('#srch_code').val();
	
	var vars = '?srch_category_id=' + srch_category_id;
	vars += '&srch_brand_id=' + srch_brand_id;
	vars += '&srch_engine_id=' + srch_engine_id;
	vars += '&srch_code=' + srch_code;
	
	window.location.href = site_url + 'clientes/search.export.php'+vars;
}