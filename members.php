<?php

/*

Template Name: Sign up template

*/

?>
<?php get_header(); ?>

<div id="join-us">
  <img src="images/planting.jpg" alt="">

  <div id="support">

    <h1 class="text-light">Support us</h1><br>

    <p class="text-light">
    There are a number of ways you can support ECO. One of the most important of which is by getting behind the issues we are working on. Efforts by individuals raising their concerns with MPs, through letters to newspaper editors, by ringing talkback radio, writing submissions are vitally important to improving the way the environment is treated. Even making other people aware of issues is important. Take a look at the ECO News page to see some of the issues we are working on.
    <br><br>
    By becoming a ‘Friend of ECO’ you will:
    Help ensure that there is a strong New Zealand advocate for the environment;
    Receive up-to-date information so you can participate in protecting the environment, including ECO’s quarterly newsletter ECOlink;
    Receive invitations to conferences and seminars;
    Enable ECO to develop and realise its long-term environmental goals.
    <br><br><br>
    <div class="option-cards text-light">
      <?php
      echo do_shortcode('[products ids="all"]');
       ?>
    </div>

  </div>

</div>




</body>

<?php get_footer(); ?>
