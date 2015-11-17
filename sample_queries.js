document.write('<font size="2.5">Example queries: <span id="queries"></span></font>');
var sample_queries = new Object();
sample_queries['Amazon'] = ['notebook product intel','hp laptop'];
sample_queries['DBLP'] = ['xml search author', 'identifying meaningful return'];

function list_queries(dataset) {
	var query_list = '';
	if (dataset in sample_queries) {
		for (var i = 0; i < sample_queries[dataset].length; i++) {
			query_list = query_list + '<a href="#" onclick="search_query(\'' + sample_queries[dataset][i] + '\'); return false;">' + sample_queries[dataset][i] + '</a>, ';
		}
		if (query_list.length > 2) {
			query_list = query_list.substring(0, query_list.length - 2);
		}
	}
	return query_list;
}

function search_query(query) {
	document.getElementById('keyword').value = query;
	document.forms[0].submit();
}

document.getElementById('dataset').onchange = function (){
	var dataset = this.options[this.selectedIndex];
	document.getElementById('queries').innerHTML = list_queries(dataset.value);
};

var index = document.getElementById('dataset').selectedIndex;
var dataset = document.getElementById('dataset').options[index];
document.getElementById('queries').innerHTML = list_queries(dataset.value);