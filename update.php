<!DOCTYPE HTML>
<html>
    <head>
        <title>Product Management System</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">  
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1>Update Product</h1>
            </div>

            <?php
                $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
                
                include 'config/db.php';
                
                try {
                    $query = "SELECT id, name, description, price FROM products WHERE id = ? LIMIT 0,1";
                    
                    $stmt = $con->prepare( $query ); 
                    $stmt->bindParam(1, $id);
                    $stmt->execute();
                    
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    $name = $row['name'];
                    $description = $row['description'];
                    $price = $row['price'];
                }
                catch(PDOException $exception){
                    die('ERROR: ' . $exception->getMessage());
                }
            ?>

            <?php
                if($_POST){
                    try{
                        $query = "UPDATE products 
                                    SET name=:name, description=:description, price=:price 
                                    WHERE id = :id";
                        $stmt = $con->prepare($query);

                        $name=htmlspecialchars(strip_tags($_POST['name']));
                        $description=htmlspecialchars(strip_tags($_POST['description']));
                        $price=htmlspecialchars(strip_tags($_POST['price']));
                
                        $stmt->bindParam(':name', $name);
                        $stmt->bindParam(':description', $description);
                        $stmt->bindParam(':price', $price);
                        $stmt->bindParam(':id', $id);
                        
                        if($stmt->execute()){
                            echo "<div class='alert alert-success'>Record was updated.</div>";
                        }else{
                            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                        }
                    }
                    catch(PDOException $exception){
                        die('ERROR: ' . $exception->getMessage());
                    }
                }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] ."?id={$id}");?>" method="post">
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Name</td>
                        <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);?>" class='form-control' /></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES);?></textarea></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><input type='text' name='price' value="<?php echo htmlspecialchars($price, ENT_QUOTES);?>" class='form-control' /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type='submit' value='Save Changes' class='btn btn-primary' />
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