// Questa è l'API, l'URL di base e l'URL dell'immagine
const APIKEY = 'api_key=02e3a326a583ca3d6822726c2970a704';
const BASEURL = 'https://api.themoviedb.org/3';
const IMAGEURL = 'https://image.tmdb.org/t/p/w500';

// Loop attraverso l'array dei film preferiti
USER_FAVOURITES.forEach(async id => {
  let link = `/movie/${id}?language=en-US&`;
  let url = BASEURL + link + APIKEY;
  await apiCall(url, id);
});

// Chiamiamo la funzione per richiedere l'API
function apiCall(url, id) {
  $.get(url, function (jsonRes) {
    favMovieData(jsonRes, id);
  });
}

/// Visualizziamo i film preferiti qui
function favMovieData(jsonResp, id) {
  var eachListItem = $('<div>').addClass('list-item');
  eachListItem.html(`
    <div class="movie-details">
      <div class="thumbnail">
        <a href="/web/pages/movie-detail.php?id=${id}">
          <img id="movieimg" src=${IMAGEURL+jsonResp.poster_path} alt="Thumbnail">
        </a>
      </div>
      <div id="details">
        <div class="title">
          <a href="/web/pages/movie-detail.php?id=${id}">${jsonResp.title}</a> 
        </div>
        <div class="remove-movie" id='${id}' onclick="deleteMovie(${id})">
          <i id="removeicon" class="far fa-trash-alt"></i>
        </div>
      </div>
    </div>
  `);
  $('#list-container').append(eachListItem);
}

// Rimuoviamo tutti i film dall'elenco dei preferiti
// Cancella la memoria locale.
$('#clear-whole-list').click(function () {
  $.post("/web/action/do-remove-all-favourites.php").then(() => {
    location.reload();
  })
});

// Elimina un singolo film dall'array dei preferiti
async function deleteMovie(movieId) {
  if (window.confirm('Delete this movie from fav list?')) {
    $.post("/web/action/do-remove-from-favourites.php",{
      movieId
    }).then(() => {
      location.reload();
    })
  }
}
