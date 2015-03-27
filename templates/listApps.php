<section id="apps">
  <!-- <input type="search" id="app-search" placeholder="Search for app"> -->
  <ul>
  <?php foreach ($myApps->getApps() as $app): ?>
    <li<?=(isset($app['selected']) ? ' class="selected"' : '')?>>
      <a href="?app=<?=$app['folder']?>"><?=$app['name']?></a>
    </li>
  <?php endforeach; ?>
  </ul>
</section>