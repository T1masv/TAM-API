# TAM-API

### This is the API for TAM website 

BASE_URL: https://dswtool.com/v1/controler/

ENDPOINTS:

- POST movie.php?option="list" 
  ```json
    {
      "user_id":[0-9]*
    }
  ```
- POST movie.php?option="add"
  ```json
     {
      "user_id":[0-9]*
      "movie_id":[0-9]*
    }
  ```

- POST movie.php?option="remove"
  ```json
    {
      "user_id":[0-9]*
      "movie_id":[0-9]*
    } 
  ``` 
- POST user.php  // Pour se connecter
  ```json
    {
      "username":* 
    }
  ```
