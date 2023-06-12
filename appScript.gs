function onFormSubmit(event) {

    record_array = []
  
    var form = FormApp.openById('152tiuHF3uzwxW-XVjJcsqp7uKevj3eXIWLiPaV4mnls'); // Form ID
    var formResponses = form.getResponses();
    var formCount = formResponses.length;
  
    var formResponse = formResponses[formCount - 1];
    var itemResponses = formResponse.getItemResponses();
  
    for (var j = 0; j < itemResponses.length; j++) {
    var itemResponse = itemResponses[j];
  
      var title = itemResponse.getItem().getTitle();
      var answer = itemResponse.getResponse();
  
      record_array.push(answer);
    }
    console.log(record_array);
    AddRecord(record_array);
  
  }
  
  function AddRecord(record_array) {
    var url = 'https://docs.google.com/spreadsheets/d/1-Obge65AFLpmPvYlPmkg714jnrn1hMH110xJLTLBlPw/edit?resourcekey#gid=1563486027';   //URL OF GOOGLE SHEET;
    var ss= SpreadsheetApp.openByUrl(url);
    var dataSheet = ss.getSheetByName("Form Responses 1");
    var lattitude = getLattitude(record_array[3]);
    var longitude = getLongitude(record_array[3]);  
    var row = dataSheet.getLastRow();
  
    dataSheet.getRange(row, 6).setValue(lattitude);
    dataSheet.getRange(row, 7).setValue(longitude);
  }
  
  function getLattitude (address) {
    var address = Maps.newGeocoder().geocode(address)
  
    for (var i = 0; i < address.results.length; i++) {
      var result = address.results[i];
      return  result.geometry.location.lat;
    }
  
  }
  
  function getLongitude (address) {
    var address = Maps.newGeocoder().geocode(address)
    
    for (var i = 0; i < address.results.length; i++) {
      var result = address.results[i];
      return  result.geometry.location.lng;
    }
    
  }