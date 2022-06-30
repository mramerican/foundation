<?php $dir = get_bloginfo("template_directory") . "/"; ?>

<!--<section class="animate">
  <article class="tile">
    <figure class="tile__figure">
      <img data-src="/wp-content/uploads/2021/02/1.1.jpg" data-hover="/wp-content/uploads/2021/02/1.2.jpg" class="tile__image" alt="My image" width="400" height="300" />
    </figure>
  </article>
</section>

<canvas id="stage" class="front-canvas"></canvas>-->


<div class="testCanvas">
  <div id="app">
    <section class="container animate">
      <article class="tile">
        <figure class="tile__figure">
          <img
            src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=934&q=80"
            data-hover="https://images.unsplash.com/photo-1522609925277-66fea332c575?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=934&q=80"
            class="tile__image"
            alt="My image"
            width="400"
          />
        </figure>
      </article>
    </section>

    <canvas id="stage"></canvas>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="<?= $dir ?>js/canvas.js" type="module"></script>