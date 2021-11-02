<?php wp_footer(); ?>

  <div class="footer container-fluid pt-4">
      <div class="row">
        <div class="year col-8 col-md ml-4">
          <small class="text-light">© 2021</small>
        </div>
        <div class="col-8 pl-4">

            <a id="btn" class="link-light text-decoration-none mx-5" href="<?php echo get_page_link(get_page_by_path('about-eco')); ?>">About us</a>
            <a id="btn" class="link-light text-decoration-none mx-5" href="<?php echo get_page_link(get_page_by_path('join-us')); ?>">Join us</a>
            <a id="btn" class="link-light text-decoration-none mx-5" href="<?php echo home_url(); ?>">News</a>
            <a id="btn" class="link-light text-decoration-none mx-5" href="<?php echo home_url(); ?>">Key items</a>

        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
