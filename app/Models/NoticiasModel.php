<?php
  namespace App\Models;
  use CodeIgniter\Model;

  class NoticiasModel extends Model {

    protected $table = 'Noticias';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description', 'autor', 'img'];

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function getNoticias($id=false) {
      if ($id === false) {
        return $this->findAll();
      } else {

        return $this->asArray()
                    ->where(['id' => $id])
                    ->first();
      }
    }
  }