
$(document).ready(function () {
    // AJAX call to get all books
    loadAllBooks();

    // AJAX call to get all book genres
    $.ajax({
      url: "database/fetch.php",
      method: "GET",
      data: {
        getAllGenres: true,
      },
      success: function (result) {
        $('#genres').html(result);

      },
      error: function () {
        $('#genres').html('<p class="center">Failed to fetch genres.</p>');
      }
    })
    
});

function UpdateBooksByGenre(genreOptionObj) {
  loadAllBooks(genreOptionObj.value)
}

function loadAllBooks(genreId = 0) {
  $.ajax({
    url: "database/fetch.php",
    method: "GET",
    data: {
      getAllBooks: true,
      genreID: genreId
    },
    success: function (result) {
        var books = jQuery.parseJSON(result);
        $('#books').html(books.html);
        $('#numBooks').text("Knih("+ books.num +")");

    },
    error: function () {
      $('#books').html('<p class="center">Failed to fetch books.</p>');
    }
  })
}


