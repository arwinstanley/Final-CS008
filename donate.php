<?php
include ('top.php');

$debug = TRUE;
if(isset($_GET["debug"])){
     $debug = true; 
}

$file=fopen("country.csv", "r");

if($debug){
    if($file){
       print '<p>File Opened Succesful.</p>';
    }else{
       print '<p>File Open Failed.</p>';
     }
} 

     while(!feof($file)){
         $countries[] = fgetcsv($file);
     }
    
?>
<main>
    <h2>Donate<h2>
            <form action="action_page.php">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
    <hr>
    
    <label for="phone-num"><b>Phone Number</b></label>
    <input type="text" placeholder="0-000-000-0000" name="phone" required>
    <hr>
    
    <label for="phone-num"><b>Would you like us to share your information(i.e. email lists and newsletters)</b></label>
    <label for="phone-num">Yes</label>
    <input type="checkbox" name="Yes" value="ON" checked="checked" />
    <label for="phone-num">No</label>
    <input type="checkbox" name="No" value="OFF" checked="unchecked" />
    <hr>
    
    <label for="addy"><b>Address line 1</b></label>
    <input type="text" placeholder=" " name="address" required>
    <label for="addyTwo"><b>Address line 2</b></label>
    <input type="text" placeholder=" " name="addressTwo" required>
    <label for="state"><b>State/Province/Region</b></label>
    <input type="text" placeholder=" " name="state" required>
    <label for="city"><b>City</b></label>
    <input type="text" placeholder=" " name="city" required>
    
    <label for="city"><b>Country</b></label>
    <select name="Country">
        <?php
        foreach($countries as $country){
            print '<option value = "' . $country[0] . '">' . $country[0] .'</option>' ;
        }
        ?>
    </select>
    <hr>
    
    <label for="donation"><b>Donation Amount</b></label>
    <input type="text" placeholder="0.00" name="donation" required>
    <hr>
    
    <label for="notes"><b>Notes</b></label>
    <textarea name="note" rows="4" cols="20">
    </textarea>
    <hr>
    
    <div class="row">
  <div class="col-75">
    <div class="container">
      <form action="/action_page.php">

        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">

            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>

        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
      </form>
    </div>
  </div>
</div>
    
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <button type="submit" class="registerbtn">Register</button>
  </div>

  <div class="container signin">
    <p>Already have an account? <a href="#">Sign in</a>.</p>
  </div>
</form>
</main>

<?php
include ('footer.php');
?>

</body>
</html>