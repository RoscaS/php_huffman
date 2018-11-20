<section class="section">
  <p>
    La chaîne fait <?= $this->total; ?> symbole(s) dont
    <?= count($this->span) ?> unique(s).
  </p>
  <p>Entropie: <?= $this->entropy; ?></p>

  <h3>Répartition des symboles:</h3>

  <ul>
    <?php $this->dump($this->span); ?>
  </ul>


  <h3>Table de codage Huffman:</h3>
  <ul>
    <?php $this->dump($this->hoffman); ?>
  </ul>


  <h3>Texte compressé:</h3>
  <pre>
    <?= $this->compressed; ?>
  </pre>
</section>
