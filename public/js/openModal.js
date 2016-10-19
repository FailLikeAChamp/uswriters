"use strict";

$(document).ready(function() {
	// apply animatedModalJs to every li with class submitted
	$("#myLetters li.submitted, #myLetters li.sent").each(function(index) {

        $(this).animatedModal({
            modalTarget:'letterModal',
            animatedIn:'zoomInUp',
            animatedOut:'zoomOutDown',
            animationDuration:'.7s',
            color:'#3498db', 
            // Callbacks
            beforeOpen: function(letterId) {
            	const $letterModal = $("#letter");
            	const $letterBody = $("#letterBody");
            	const $spinner = $("#spinnerWrap");
            	$letterModal.show();
            	$spinner.show();
                $letterBody.show();
            
                $.get("../app/helpers/getLetter.php?letter_id="+letterId, function(data, status) {
                	if (data === "error") {
                		$spinner.hide();
                		$letterBody.html("<div class='letterError'>Error: Could not retrieve letter from database.</div>");
                	} else {
                		$spinner.hide();
                		$letterBody.html(data);
                	}
			    });
            },         
            beforeClose: function() {
                $("#letter").hide();
                $("#letterBody").html("");
                $("#letterBody").hide();
            }
        });

    });
});