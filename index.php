<?php
  $files = [];
  foreach (array_splice(scandir('./src/'), 2) as $cat) {
    $files[$cat] = array_splice(scandir("./src/{$cat}"), 2);
  }

  if (isset($_GET['tool']) && file_exists(__DIR__."/src/{$_GET['tool']}/index.html")) {
    $style = "/src/{$_GET['tool']}/style.css";
    $html = file_get_contents(__DIR__."/src/{$_GET['tool']}/index.html");
    $script = "/src/{$_GET['tool']}/scripts.js";
  }
?>
<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <title>STANDALONE TOOLS</title>
    <style>*{box-sizing: border-box;}</style>
    <link id="cbp_tool-style" rel="stylesheet" href="/assets/style.css">
    <?php if (isset($style)) { echo "<link rel=\"stylesheet\" href=\"{$style}\">"; } ?>
  </head>
  <body>
    <div style="width: 100%; display: flex; align-items: flex-start; flex-wrap: wrap; justify-content: flex-start;gap: 0.5rem; margin-bottom: 1rem;">
      <?php foreach ($files as $cat => $file) {
        foreach ($file as $single) {
          echo "<a href=\"/?tool={$cat}/{$single}\">{$cat}/{$single}</a>";
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
      <?php if (isset($script)) { echo "<script src=\"{$script}\" defer></script>"; } ?>
    </footer>
  </body>
</html>
