<?php

namespace App\Models;

class Listing {
  public static function all() {
    return [
      [
          'id' => 1,
          'title' => 'Listing 1',
          'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla euismod, nisl eget ultricies aliquam, quam libero ultricies nunc, quis aliquet nisl nunc quis nisl. Sed euismod, nisl eget ultricies aliquam, quam libero ultricies nunc, quis aliquet nisl nunc quis nisl.',
      ],
      [
          'id' => 2,
          'title' => 'Listing 2',
          'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla euismod, nisl eget ultricies aliquam, quam libero ultricies nunc, quis aliquet nisl nunc quis nisl. Sed euismod, nisl eget ultricies aliquam, quam libero ultricies nunc, quis aliquet nisl nunc quis nisl.',
      ]
    ]; 
  }

  public static function find($id) {
    $listings = self::all();
    foreach ($listings as $listing) {
      if ($listing['id'] == $id) { // == for loose comparison
        return $listing;
      }
    }
  }
}

?>