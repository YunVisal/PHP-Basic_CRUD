<!DOCTYPE HTML>
<html>
<head>
    <title>Product Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">  
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>Create Product</h1>
        </div>
      
        <?php
            if($_POST){
                include 'config/db.php';
            
                try{
                    $query = "INSERT INTO products SET name=:name, description=:description, price=:price, created=:created";
                    $stmt = $con->prepare($query);

                    $name=htmlspecialchars(strip_tags($_POST['name']));
                    $description=htmlspecialchars(strip_tags($_POST['description']));
                    $price=htmlspecialchars(strip_tags($_POST['price']));
            
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':price', $price);
                    
                    // specify date
                    $created=date('Y-m-d H:i:s');
                    $stmt->bindParam(':created', $created);
                    
                    if($stmt->execute()){
                        echo "<div class='alert alert-success'>Record was saved.</div>";
                    }
                    else{
                        echo "<div class='alert alert-danger'>Unable to save record.</div>";
                    }
                }
                catch(PDOException $exception){
                    die('ERROR: ' . $exception->getMessage());
                }
            }
        ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Name</td>
                <td><input type='text' name='name' class='form-control' /></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><textarea name='description' class='form-control'></textarea></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><input type='text' name='price' class='form-control' /></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type='submit' value='Save' class='btn btn-primary' />
                    <a href='index.php' class='btn btn-danger'>Back to read products</a>
                </td>
            </tr>
        </table>
    </form>
          
    </div>
      
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>  
</body>
</html>