<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <div class="container mt-5 border border-info p-5 shadow-lg rounded-3">
        <h1 class="text-center">Login</h1>
        <form action="./login_action.php" method="POST">
            <div>
                <label for="mail">E-mail:</label>
                <input type="text" name="mail" class="form-control">
            </div>
            <div>
                <label for="mot_de_passe">Mot de passe:</label>
                <input type="password" name="mot_de_passe" class="form-control">
            </div>
            <input type="submit" value="Se connecter" class="btn btn-success mt-5" name="login">
            <a href="http://localhost:8888/projet_bibliotheque_clone/index.php" class="btn btn-danger mt-5">Annuler</a>
        </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
</body>
</html>