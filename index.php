<?php session_start();
include 'db.php';
include('header.php');


$sql = "SELECT * FROM recipes";
$result = $connect->query($sql);
?>

<?php if (isset($_SESSION['login_error'])): ?>
    <p style="font-weight: bold; color: rgb(148, 187, 116); text-align: center;"><?php echo $_SESSION['login_error']; ?></p>
    <?php unset($_SESSION['login_error']); ?>
<?php endif; ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Virtual Kitchen</title>
    <link rel="icon" href="images/favicon.ico" type="image/ico">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" />
    <script defer src="js/basic.js"></script>
</head>
<body>
    <main>
        <section id="intro">
            <img src="images/kitchen.jpg" alt="Virtual Kitchen Intro" class="intro-image" />
            <h2>From Our Kitchen to Yours – Cook, Create, Enjoy!</h2>
            <p><strong style="color: rgb(148, 187, 116);">Our Story</strong><br>
                Virtual Kitchen was founded with a passion for bringing culinary experiences into the heart of every home.<br>
                Established in 2020, our mission has been to make cooking accessible, enjoyable, and educational for everyone, regardless of skill level.
            </p>
            <p><strong style="color: rgb(148, 187, 116);">Our Journey</strong><br>
                What started as a small blog sharing simple home-cooked recipes has grown into an interactive online learning platform.
                <br>We hope you enjoy our selection of easy to cook dishes!<br>
             
            </p>
            <p><strong style="color: rgb(148, 187, 116);">Where We Are</strong><br>
                123 Culinary Lane, Foodie City, FC 45678<br>
                <strong>Founded by:</strong> Brajan Rychlowski<br>
                <strong>Email:</strong> 240202378@aston.ac.uk<br>
                <strong>Student Number:</strong> 240202378
                <a href='recipes.php'>
                  <button class='center-button'>Recipes</button>
              </a>
            </p>
            
        </section>
        

        <section id="benefits">
            <h2>Why should you use our Virtual Kitchen?</h2>
            <div class="benefit">
                <p>Learn new recipes and techniques!</p>
            </div>
            <div class="benefit">
                <p>Get personalized meal recommendations!</p>
            </div>
            <div class="benefit">
                <p>Share your culinary creations with friends!</p>
            </div>
        </section>

        <section id="testimonials">
            <h2>What our users say about us</h2><br>
            <blockquote>
                <p>
                    "The recipes are amazing, and I love how easy it is to follow them."
                </p>
                <footer>
                    Jack
                </footer>
            </blockquote>
            <blockquote>
                <p>
                    "The personalized meal plans helped me cook healthier and tastier meals."
                </p>
                <footer>
                    Holly
                </footer>
            </blockquote>
        </section>
    </main>

</body>
</html>
