<?php
include 'top.php';
$debug = TRUE;
if (isset($_GET["debug"])) {
    $debug = true;
}

$file = fopen("csvfiles/country.csv", "r");

if ($debug) {
    if ($file) {
        print '';
    } else {
        print '<p<File Open Failed.</p>';
    }
}

while (!feof($file)) {
    $countries[] = fgetcsv($file);
}


$file = fopen("csvfiles/exp_month.csv", "r");

if ($debug) {
    if ($file) {
        print '';
    } else {
        print '<p<File Open Failed.</p>';
    }
}

while (!feof($file)) {
    $expmonths[] = fgetcsv($file);
}


$file = fopen("csvfiles/exp_year.csv", "r");

if ($debug) {
    if ($file) {
        print '';
    } else {
        print '<p<File Open Failed.</p>';
    }
}

while (!feof($file)) {
    $expyears[] = fgetcsv($file);
}

fclose($file);



//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//       
print PHP_EOL . '<!-- SECTION: 1 Initialize variables -->' . PHP_EOL;
// These variables are used in both sections 2 and 3, otherwise we would
// declare them in the section we needed them
//print  PHP_EOL . '<!-- SECTION: 1a. debugging setup -->' . PHP_EOL;
// We print out the post array so that we can see our form is working.
// Normally i wrap this in a debug statement but for now i want to always
// display it. when you first come to the form it is empty. when you submit the
// form it displays the contents of the post array.
// if ($debug){ 
//print '<p>Post Array:</p><pre>';
//print_r($_POST);
//print '</pre>';
// }
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
print PHP_EOL . '<!-- SECTION: 1b form variables -->' . PHP_EOL;
//
// Initialize variables one for each form element
// in the order they appear on the form



$email = $_POST['txtEmail'];

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
print PHP_EOL . '<!-- SECTION: 1c form error flags -->' . PHP_EOL;
//
// Initialize Error Flags one for each form element we validate
// in the order they appear on the form

$emailERROR = false;

////%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
print PHP_EOL . '<!-- SECTION: 1d misc variables -->' . PHP_EOL;
//
// create array to hold error messages filled (if any) in 2d displayed in 3c.
$errorMsg = array();

// have we mailed the information to the user, flag variable?
$mailed = false;

////@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
print PHP_EOL . '<!-- SECTION: 2 Process for when the form is submitted -->' . PHP_EOL;
//
if (isset($_POST["btnSubmit"])) {

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    print PHP_EOL . '<!-- SECTION: 2a Security -->' . PHP_EOL;

    // the url for this form
    $thisURL = $domain . $phpSelf;

    if (!securityCheck($thisURL)) {
        $msg = '<p>Sorry you cannot access this page.</p>';
        $msg .= '<p>Security breach detected and reported.</p>';
        die($msg);
    }

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    print PHP_EOL . '<!-- SECTION: 2b Sanitize (clean) data  -->' . PHP_EOL;
    // remove any potential JavaScript or html code from users input on the
    // form. Note it is best to follow the same order as declared in section 1c.



    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);




    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    print PHP_EOL . '<!-- SECTION: 2c Validation -->' . PHP_EOL;
    //
    // Validation section. Check each value for possible errors, empty or
    // not what we expect. You will need an IF block for each element you will
    // check (see above section 1c and 1d). The if blocks should also be in the
    // order that the elements appear on your form so that the error messages
    // will be in the order they appear. errorMsg will be displayed on the form
    // see section 3b. The error flag ($emailERROR) will be used in section 3c.








    if ($email == "") {
        $errorMsg[] = 'Please enter your email address';
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = 'Your email address appears to be incorrect.';
        $emailERROR = true;
    }

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    print PHP_EOL . '<!-- SECTION: 2d Process Form - Passed Validation -->' . PHP_EOL;
    //
    // Process for when the form passes validation (the errorMsg array is empty)
    //    
    if (!$errorMsg) {
        


        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        print PHP_EOL . '<!-- SECTION: 2e Save Data -->' . PHP_EOL;
        //
        // This block saves the data to a CSV file.   
        // array used to hold form values that will be saved to a CSV file
        $dataRecord = array();

        // assign values to the dataRecord array

        $dataRecord[] = $email;

        // setup csv file
        $myFolder = 'data/';
        $myFileName = 'registration';
        $fileExt = '.csv';
        $filename = $myFolder . $myFileName . $fileExt;

      

        // now we just open the file for append
        $file = fopen($filename, 'a');

        // write the forms informations
        fputcsv($file, $dataRecord);

        // close the file
        fclose($file);


        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        print PHP_EOL . '<!-- SECTION: 2f Create message -->' . PHP_EOL;
        //
        // build a message to display on the screen in section 3a and to mail
        // to the person filling out the form (section 2g).

        $message = $_POST['txtFirstName'] . ", <br>Thank you for donating to Save the Sea Otters!";
        $message = "<br>";
        $message .= "\nEvery month, " . $_POST['donation'] . " will be donated to rescuing endangered Sea Otters.";




        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        print PHP_EOL . '<!-- SECTION: 2g Mail to user -->' . PHP_EOL;
        //
        // Process for mailing a message which contains the forms data
        // the message was built in section 2f.
        $to = $email; // the person who filled out the form
        $cc = '';
        $bcc = '';

        $from = 'skimura@uvm.edu';

        // subject of mail should make sense to your form
        $subject = 'Donation Confirmation: ';

        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
    } // end form is valid   
}   // ends if form was submitted.
//#############################################################################
//
print PHP_EOL . '<!-- SECTION 3 Display Form -->' . PHP_EOL;
//


?>       
<main id="main">     
    <article>
        <?php
//####################################
//
        print PHP_EOL . '<!-- SECTION 3a  -->' . PHP_EOL;
// 
// If its the first time coming to the form or there are errors we are going
// to display the form.

        if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { // closing of if marked with: end body submit
            print '<h1>Thank you for donating to Save the Sea Otters!</h1>';

            print '<p>For your records a copy of this data has ';
            if (!$mailed) {
                print "not";
            }

            print 'been sent:</p>';
            print '<p>To: ' . $email . '</p>';
        } else {
            print '';
            //print '<p class="form-heading">Your information will greatly help us with our research.</p>';
            //####################################
            //
        print PHP_EOL . '<!-- SECTION 3b Error Messages -->' . PHP_EOL;
            //
            // display any error messages before we print out the form

            if ($errorMsg) {
                print '<div id="errors">' . PHP_EOL;
                print '<h2>Your form has the following mistakes that need to be fixed.</h2>' . PHP_EOL;
                print '<ol>' . PHP_EOL;

                foreach ($errorMsg as $err) {
                    print '<li>' . $err . '</li>' . PHP_EOL;
                }

                print '</ol>' . PHP_EOL;
                print '</div>' . PHP_EOL;
            }

            //####################################
            //
        print PHP_EOL . '<!-- SECTION 3c html Form -->' . PHP_EOL;
            //
            /* Display the HTML form. note that the action is to this same page. $phpSelf
              is defined in top.php
              NOTE the line:
              value="<?php print $email; ?>
              this makes the form sticky by displaying either the initial default value (line ??)
              or the value they typed in (line ??)
              NOTE this line:
              <?php if($emailERROR) print 'class="mistake"'; ?>
              this prints out a css class so that we can highlight the background etc. to
              make it stand out that a mistake happened here.
             */
            ?>    


            <button class="openbtn" onclick="openNav()">&#9776; Menu</button> 
            <form action = "<?php print $phpSelf; ?>"
                  id = "frmRegister"
                  method = "post">

                <fieldset class = "contact">

                    <legend>Contact Information</legend>

                    <label>First Name</label>
                    <input type="text" name="txtFirstName" id="txtFirstName">
                    <hr>

                    <label>Email</label>
                    <input type="text" name="txtEmail" id="txtEmail">
                    <hr>

                    <label>Phone</label>
                    <input type="text" name="txtPhone" id="txtPhone">
                    <hr>

                    <label>Would you like us to share your information(i.e. email lists and newsletters)</label>

                    <input type="radio" name="shareInfo" id="yes" value="on" checked="checked"> Yes
                    <input type="radio" name="shareInfo" id="no" value="off"> No

                </fieldset> <!-- ends contact -->

                <fieldset class="donationAmount">
                    <label for="donationAmount">Donation Amount</label>
                    <label>$<input type="text" name="donationAmount" id="donationAmount"></label>

                </fieldset>

                <fieldset class="comments">

                    <legend>Comments</legend>

                    <textarea id="txtComments" name="txtComments"></textarea>

                </fieldset>

                <fieldset class="billing">
                    <legend>Billing Information</legend>

                    <label>Country</label>

                    <select name="country">
                        <?php
                        foreach ($countries as $country) {
                            print '<option value = "' . $country[0] . '">' . $country[0] . '</option>';
                        }
                        ?>
                    </select>
                    <hr>

                    <label>Address 1</label>
                    <input type="text" name="address" id="address1">
                    <hr>

                    <label>Address 2</label>
                    <input type="text" name="address" id="address2">
                    <hr>

                    <label>City</label>
                    <input type="text" name="city" id="city">
                    <hr>

                    <label>State/Province/Region</label>
                    <input type="text" name="region" id="region">
                    <hr>

                    <label>Zip Code</label>
                    <input type="text" name="zip" id="zip">
                    <hr>

                    <label>
                        <input type="checkbox" checked="checked" name="sameadr"> Shipping and billing address are the same
                    </label>
                </fieldset>

                <fieldset class="payment">    
                    <legend>Payment</legend>
                    <label>Name on Card</label>
                    <input type="text" name="cardname" id="cardname">
                    <hr>

                    <label>Card Number</label>
                    <input type="text" name="cardnum" id="cardnum">
                    <hr>

                    <label>Expiration</label>
                    <select name="exp" id="exp">
                        <?php
                        foreach ($expmonths as $expmonth) {
                            print '<option value = "' . $expmonth[0] . '">' . $expmonth[0] . '</option>';
                        }
                        ?>
                    </select>
                    <select name="exp">
                        <?php
                        foreach ($expyears as $expyear) {
                            print '<option value = "' . $expyear[0] . '">' . $expyear[0] . '</option>';
                        }
                        ?>
                    </select>
                    <hr>

                    <label class="required">CVV</label>
                    <input type="text" name="cvv" id="cvv">
                </fieldset> 

                <input type="checkbox" checked="checked">By donating you agree to our<a href="terms.php">Terms & Privacy</a>.</p>   
                <input class = "button" id = "btnSubmit" name = "btnSubmit" type = "submit" value = "Donate" >


            </form>    
            <?php include 'footer.php'; ?>

            <?php
        } // ends body submit
        ?>
    </article>     
</main>     

</body>     
</html>