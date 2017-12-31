<?php
include "config.php";
include 'controladores/indexController.php';
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sakila</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
//var_dump($opt_rating);
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Sakila</h1>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Incio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Descargar</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="descargar.php?formato=xml&tipo=film">XML</a>
                            <a class="dropdown-item" href="descargar.php?formato=csv&tipo=film">CSV</a>
                            <a class="dropdown-item" href="descargar.php?formato=xls&tipo=film">Excel</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        Filtrar <i class="fa fa-filter" aria-hidden="true"></i>
                    </div>
                    <div class="card-body">
                        <form action="descargar.php">
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="title">Title</label>
                                    <input name="title" type="text" class="form-control form-control-sm">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputState">Rating</label>
                                    <select name="rating" id="inputState" class="form-control form-control-sm">
                                        <option></option>
                                        <?php foreach ($opt_rating as $rating): ?>
                                            <option value="<?php echo $rating["rating"] ?>"><?php echo $rating["rating"] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputState">Release year</label>
                                    <select name="release_year" id="inputState" class="form-control form-control-sm">
                                        <option></option>
                                        <?php foreach ($opt_release_year as $release_year): ?>
                                            <option value="<?php echo $release_year["release_year"] ?>"><?php echo $release_year["release_year"] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputState">Language</label>
                                    <select name="language_id" id="inputState" class="form-control form-control-sm">
                                        <option></option>
                                        <?php foreach ($opt_languages as $languages): ?>
                                            <option value="<?php echo $languages["id"] ?>"><?php echo $languages["name"] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputState">Category</label>
                                    <select name="category_id" id="inputState" class="form-control form-control-sm">
                                        <option></option>
                                        <?php foreach ($opt_category as $category): ?>
                                            <option value="<?php echo $category["id"] ?>"><?php echo $category["name"] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($films["items"] as $film): ?>
            <div class="col-md-3">
                <?php echo "$film[film_id] - $film[title]" ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="row justify-content-center mt-5">
            <?php paginacion_render($films["render"]) ?>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
<?php mysqli_close($link) ?>
</body>
</html>