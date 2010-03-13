<?php include('config/init.php'); ?>
<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>
	    <h1>Contact Us</h1> 
		<p>Our contact details are below, or feel free to use the contact form below to send us an e-mail right now.</p>
<div class="left bordered padded half-width">
    <p>

Wolverine Project Management Team
</p><p>
Locationg of the team,
Somewhere,
In the Unviersity
</p><p>
Telephone: XXXXX XXXXXX<br />
Fax: XXXXX XXXXXX
Email: d.dawes@wlv.ac.uk
</p>
</div>
<div class="right bordered padded half-width">
<?php
if (!is_null($_POST['txtName'])){
echo Contact::SendMail($_POST['txtName'], $_POST['txtStudent'], $_POST['txtMessage']);
}else{
?>

<h3>Contact form:</h3>

 <form action="contact-us.php" METHOD="POST" name="contact">
          
          <p><label for="txtName">Name:</label></p>
          <input name="txtName" type="text" id="txtName" />
          <p><label for="txtStudent">Student Number:</label></p>
          <input name="txtStudent" type="text" id="txtStudent" />
          <p><label for="txtMessage">Message:</label></p>
          <textarea name="txtMessage" rows="12" id="txtMessage"></textarea>
          
          <input type="submit" value="Send" />
         
          </form>

<?php
}
echo '</div>';

  //Assign all Page Specific variables
  $page_content = ob_get_contents();
  $page_title = "Contact Administration";
  ob_end_clean();
  //Apply the template
  include("master.php");
?>
	  




