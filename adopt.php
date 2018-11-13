<?php
include ('top.php');

// Sends email to user after form is submitted
if (isset($_POST['send'])) {
    $to = $_POST['email'];
    
    $message = $_POST['name'] . ", \nThank you for adopting a Sea Otter!";
    $message .= "\nEvery month, " . $_POST['donation'] . " will be donated to caring for your Sea Otter.";
    $cc = '';
    $bcc = '';
    $from = 'customerservice@savetheseaotters.org';
    
    $subject = 'Adoption Confirmed:';
    $mailed = mail($to, $cc, $bcc, $from, $subject, $message);
}

$debug = TRUE;
if(isset($_GET["debug"])){
    $debug = true;
}

$file = fopen("country.csv", "r");

if($debug){
    if($file){
        print '';
    }else{
        print '<p<File Open Failed.</p>';
    }
}

while(!feof($file)){
    $countries[] = fgetcsv($file);
}

$file = fopen("exp_month.csv", "r");

if($debug){
    if($file){
        print '';
    }else{
        print '<p<File Open Failed.</p>';
    }
}

while(!feof($file)){
    $expmonths[] = fgetcsv($file);
}

$file = fopen("exp_year.csv", "r");

if($debug){
    if($file){
        print '';
    }else{
        print '<p<File Open Failed.</p>';
    }
}


while(!feof($file)){
    $expyears[] = fgetcsv($file);
}

?>
<main>
    <h1>Adopt</h1>
    
    <p>Support efforts to protect sea otters and their habitats by making an adoption. Your Adopt a Sea Otter Kit includes a Plush Sea Otter, a Sea Otter Adoption Certificate, and an information pamphlet on how to help endangered sea animals and the environment.</p>
    <hr>
    <h2>Contact Information</h2>
    <form method="post" action="adopt.php">

        <label for="name">Full Name</label>
        <input type="text" name="name" id="name">

        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone">
        
        <hr>
        
        <fieldset class="radio ">
            <h2>Monthly Donation</h2>
            <p>    
            <label class="radio-field"><input type="radio" name="donation" value="$6" checked="checked">
            $6.00</label>
            </p>
            <p>
            <label class="radio-field"><input type="radio" name="donation" value="$12" >
            $12.00</label>
            </p>
            <p>
            <label class="radio-field"><input type="radio" name="donation" value="$22" >
            $22.00</label>
            </p>
        </fieldset>
     
        <h3>Is this a gift?</h3>
        <label>
            <input type="radio" name="gift" value="No" checked="checked">No
        </label>
        <label>
            <input type="radio" name="gift" value="Yes">Yes
        </label>
        <input type="submit" name="giftSubmit" value="Answer">
            

        
         <?php
     
         
        if(isset($_POST['giftSubmit'])) { 
            if (isset($_POST['gift'])) {
                $answer = $_POST['gift'];
                    if($answer == "Yes") { ?>
               
                        <input type="radio" name="gift" value="No" style="display:none;">
                        <label for="recname">Recipient's Name</label>
                        <input type="text" name="recname" id="recname">

                        <label for="recemail">Recipient's Email</label>
                        <input type="text" name="recemail" id="recemail">
        
            
        <?php } } }
        else { ?>
            <input type="text" name="recname" id="recname" style="display:none;">
            <input type="text" name="recemail" id="recemail" style="display:none;">
        <?php }
         ?>
                
        <hr>
        <h2>Billing Address</h2>
        <label for="city"><b>Country</b></label>
        <select name="country">
            <?php
            foreach($countries as $country){
                print '<option value = "' . $country[0] . '">' . $country[0] .'</option>' ;
            }
            ?>
        </select>
        
        <label for="address">Address 1</label>
        <input type="text" name="address">
       
        <label class="required" for="address">Address 2</label>
        <input type="text" name="address">
        
        <label for="city">City</label>
        <input type="text" name="city" id="city">
        
        <label for="region">State/Province/Region</label>
        <input type="text" name="region" id="region">
        
        <label for="zip">Zip Code</label>
        <input type="text" name="zip" id="zip">
        
        <label>
            <input type="checkbox" checked="checked" name="sameadr"> Shipping and billing address are the same
        </label>
       
       
        <hr>
        <h2>Payment</h2>
        <label class="required" for="cardnum">Card Number</label>
        <input type="text" name="cardnum" id="cardnum">
        
        <label class="required" for="exp">Expiration</label>
        <select name="exp">
            <?php
            foreach($expmonths as $expmonth){
                print '<option value = "' . $expmonth[0] . '">' . $expmonth[0] .'</option>' ;
            }
            ?>
        </select>
        <select name="exp">
            <?php
            foreach($expyears as $expyear){
                print '<option value = "' . $expyear[0] . '">' . $expyear[0] .'</option>' ;
            }
            ?>
        </select>
     
               
         
        <hr>
        
        <input type="submit" name="send" value="Adopt">
        <?php if (isset($mailed)) { ?>
        <h2>Congratulations</h2>
        <p>A confirmation email has been sent to you.</p> 
        
        <?php } ?>
        
        

    </form>
</main>
<?php
include ('footer.php');
?>

</body>
</html>