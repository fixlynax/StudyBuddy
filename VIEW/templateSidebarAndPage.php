<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Homepage StudyBuddy</title>
  <link rel="stylesheet" href="CSS/sidebar.css">
  <link rel="stylesheet" href="CSS/">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
  <input type="checkbox" id="check">
  <label class="button bars" for="check"><i class="fas fa-bars"></i></label>
  <section class="container">
    <aside class="side_bar">
      <div class="title">
        <div class="logo">StudyBuddy</div>
        <label class=" button cancel" for="check"><i class="fas fa-times"></i></label>
      </div>
      <ul>
        <?php
        include './CONTROLLER/sidebarNav.php';
        ?>
      </ul>
      <div class="media_icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
      </div>
    </aside>
    <article class="content">
      <div class="padding-container">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dictum magna ac purus ultrices ultricies.
          Morbi convallis metus nec lectus auctor, ac scelerisque metus accumsan. Donec eget velit et nisl
          viverra hendrerit. Etiam nec pulvinar eros. Suspendisse id ligula eu velit vehicula lacinia. Quisque
          vel tellus eget risus tincidunt tincidunt. Nunc eget neque ut nunc posuere viverra non id felis. Fusce
          faucibus, quam sit amet gravida tincidunt, magna tortor pharetra felis, id fermentum velit libero sed
          dolor. Phasellus eget dui sed odio pharetra suscipit. Nullam ut urna urna. Fusce vel nisi id velit
          condimentum tristique vel sit amet lacus.</p>
      </div>
    </article>
  </section>
  <script src="JS/sidebar.js"></script>
</body>

</html>