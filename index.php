<!DOCTYPE HTML>
<html>
    <head>
        <title>Product Management System</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">  
        <style>
            .m-r-1em{ margin-right:1em; }
            .m-b-1em{ margin-bottom:1em; }
            .m-l-1em{ margin-left:1em; }
            .mt0{ margin-top:0; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1>Products</h1>
            </div>

            <?php
                // include database connection
                include 'config/db.php';
                
                $action = isset($_GET['action']) ? $_GET['action'] : "";
                // if it was redirected from delete.php
                if($action=='deleted'){
                    echo "<div class='alert alert-success'>Record was deleted.</div>";
                }
                
                $query = "SELECT id, name, description, price FROM products";
                $stmt = $con->prepare($query);
                $stmt->execute();
                
                // this is how to get number of rows returned
                $num = $stmt->rowCount();
                
                // link to create record form
                echo "<a href='create.php' class='btn btn-primary m-b-1em'>Create New Product</a>";
                
                //check if more than 0 record found
                if($num>0){
                    echo "<table class='table table-hover table-responsive table-bordered'>";=
 
                    //creating our table heading
                    echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Name</th>";
                        echo "<th>Description</th>";
                        echo "<th>Price</th>";
                        echo "<th>Action</th>";
                    echo "</tr>";
                     
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        // extract row, this will make $row['firstname'] to just $firstname only
                        extract($row);
                         
                        // creating new table row per record
                        echo "<tr>";
                            echo "<td>{$id}</td>";
                            echo "<td>{$name}</td>";
                            echo "<td>{$description}</td>";
                            echo "<td>&#36;{$price}</td>";
                            echo "<td>";
                                echo "<a href='read_single.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>";
                                echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";
                                echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>";
                            echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                // if no records found
                else{
                    echo "<div class='alert alert-danger'>No records found.</div>";
                }
            ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
        <script type='text/javascript'>
            // confirm record deletion
            function delete_user( id ){
                var answer = confirm('Are you sure?');
                if (answer){
                    // if user clicked ok, pass the id to delete.php and execute the delete query
                    window.location = 'delete.php?id=' + id;
                }
            }
        </script>
    </body>
</html>