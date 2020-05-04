<div class="container">
  <div class="alert-danger p3 my-3">
    <?= \Config\Services::validation()->listErrors(); ?>
  </div>

  <form action="<?= '/noticias/gravar' ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="title">Titulo</label>
      <input type="text" class="form-control" name="title" 
      value="<?= isset($noticias['title']) ? $noticias['title'] : set_value('title') ?>" />
    </div>
    <div class="form-group">
      <label for="autor">Autor</label>
      <input type="text" class="form-control" name="autor" 
      value="<?= isset($noticias['autor']) ? $noticias['autor'] : set_value('autor') ?>" />
    </div>
    <div class="form-group">
      <label for="description">Descrição</label>
      <textarea name="description" class="form-control">
        <?= isset($noticias['description']) ? $noticias['description'] : set_value('description') ?>
      </textarea>
    </div>
    <div class="form-group">
      <label for="img">Imagem</label> <br/>
      <input type="file" name="img" >
    </div>
    <input type="hidden" name="id" 
    value="<?= isset($noticias['id']) ? $noticias['id'] : set_value('id') ?>" />
    
    <input type="submit" name="submit" value="Salvar" class="btn btn-primary">
  </form>
</div>