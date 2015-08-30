function IUTCBChange(){
    if ($('#IUTStd').is(':checked') === false){
        $('#Stdnum').attr('class', 'form-group hide');
        $('#stdnum').prop('required', false);
    }else{
        $('#Stdnum').attr('class', 'form-group show');
        $('#stdnum').prop('required', true);
    }
}