function viewxml(dataset)
{
  var tmp=window.open("about:blank","","fullscreen=1,status=1,scrollbars=1,location=1,resizable=1");
  tmp.focus();
  //tmp.location = document.f.dataset.options[document.f.dataset.selectedIndex].value + ".xml";
  tmp.location = dataset + ".xml";
}

function search_query(query)
{
  document.getElementById('keywords').value = query;
  document.forms[0].submit();
}
