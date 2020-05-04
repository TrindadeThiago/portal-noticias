<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NoticiasModel;

class Noticias extends Controller
{

  public function index()
  {
    $model = new NoticiasModel();

    $data = [
      'title' => 'Últimas Notícias',
      'noticias' => $model->getNoticias(),
      'session' => \Config\Services::session()
    ];

    echo view('templates/header', $data);
    echo view('pages/noticias', $data);
    echo view('templates/footer');
  }

  public function item($id = NULL)
  {
    $data['session'] = \Config\Services::session();

    $model = new NoticiasModel();

    $data['noticias'] = $model->getNoticias($id);

    if (empty($data['noticias'])) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Não é possivel encontrar essá notícia');
    }

    $data['title'] = $data['noticias']['title'];

    echo view('templates/header', $data);
    echo view('pages/noticia', $data);
    echo view('templates/footer');
  }

  public function inserir()
  {
    $data['session'] = \Config\Services::session();

    if (!$data['session']->get('logged_in')) {
      return redirect('login');
    }

    helper('form');
    $data['title'] = 'Inserir notícias';

    echo view('templates/header', $data);
    echo view('pages/noticia_gravar');
    echo view('templates/footer');
  }

  public function editar($id = NULL)
  {
    $model = new NoticiasModel();

    $data = [
      'title' => 'Editar Notícia',
      'noticias' => $model->getNoticias($id),
      'session' => \Config\Services::session()
    ];

    if (!$data['session']->get('logged_in')) {
      return redirect('login');
    }

    if (empty($data['noticias'])) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Não é possivel encontrar essá notícia');
    }

    echo view('templates/header', $data);
    echo view('pages/noticia_gravar', $data);
    echo view('templates/footer');
  }

  public function gravar()
  {
    $data['session'] = \Config\Services::session();

    if (!$data['session']->get('logged_in')) {
      return redirect('login');
    }

    helper('form');
    $model = new NoticiasModel();

    if ($this->validate([
      'title' => ['label' => 'title', 'rules' => 'required|min_length[3]|max_length[100]'],
      'autor' => ['label' => 'autor', 'rules' => 'required|min_length[3]|max_length[100]'],
      'description' => ['label' => 'description', 'rules' => 'required|min_length[3]']
    ])) {
      $id = $this->request->getVar('id');
      $title = $this->request->getVar('title');
      $description = $this->request->getVar('description');
      $autor = $this->request->getVar('autor');
      $img = $this->request->getFile('img');

      if (!$img->isValid()) {
        $model->save([
          'id' => $id,
          'title' => $title,
          'autor' => $autor,
          'description' => $description
        ]);

        return redirect('noticias');
      } else {
        $validaImg = $this->validate([
          'img' => [
            'uploaded[img]',
            'mime_in[img,image/jpg,image/jpeg,image/gif,image/png]',
            'max_size[img,4096]',
          ],
        ]);

        if ($validaImg) {
          $filename = $img->getRandomName();
          $img->move('img/noticias', $filename);

          $model->save([
            'id' => $id,
            'title' => $title,
            'autor' => $autor,
            'description' => $description,
            'img' => $filename
          ]);

          return redirect('noticias');
        } else {
          $data['title'] = 'Erro ao gravar a notícia';
          echo view('templates/header', $data);
          echo view('pages/noticia_gravar');
          echo view('templates/footer');
        }
      }
    } else {
      $data['title'] = 'Erro ao gravar a notícia';
      echo view('templates/header', $data);
      echo view('pages/noticia_gravar');
      echo view('templates/footer');
    }
  }

  public function excluir($id = NULL)
  {
    $data['session'] = \Config\Services::session();

    if (!$data['session']->get('logged_in')) {
      return redirect('login');
    }

    $model = new NoticiasModel();
    $model->delete($id);
    return redirect('noticias');
  }
}
