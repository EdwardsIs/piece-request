// Array to hold JSON objects for all piece requests
let pieces = [];

// Function to validate form before submitting to be processed
function checkForm() {
    if(pieces.length == 0) {
        alert("Please enter at least 1 piece request")
    } else {
        // Checking to ensure all required information has been entered properly

        // Removing trailing/leading whitespace from values
        document.getElementById("number").value = document.getElementById("number").value.replace(/^\s+/, '').replace(/\s+$/, '');
        document.getElementById("name").value = document.getElementById("name").value.replace(/^\s+/, '').replace(/\s+$/, '');
        document.getElementById("email").value = document.getElementById("email").value.replace(/^\s+/, '').replace(/\s+$/, '');
        document.getElementById("phone").value = document.getElementById("phone").value.replace(/^\s+/, '').replace(/\s+$/, '');

        console.log("Number: " + document.getElementById("number").value);
        console.log("Name: " + document.getElementById("name").value);
        console.log("Email: " + document.getElementById("email").value);
        console.log("Phone: " + document.getElementById("phone").value);

        // Array to hold errors
        let errors =[];

        // Checking for, and adding any neccesary errors to the errors list
        if(document.getElementById("number").value === '' || isNaN(document.getElementById("number").value)) {
            errors.push("Customer number requires a numeric value");
        }

        if(document.getElementById("name").value === '') {
            errors.push("Customer name requires an entry");
        }

        if(document.getElementById("number").value === '' || !(document.getElementById("email").value.includes("@")) || !(document.getElementById("email").value.includes("."))) {
            errors.push("Email must have an @ symbol, as well as a domain. (e.g., gmail.com)");
        }

        if(isNaN(document.getElementById("phone").value)) {
            errors.push("Phone number must be numeric only. (No dots, dashes, letters, or parentheses)");
        }

        // Checking to see if any errors occurred
        if (errors.length > 0) { // Errors occurred
            // Collecting and displaying all errors
            let errorString = '';
            for (i = 0; i < errors.length; i++) {
                errorString += errors[i] + '\n';
            }
            alert(errorString);
        } else { // No errors occurred
            // Looping through the array of pieces objects, and setting
            // hidden fields to appropriate values
            for (i = 0; i < pieces.length; i++) {
                document.getElementById("type"+(i+1).toString()).value = pieces[i].type;
                document.getElementById("pattern"+(i+1).toString()).value = pieces[i].pattern;
                document.getElementById("quantity"+(i+1).toString()).value = pieces[i].quantity;
            }
            document.getElementById("confirmation").innerHTML = "";
            document.getElementById("main").submit();
        }
    }
}

function addPiece() {
    // Checking to see if three pieces have already been added
    if(pieces.length > 2) {
        alert("You can only enter three piece requests at a time");
        clearRequestInputs();
        return; // Exiting the function
    }

    // Retrieving string values from form elements
    let pieceType = document.getElementById("piece_type").value;
    let pattern = document.getElementById("pattern_name").value;
    let quantity = document.getElementById("quantity").value;

    // Removing all whitespace using regex
    pieceType = pieceType.replace(/^\s+/, '').replace(/\s+$/, '');
    pattern = pattern.replace(/^\s+/, '').replace(/\s+$/, '');
    quantity = quantity.replace(/^\s+/, '').replace(/\s+$/, '');

    // Checking to see if any of the values were null
    if(pieceType === '' || pattern === '' || quantity === '') {
        // Displaying error message
        alert("Please enter values for all piece request fields before adding request");
    } else {
        // Parsing number from quantity
        quantity = Number(quantity);

        // Creating piece request JSON object, and adding it to the pieces list
        pieces.push({type: pieceType, pattern: pattern, quantity: quantity});

        clearRequestInputs();
        
        // Displaying confirmation
        document.getElementById("confirmation").innerHTML += "Your request for " + quantity + " " + pattern + " " + pieceType + "(s) has been added!</br>";
    }
}

function clearRequestInputs() {
    // Clearing the piece request section of the form
    document.getElementById("piece_type").value = "";
    document.getElementById("pattern_name").value = "";
    document.getElementById("quantity").value = "";
}