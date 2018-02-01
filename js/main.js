$( document ).ready(function() {

    $("#booking-form").on("submit", function(){


        $.ajax({ // create an AJAX call...
            data: $(this).serialize(), // get the form data
            type: $(this).attr('method'), // GET or POST
            url: 'result.php', // the file to call
            success: function(response) { // on success..
                $('#results').html(response); // update the DIV

                $('html, body').animate({
                    scrollTop: $("#results").offset().top
                }, 2000);

            }
        });
        return false;

    })


});