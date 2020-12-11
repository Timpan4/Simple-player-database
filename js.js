$(document).ready(function () {
    //when button is pressed
    $('#update').click(function () {
        var allID = [];

        //loop through all input with name=goals
        $("input[name='goals']").each(function () {

            let id1 = $(this).attr('id');
            //create object with the id value, amount of matches and goals
            let id = {
                id: $(this).attr('id'),
                matches: $("#" + id1 + "[name='matches']").val(),
                goals: $(this).val()
            }
            //add the new object to the array
            allID.push(id);
        });


        //send array to postTo.php
        $.post("postTo.php", {
            id: JSON.stringify(allID)
        });
    });
});