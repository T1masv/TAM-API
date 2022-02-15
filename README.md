# TAM-API

### This is the API for TAM website 
BASE_URL: https://dswtool.com/v1/controler/
ENDPOINTS:
POST movie.php?option="list" 
  {
    "user_id":[0-9]*
  }
POST movie.php?option="add"
  {
    "user_id":[0-9]*
    "movie_id":[0-9]*
  }
POST movie.php?option="remove"
  {
    "user_id":[0-9]*
    "movie_id":[0-9]*
  }
POST user.php  // Pour se connecter
  {
    "username":* 
  }
