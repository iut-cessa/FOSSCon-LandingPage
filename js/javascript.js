function IUTCBChange(){
    if ($('#IUTStd').is(':checked') === false){
        $('#Stdnum').attr('class', 'form-group hide');
        $('#stdnum').prop('required', false);
    }else{
        $('#Stdnum').attr('class', 'form-group show');
        $('#stdnum').prop('required', true);
    }
};

function frame_builder() {
    // Check function
    // $('#test').text('test');
};

function submit_click() {
  var detail = $('#workshopsForm').serialize();
  var index = detail.indexOf('workshop=');
  if (index === -1){
  } else {
    index = index + 'workshop='.length;
    var _index = detail.indexOf('&');
    var workshop = detail.substring(index, _index);
    var code = detail.substring(detail.indexOf('code=') + 'code='.length);
    var url = "http://myevent.ir/IUTFOSSCon/register?quantity[" + workshop + "]=1&discount_code=" + code;
    // window.location.replace(url);
    window.open(url);
  }
}
