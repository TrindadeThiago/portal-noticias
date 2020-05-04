<?php

namespace App\Database\Seeds;

class Noticias extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $data = [
      'title' => 'Noticia 1',
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus et leo vel dui laoreet efficitur eu ultrices mi. Quisque porta egestas nisi vel congue. Aenean ullamcorper augue sed venenatis rhoncus. Phasellus molestie ultrices diam, et bibendum lacus posuere quis. In suscipit enim at aliquam ullamcorper. Vivamus imperdiet urna odio, a dignissim elit sagittis a. Donec orci dolor, fringilla non mi in, euismod laoreet odio.',
      'autor' => 'Thiago Trindade'
    ];

    $this->db->table('noticias')->insert($data);
  }
}
