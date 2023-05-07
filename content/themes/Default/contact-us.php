<div class="container pt50 pb50">

<div class="row">

    <div class="col-md-12 text-center title">
        <h2><?php te( 'theme_contact_title', 'Contact Us' ); ?></h2>
    </div>

</div>

<div class="row pt50">

    <div class="col-md-8 offset-md-2">
         <form action="send_email.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>
        <label for="message">Message:</label>
        <textarea name="message" id="message" required></textarea><br>
        <button class="btn-info" type="submit" value="Submit">Submit</button>
    </form>
    </div>

</div>

</div>


