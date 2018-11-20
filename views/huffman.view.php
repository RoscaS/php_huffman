<form method="post" action="#">
  <div class="field">
    <label class="label" for="text">Texte à compresser</label>
    <textarea id="text" class="textarea" name="text"><?= htmlentities($this->text, ENT_HTML5, "UTF-8"); ?></textarea>
  </div>
  <button class="button is-link" type="submit">Envoyer</button>
</form>


<?php
if (isset($this->occurences)) {
  require 'partials/huffman_computed.php';
}
?>
