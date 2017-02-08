
<html>
<head>
    <title>Pregled recepata</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Chef's Cookbook</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="jquery-3.1.1.min.js"></script>
    <script src="admin.js"></script>
</head>
<body>
<div id="headerCon" class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2> Cookbook Database </h2>
        </div>
    </div>
</div>
<?php
include "conn.php";
include "Recipe.php";
$sql="SELECT idR, name, type, ing, prep FROM recipes ORDER BY idR DESC";
if (!$q=$mysqli-> query($sql)){
    echo "<p>Nastala je greska pri izvodenju upita</p>" . mysql_query();
    exit();
}

if(isset($_POST['addNew'])) {
    $name = $_POST['name'];

    $recipe = new Recipe();
}
if ($q->num_rows==0){
    echo "Empty cookbook";
} else {
    ?>

    <div class="container-fluid table-bordered">
        <div class="row center-block">
            <div class="col-lg-12">
                <div class="tab-content pre-scrollable">
                <table class="table-responsive table-bordered">
                    <tr class="text-justify">
                        <td><b>ID</b></td>
                        <td><b>Name</b></td>
                        <td><b>Type</b></td>
                        <td><b>Ingredients</b></td>
                        <td><b>Preparation</b></td>
                    </tr>
                    <?php
                    while ($red=$q->fetch_object()){
                        ?>
                        <tr aria-selected="true">
                            <td class="text-center" ><?php echo $red->idR; ?></td>
                            <td class="text-center"><?php echo $red->name; ?></td>
                            <td class="text-center"><?php echo $red->type; ?></td>
                            <td><?php echo $red->ing; ?></td>
                            <td><?php echo $red->prep; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row center-block">
            <div class="col-lg-2">

                <button id="edit" class="btn-danger btn-lg btn-success">Edit</button>

            </div>
            <div class="col-lg-2">

                <button id="delete" class="btn-danger btn-lg btn-success">Delete</button>

            </div>
            <div class="col-lg-2">
                <button id="new" class="btn-danger btn-lg btn-success" onclick="addNew()">New</button>

            </div>
        </div>
    </div>
    <?php
}
$mysqli->close();
?>

<div hidden id="add-new" class="container">
    <div class="row">
        <div class="col-md-4">
            <h2>Insert new recipe</h2>
            <hr/>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <!--FORMA-->
            <form class="form-horizontal" method="post" action=" ">
                <fieldset>

                    <!-- Form Name -->


                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name">Name</label>
                        <div class="col-md-4">
                            <input id="name" name="name" placeholder="name" class="form-control input-md" required type="text">

                        </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="type">Type</label>
                        <div class="col-md-4">
                            <select id="type" name="type" class="form-control">
                                <option value="breakfast">breakfast</option>
                                <option value="lunch">lunch</option>
                                <option value="dinner">dinner</option>
                                <option value="desert">desert</option>
                                <option value="bakery">bakery</option>
                            </select>
                        </div>
                    </div>

                    <!-- Textarea -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ing">Ingredients</label>
                        <div class="col-md-4">
                            <textarea class="form-control" id="ing" name="ing">...</textarea>
                        </div>
                    </div>

                    <!-- Textarea -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="prep">Preparation</label>
                        <div class="col-md-4">
                            <textarea class="form-control" id="prep" name="prep">...</textarea>
                        </div>
                    </div>
                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="submit"></label>
                        <div class="col-md-4">
                            <button type="submit" id="submit" name="addNew" class="btn btn-danger">Submit</button>
                        </div>
                    </div>

                </fieldset>
            </form>
            }
        </div>
    </div>
</div>
</body>
</html>
