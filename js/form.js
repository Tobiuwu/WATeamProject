
$(document).ready(function () {
    getCommentsByBookId();
});

function failed_submit(id, error_message = "Formulář se správně neodeslal, zkuste to znovu.") {
    // Function sets HTML for when form submit has failed
    setTimeout(function () {
        $(id).html(`
        <h3 class="error">Chyba!</h3>
        <h6 class="error">${error_message}</h6>
        </br>

        `)
    }, 700);
}

$("#loginForm").submit(function(e) {
    e.preventDefault();
});
$("#submitForm").submit(function(e) {
    e.preventDefault();
});
$("#postCommentForm").submit(function(e) {
    e.preventDefault();
});

$('#submit_login').click(function () {
    // Get variables from form and submit it
    var email = $('#email').val();
    var pwd = $('#pw').val();

    // AJAX Post sending data
    $.ajax({
        url: "database/post.php",
        method: "POST",
        data: {
            Login: true,
            email: email,
            pw: pwd,
        },
        success: function (result) {
            $(location).attr('href','index.php')
        },
        error: function () {
            // Failed submition (Http 400 or Http 500)
            failed_submit('#result');
        }
    })
});

$('#submit_register').click(function () {
    // Get variables from form and submit it
    var email = $('#email').val();
    var pwd = $('#pwd').val();
    var username = $("#username").val();
    var birthyear = $("#date").val();
    var name = $("#name").val();
    var surname = $("#surname").val();

    // AJAX Post sending data
    $.ajax({
        url: "database/post.php",
        method: "POST",
        data: {
            Register: true,
            email: email,
            pw: pwd,
            username: username,
            birthyear: birthyear,
            name: name,
            surname: surname
        },
        success: function (result) {
            $(location).attr('href','login.php')
        },
        error: function () {
            // Failed submition (Http 400 or Http 500)
            failed_submit('#result');
        }
    })
});

$('#submitComment').click(function () {
    // Get variables from form and submit it
    var commentText = $('#commentText').val();
    var bookId = $('#bookId').val();
    var userId = $('#userId').val();

    // AJAX Post sending data
    $.ajax({
        url: "database/post.php",
        method: "POST",
        data: {
            Comment: true,
            commentText: commentText,
            bookId: bookId,
            userId: userId
        },
        success: function (result) {
            alert("Comment Posted")
            getCommentsByBookId();
        },
        error: function () {
            // Failed submition (Http 400 or Http 500)
            alert("Failed to submit comment, please make sure you are logged in")
        }
    })
});

function getCommentsByBookId() {
    var bookId = $('#bookId').val();
    $.ajax({
      url: "database/fetch.php",
      method: "GET",
      data: {
        getCommentsByBook: true,
        bookId: bookId
      },
      success: function (result) {
          var comments = jQuery.parseJSON(result);
          $('#comment_section').html(comments.html);
          console.log("Loaded " + comments.num + " Comments")
  
      },
      error: function () {
        $('#comment_section').html('<p class="center">Failed to fetch comments.</p>');
      }
    })
  }
  
  