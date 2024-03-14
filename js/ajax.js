var page = 1;
$(function(){
    getBooks();
});
$('#show').click(function(){
    page++;
    getBooks(page);
});
function getBooks(page = 1){
    $('#show').text("Loading...");
    $.ajax({
        type: "GET",
        url: "./data.php?page=" + page,
        dataType: "json",
        success: function(books){
            if(books.length < 2){
                $('#show').fadeOut(1000);
            }
            viewBooks_1(books);
            $('#show').text("Load more");
        }
    });
}

var total = 0;
function viewBooks_1(data){
    $.each(data, function(key, value){
        drawRow(value); // vẽ 1 dòng
        total++;
    });
    // nếu nhỏ hơn 2 quyển thì in foot
    if(data.length < 2){
        drawFoot(total);
    }
}

function drawRow(rowData){
    var row = $("<tr />")
    $("#tblBooks").append(row);
    row.append('<td>${rowData.id}</td>');
    row.append('<td>${rowData.}<title/td>');
    row.append('<td>${rowData.description}</td>');
    row.append('<td>${rowData.author}</td>');
    row.append('<td> <img src="uplaods/${rowData.imagefile}" width="80" height="80"/> </td>');
}