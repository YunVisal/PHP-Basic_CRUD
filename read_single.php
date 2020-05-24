<!DOCTYPE HTML>
<html>
    <head>
        <title>Product Management System</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">  
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1>Product</h1>
            </div>

            <?php
                // get passed parameter value
                // isset() use to verify if a value is there or not
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

            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Name</td>
                    <td><?php echo htmlspecialchars($name, ENT_QUOTES);?></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><?php echo htmlspecialchars($description, ENT_QUOTES);?></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><?php echo htmlspecialchars($price, ENT_QUOTES);?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <a href='index.php' class='btn btn-danger'>Back to read products</a>
                    </td>
                </tr>
            </table>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>  
    </body>
  </html>