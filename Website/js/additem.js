

function checkExists(valueToCheck)
{
  var ddl = document.getElementById('ddlSelectedCategories')
  for(var i=0; i<ddl.options.length; i++)
  {
    if(ddl.options[i].value == valueToCheck)
    {
      return true;
    }
  }
  return false;
}

function selectAll(){
var ddl = document.getElementById('ddlSelectedCategories')
for (var i = 0; i < ddl.options.length; i++)
{
   ddl.options[i].selected = true;
}
}
function addCategory()
{
	var form = document.forms.listitem;
  
  var ddl = document.getElementById('ddlCategories');
  var dropdownIndex = ddl.selectedIndex;
  var dropdownValue = ddl[dropdownIndex].value;
  var dropdownText = ddl[dropdownIndex].text;
  
  if (checkExists(dropdownValue)){
    alert("You have already added this category to the list");
  }else{
  
    var elOptNew = document.createElement('option');
    elOptNew.text = dropdownText;
    elOptNew.value = dropdownValue;
    var elSel = document.getElementById('ddlSelectedCategories');

    try {
      elSel.add(elOptNew, null); // standards compliant; doesn't work in IE
    }
    catch(ex) {
      elSel.add(elOptNew); // IE only
    }
  }
}
function removeAll()
{
  var elSel = document.getElementById('ddlSelectedCategories');
  var i;
  for (i = elSel.length - 1; i>=0; i--) {
      elSel.remove(i);
  }
}
function removeOptionSelected()
{
  var elSel = document.getElementById('ddlSelectedCategories');
  var i;
  for (i = elSel.length - 1; i>=0; i--) {
    if (elSel.options[i].selected) {
      elSel.remove(i);
    }
  }
}