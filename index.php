<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow"/>
  <title>Buscador Inteligente</title>

  <link href='css/style.css' rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
</head>
<body>

  <header>
    <div class="container search-container">
      <form action="" method="GET" id="searchForm">
          <input type="text" id="txtsearch" placeholder="Digite para buscar..." name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"/>
          <button type="submit" id="btnsearch" title="Buscar">
            <i class="fas fa-search"></i>
          </button>
      </form>
    </div>
  </header>

  <main class="container">
    <div class="content-card">
      <h1>PyPHP: Hybrid Search Engine Boilerplate</h1>

      <section id="content-area">
        <?php
          $dataFile = 'data.txt';
          $pythonScript = 'search_engine.py';

          if (file_exists($dataFile) && file_exists($pythonScript)) {
              $search = isset($_GET['search']) ? $_GET['search'] : '';

              $arg = escapeshellarg($search);

              $command = "python $pythonScript $arg 2>&1";
              $output = shell_exec($command);

              if ($output) {
                  echo $output;
              } else {
                  echo "<div class='error-msg'>Nenhum retorno do script.</div>";
              }
          } else {
              echo "<div class='error-msg'>Erro: Arquivos de sistema (data.txt ou search_engine.py) ausentes.</div>";
          }
        ?>
      </section>
    </div>
  </main>

  <div class='back-top' title="Voltar ao topo">
    <i class="fas fa-arrow-up"></i>
  </div>

  <script>
    $(function(){
      $('.back-top').click(function(){
       $('html, body').animate({ scrollTop: 0 }, 500);
      });

      var highlights = $('.highlight');
      if (highlights.length > 0) {
          setTimeout(function() {
              var top = $(highlights[0]).offset().top - 120;
              $('html, body').animate({ scrollTop: top }, 600);
          }, 100);
      }
    });
  </script>
</body>
</html>
