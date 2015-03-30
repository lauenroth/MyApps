<h1>Create new app</h1>
<form method="post" id="new-app">
  <label for="name">Please choose a name for your app:</label>
  <input type="text" id="name" name="name" placeholder="Name of your app" required>

  <label for="description">Wanna give it a short description?</label>
  <textarea name="description" id="description" placeholder="Short description"></textarea>

  <h3>Which framework do you wanna use?</h3>

  <section class="framework">
    <label>
      <input type="radio" name="framework" value="meteor">
      <img src="/images/frameworks/meteor.png" alt="Meteor" title="Meteor">
    </label>
    <label>
      <input type="radio" name="framework" value="laravel">
      <img src="/images/frameworks/laravel.png" alt="Laravel" title="Laravel">
    </label>
    <label>
      <input type="radio" name="framework" value="symfony">
      <img src="/images/frameworks/symfony.png" alt="Symfony" title="Symfony">
    </label>
    <label>
      <input type="radio" name="framework" value="mean">
      <img src="/images/frameworks/mean.png" alt="MEAN" title="MEAN">
    </label>
  </section>

  <h3>What else do you need?</h3>
  <ul class="misc">
    <li>
      <input type="checkbox" id="check-git" name="git">
      <label class="check" for="check-git"></label>
      <label for="check-git">Git</label>
    </li>
    <li>
      <input type="checkbox" id="check-gulp" name="gulp">
      <label class="check" for="check-gulp"></label>
      <label for="check-gulp">Gulp</label>
    </li>
    <li>
      <input type="checkbox" id="check-grunt" name="grunt">
      <label class="check" for="check-grunt"></label>
      <label for="check-grunt">Grunt</label>
    </li>
  </ul>
  
  <button type="submit">Create app</button>
</form>