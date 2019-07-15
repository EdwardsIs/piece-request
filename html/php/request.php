<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Request Processed</title>
        <!-- CDN imports for using bootstrap -->

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
    </head>
    <body class="container bg-light">
        <?php
            // Temporary - For debugging ONLY!
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            // Requiring external files containing classes
            require('pieceRequest.php');
            require('customer.php');

            // Pulling out data from form submission

            // Customer information stored in Customer object
            $customer = new Customer;
            $customer->setNumber($_REQUEST['number']);
            $customer->setName($_REQUEST['name']);
            $customer->setEmail($_REQUEST['email']);
            $customer->setPhone($_REQUEST['phone']);
            echo "<div class=\"row\"><h2>Thank you, " . $customer->getName() . "!</h2></div>";

            // Array to hold request objects
            $requests = array();

            // Pulling arrays of types, patterns, and quantities from POST request
            $types = $_REQUEST['types'];
            $patterns = $_REQUEST['patterns'];
            $quantities = $_REQUEST['quantities'];

            // Looping through all three arrays and creating objects,
            // which are then added to the "$requests" array.
            for($i = 0; $i < sizeof($types); $i++) {
                $requests[$i] = new PieceRequest;
                $requests[$i]->setPieceType($types[$i]);
                $requests[$i]->setPatternName($patterns[$i]);
                $requests[$i]->setQuantity($quantities[$i]);
            }

            echo "<div class=\"row\"><p>Your request for:</p></div><ul>";
            
            // Connecting to database
            require('mysqliConnect.php'); 

            // Inserting request header into database
            $headerQuery = "INSERT INTO technical_assessment.request_header(customer_number, customer_name, customer_email, customer_phone)
            VALUES (\"" . $customer->getNumber() ."\", \"". $customer->getName() ."\", \"". $customer->getEmail() ."\", \"". $customer->getPhone() ."\")";
            
            // Running query on database, retrieving results
            $headerResults = @mysqli_query($dbc, $headerQuery);

            if($headerResults) { // Header query ran fine
                // Getting last id to use as foreign key for detail records
                $lastId = mysqli_insert_id($dbc);
                
                // Foreach loop that runs through all request objects, prints the information to the screen,
                // and writes the detail record to the database
                foreach($requests as $request) {
                    // Testing to ensure object is valid, skipping if not
                    if ($request->getPieceType() != "") {
                        // Writing request details to the detail database table
                        $detailQuery = "INSERT INTO technical_assessment.request_detail(header_id, piece_type, patter_name, quantity)
                        VALUES (" . $lastId .", \"". $request->getPieceType() ."\", \"". $request->getPatternName() ."\", ". $request->getQuantity() .")";

                        $detailResults = @mysqli_query($dbc, $detailQuery);
                        
                        if($detailResults) { // Detail query ran fine
                            // Outputting information on each piece request as a list item
                            echo "<div class=\"row\"><li>";
                            echo $request->getQuantity() . " " . $request->getPatternName() . " " . $request->getPieceType();
                            echo "(s)</li></div>";
                        } else { // Detail query had errors
                            // Outputting error
                            echo "<div class=\"row\"><li>There was an error saving the: ";
                            echo $request->getPieceType();
                            echo "(s)". mysqli_error($dbc) ."</li></div>";
                        }
                    }
                }
                echo "</ul><div class=\"row\"><p>has been processed!</p></div>";
            } else { // Header query had errors
                echo "<h3>We're sorry, the database is unavailable!</h3>";
                echo "<p>" . mysqli_error($dbc) . "</p>";
            }

            // Closing connection to database
            mysqli_close($dbc);
        ?>
        <!-- Link to allow returns to main page -->
        <a href="../index.html">Return to main page</a>
    </body>
</html>