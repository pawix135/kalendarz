let start = $("input[name=startDate]");
let end = $("input[name=endDate]");


$('#date-removed').multiDatesPicker({
  dateFormat: "yy-mm-dd",
  separator: ','
});

$('#date-added').multiDatesPicker({
  dateFormat: "yy-mm-dd",
  separator: ','
});
