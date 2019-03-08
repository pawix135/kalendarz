//Zmienne
let calendarDiv = $(".kalendarz"), url, data, result;

//Ładowanie dokumentu
$(document).ready(function(){
    getTable('getTable');
    // displayContent('calendarBlock');
    getEvent('getAll', '.editTable', '');
});


//Przyciski kalendarz
$('body').on('click', 'a.nextMonth', function(){

    getTable('getTable', $(this).data("year"), $(this).data("month"));

});

$('body').on('click', 'a.prevMonth', function(){

    getTable('getTable', $(this).data("year"), $(this).data("month"));

});


//MultipleDatePickers

//Edycja
$('body').on('click', 'button.tableEditButton', function(e){

    let button = $(this);
    let eventId = button.data("edit");

    let modal = $("#modalEdit");
    let modalTitle = modal.find(".modal-title");
    let modalBody = modal.find(".modal-body");

    $.ajax({
        type: "get",
        url: "http://localhost/kalendarz/php/app.php",
        data: "edit=getData&eventId=" + eventId,
        dataType: "text",
        success: function (res) {
            let json = JSON.parse(res);
            json = json[0];

            let group = $('<div>');
            let eventIdI = `<input type='hidden' data-id='${eventId}'>`;
            let eventName = `<label>Nazwa eventu</label><input value='${json.nazwa_wydarzenia}' class='form-control eventNameEdit' type='text'>`;
            let startDateI = `<label>Data rozpoczęcia</label><input value='${json.data_rozpoczecia}' class='form-control startDateEdit' type='date'>`;
            let endDateI = `<label>Data zakończenia</label><input value='${json.data_zakonczenia}' class='form-control endDateEdit' type='date'>`;
            let addDateI = `<label>Daty dodatkowe</label><input value='${json.daty_dodatkowe}' id='addDateEdit' class='form-control' type='text'>`;
            let remDateI = `<label>Daty wyłączone</label><input value='${json.daty_przerw}' id= 'remDateEdit' class='form-control' type='text'>`;
            
            group.append(`${eventIdI}${eventName}<br>${startDateI}<br>${endDateI}<br>${addDateI}<br>${remDateI}`);
            
            $(modalTitle).text(json.nazwa_wydarzenia);
            $(modalBody).html(group);

            $('#addDateEdit').multiDatesPicker({
                dateFormat: "yy-mm-dd"
            });
            $('#remDateEdit').multiDatesPicker({
                dateFormat: "yy-mm-dd"
            });
        }
    });

    $('#modalEdit').modal('toggle');
    
});

$('body').on('click', 'button.saveEdit', function(e){

    let modalBody = $('.modal-body');
    let eventId = modalBody.find('.eventIdEdit');
    let eventNameEdit = modalBody.find('.eventNameEdit');
    let startDateEdit = modalBody.find('.startDateEdit');
    let endDateEdit = modalBody.find('.endDateEdit');
    let addDateEdit = modalBody.find('#addDateEdit');
    let remDateEdit = modalBody.find('#remDateEdit');
    

    data = {
        "edit": "editData",
        "eventId": eventId,
        "nazwa_wydarzenia": eventNameEdit, 
        "data_rozpoczecia": startDateEdit,
        "data_zakonczenia": endDateEdit,
        "daty_dodatkowe": addDateEdit,
        "daty_przerw": remDateEdit
    };

    $.ajax({
        type: "post",
        url: "http://localhost/kalendarz/php/app.php",
        data: data,
        dataType: "text",
        success: function (res) {
            console.log(res);
            
        }
    });
    
});

//Funkcje
function getTable(getType, year, month){

    if(!year || !month){
        url = `http://localhost/kalendarz/php/kalendarz.php?table=${getType}`;
    }else{
        url = `http://localhost/kalendarz/php/kalendarz.php?table=${getType}&month=${month}&year=${year}`;
    }

    
    $.ajax({
        type: "get",
        url: url,
        dataType: "html",
        success: function (response) {
            calendarDiv.html(response);
        }
    });
}

function getEvent(getType, div, param){
    
    url = `http://localhost/kalendarz/php/app.php`;
    data = {"getEvent": getType};

    if(param != ''){
        data.push({"data": param});
    }
    if(!div){
        return "Nie podano tabeli'u";
    }

    $.ajax({
        type: "get",
        url: url,
        data: data,
        dataType: "html",
        success: function (res) {
            $(`${div}`).find('tbody').html(res);
            $(div).append("<button class='btn btn-primary tableAddButton'>Dodaj</button>");
        }
    });

}

function displayContent(content){

    let block = $('.mainBlock');
    console.log(content);
    

    switch(content) {
        case 'calendarBlock':
            block.hide();
            $(`.${content}`).show();
            break;
        case 'editBlock':
            block.hide();
            $(`.${content}`).show();
            break;
        case 'addBlock':
            block.hide();
            $(`.${content}`).show();
            break;
        default:
            break;
    }

}
