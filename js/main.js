(function () {
  "use strict";
  $(document).ready(function() {
    var max_fields = 5; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e) {
      //on add input button click
      e.preventDefault();
      if (x < max_fields) {
        //max input box allowed
        x++; //text box increment
        $(wrapper).append(
          '<div><input type="text" name="add_line1[]" class="form-control mt-2" id="add_line1"/><a href="#" class="remove_field">Remove</a></div>'
        ); //add input box
      } else {
        alert("You Reached the limits");
      }
    });

    $(wrapper).on("click", ".remove_field", function(e) {
      //user click on remove text
      e.preventDefault();
      $(this).parent("div").remove();
      x--;
    });

//user click on remove text
    $("#mail").keyup(function() {

      var mail = $(this).val().trim();
      // if email field is null then return
      if (mail == "") {
        return;
      }


      $.ajax({
        url: 'add.php',
        type: 'post',
        data: {
          mail: mail,
          'email_check': 1,
        },
        success: function(response) {
          if (response != 0) {
            $("#email_error").remove();
            // Show response
            //$("#uname_response").html(response);
            $("#add").attr('disabled', true);
            $("#mail").after("<span id='email_error' class='text-danger'>" + response + "</span>");
          } else {
            $("#add").attr('disabled', false);
            //$("#mail").after("<span id='email_error' class='text-danger'>success</span>");
          }

        },
        error: function(e) {
          $("#result").html("Something went wrong");
        }
      });


    });

     /* Delete Address button ajax call */
     $(".delAddrBtn").on("click", function(event) {
      event.preventDefault();
      var selected = new Array();
      $("input.emp_checkbox:checked").each(function() {
        var a = $(this).data("aid");
        selected.push(a);
      });
      if (
        confirm(
          "This action will delete this record. Are you sure? \n IDs - " + selected
        )
      ) {

      $.post("delete_multiAddr.php", {
        aid: selected
        }).done(function(data) {
          if (data > 0) {
            $(".success")
              .show(800)
              .html("Record deleted successfully.")
              .delay(3200)
              .fadeOut(6000);
            alert("Address deleted successfully.");
          } else {
            $(".error")
              .show(800)
              .html("Address could not be deleted. Please try again.")
              .delay(3200)
              .fadeOut(6000);
          }
          setTimeout(function() {
            window.location.reload(1);
          }, 800);
        });
      }

    });


      /* Delete button ajax call */
      $(".delbtn").on("click", function(event) {
        event.preventDefault();
        var aid = $(this).data("aid");
        if (
          confirm(
            "This action will delete this record. Are you sure? \n ID-" + aid
          )
        ) {
          var aid = $(this).data("aid");
          //   $('.delbtn').text('Deleting');
          $.post("delete.php", {
            aid: aid
          }).done(function(data) {
            if (data > 0) {
              $(".success")
                .show(800)
                .html("Record deleted successfully.")
                .delay(3200)
                .fadeOut(6000);
              alert("Record deleted successfully.");
            } else {
              $(".error")
                .show(800)
                .html("Record could not be deleted. Please try again.")
                .delay(3200)
                .fadeOut(6000);
            }
            setTimeout(function() {
              window.location.reload(1);
            }, 800);
          });
        }
      });
  });

})();
