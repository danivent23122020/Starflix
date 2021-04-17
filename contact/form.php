<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS/Boostrap/Font Awesome-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="form.css">
        
        <title>Contact</title>
    </head>

    <body>
        
    <!-- Formulaire de contact -->
    <header class="header">
        <img src="logo.png" alt="Logo" id="logo">
        <h1 id="title">Contact</h1>
    </header>
    <br>
    <form action="contact.php" id="contact-form" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <br>
            <input type="text" id="name" class="form-control" name="visitor_name" placeholder="Enter your name" pattern=[A-Z\sa-z]{3,20} required>
        </div>
        <br>
        <div class="form-group">
            <label for="email">E-mail</label>
            <br>
            <input type="email" id="email" class="form-control" name="visitor_email" placeholder="Enter your email" required>
        </div>
        <br>
        <div class="form-group">
            <label for="title">Request subject</label>
            <br>
            <input type="text" id="title" class="form-control" name="email_title" placeholder="Reason(s)" required>
        </div>
        <br>
        <div class="elem-group">
            <label for="message">Message</label>
            <textarea id="message" class="form-control" name="visitor_message" placeholder="Enter your message here..." style="heigth: 100px" required></textarea>
        </div>
        <br>
        <button type="submit" id="submit" class="btn btn-danger">Send Message</button>
    </form>
                            
    </body>
</html>