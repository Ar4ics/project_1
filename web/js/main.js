function show() {
    $('#main').removeClass("hidden");
    $('#main').addClass("visible");
}

$(document).ready(function() {
var id = [];
$('body').on('click', '#chooser', function() {
    $('#chooser').prop("disabled",true);
    $.ajax({ 
    async: true,
    method: 'POST', 
    url: "/roadto86/ajax/new",
    data: { 'ids': id }, 
    dataType: 'json',
    success: function (data) { 
        $(".prepods").html("<img class='images' src='"+data.img.toString()+"'/>");
        $('#attempts').html("Осталось попыток: " + (2 - id.length));
        if (data.winner != 0) {
        if (data.winner == 2)
         {
            $(".prepods").append('<p>Поздравляем, ' + $('#name').html() + ', Вы победили в викторине "RoadTo86"!</p>');
            $(".prepods").append('<p>Поздравления от ' + data.name + ": " + data.text + "</p>");
            
        } 
        if (data.winner == 1)
        {
            $(".prepods").append('<p>Увы, ' + $('#name').html() + ', Вы не смогли победить в викторине "RoadTo86"!</p>');
            $(".prepods").append('<p>Утешительные пожелания от ' + data.name + ": " + data.text + "</p>");
        }
        } else {
            id.push(data.ids);
            $('#chooser').prop("disabled",false);
        }
        


    }
});
    
    
});




});

