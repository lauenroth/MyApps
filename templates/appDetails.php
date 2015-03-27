<h1><?=$app['name']?></h1>

<ul class="tabs">
  <li>
    <input type="radio" name="tabs" id="tab-general" checked>
    <label for="tab-general">General</label>
    <section id="tab-content-general">
      <ul>
      <?php foreach ($app['platforms'] as $platform): ?>
        <li><?=$platform?></li>
      <?php endforeach; ?>
      </ul>
    </section>
  </li>

<?php if (isset($app['packages'])): ?>
  <li>
    <input type="radio" name="tabs" id="tab-packages">
    <label for="tab-packages">Packages</label>
    <section id="tab-content-packages">
      <ul class="small">
      <?php foreach ($app['packages'] as $package): ?>
        <li><?=$package?></li>
      <?php endforeach; ?>
      </ul>
    </section>
  </li>
<?php endif; ?>

  <li>
    <input type="radio" name="tabs" id="tab-schema">
    <label for="tab-schema">Schema</label>
    <section id="tab-content-schema">
      <p>Todo</p>
    </section>
  </li>
</ul>