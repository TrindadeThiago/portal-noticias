<div class="container">
  <?php if($session->get('logged_in')) : ?>
    <a href="<?= '/noticias/inserir' ?>" class="btn btn-primary">Adicionar notícias</a>
  <?php endif ?>

  <?php if(!empty($noticias) && is_array($noticias)) : ?>
    <?php foreach($noticias as $noticias_item) : ?>
      <div class="card my-5">
        <div class="card-body">
          <h3><?= $noticias_item['title']?></h3>
          <p><?= $noticias_item['description']?></p>
        </div>
        <div class="card-footer">
          <a href="<?= '/noticias/'.$noticias_item['id'] ?>" class="btn btn-success">Saiba mais</a>
          <?php if($session->get('logged_in')) : ?>
            <a href="<?= '/noticias/editar/'.$noticias_item['id'] ?>" class="btn btn-warning">Editar</a>
            <a href="<?= '/noticias/excluir/'.$noticias_item['id'] ?>" class="btn btn-danger">Excluir</a>
          <?php endif ?>
        </div>
      </div>
    <?php endforeach; ?>
    
  <?php else: ?>
      <h3>Sem Notícias</h3>
      <p>Não existe nem uma notícias cadastrada</p>
  <?php endif ?>
</div>