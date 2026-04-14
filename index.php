<?php
  /*
  * Name: Cyberpack - Tools - Standalone
  * Description: Tools shortcode for various tools created by Cyberpack.pl team
  * Version: 1.0
  * Author: Cyberpack - Kornel
  * Author: https://cyberpack.pl/
  */
  $tool = str_replace( ['..', '../', '.', './'], '', $_GET['tool'] );

  $files = [];
  foreach (array_splice(scandir('./src/'), 2) as $cat) {
    $files[$cat] = array_splice(scandir("./src/{$cat}"), 2);
  }

  if ($tool && file_exists(__DIR__."/src/{$tool}/index.html")) {
    $style = "/src/{$tool}/style.css";
    $html = file_get_contents(__DIR__."/src/{$tool}/index.html");
    $script = "/src/{$tool}/scripts.js";
  }
?>
<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <title>STANDALONE TOOLS</title>
    <style>*{box-sizing: border-box;}</style>
    <link id="cbp_tool-style" rel="stylesheet" href="/assets/style.css">
    <?php if (isset($style)) {echo sprintf('<link rel="stylesheet" href="%s">', $style); } ?>
  </head>
  <body>
    <div style="width: 100%; display: flex; align-items: flex-start; flex-wrap: wrap; justify-content: flex-start;gap: 0.5rem; margin-bottom: 1rem;">
      <?php foreach ($files as $cat => $file) {
        foreach ($file as $single) {
          echo sprintf('<a href="/?tool=%1$s/%2$s">%1$s/%2$s</a>', $cat, $single);
        }
      } ?>
    </div>
    <article>
      <?php if (isset($html)) {
        echo $html;
      } else {
        echo "No tool picked / Tool not found";
      } ?>
    </article>
    <footer>
      <script id="cbp_tool-scripts" src="/assets/scripts.js" defer></script>
      <?php if (isset($script)) { echo sprintf('<script src="%s" defer></script>', $script); } ?>
    </footer>
  </body>
</html>
