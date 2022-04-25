/* Jquery */
$(document).ready(function() {
    $("#submit_button").click(function() {
        checked = $("input[type=radio]:checked").length;

        if (checked < 1) {
            alert("You must check one radio.");
            return false;
        }
    });
});

/* JS */
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById("form");
    const reset = document.getElementById("reset_button");
    reset.onclick = () => {
        if (confirm("Are you sure you want to reset?")) {
            form.reset();
        }
    }
});