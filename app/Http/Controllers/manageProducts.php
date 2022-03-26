<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use Response;
use File;

class manageProducts extends Controller
{
    //

    public function addProductByUser(Request $request_body)
  {
    $request = json_decode($request_body->input('request_data'));

    if (!$request_body->hasFile('file')) {
      return Response::json(array('code' => 201, 'message' => 'Required field file is missing or empty', 'cause' => '', 'data' => json_decode("{}")));
    } else {
      $logo_file = $request_body->file('file');
      $fileData = pathinfo(basename($logo_file->getClientOriginalName()));
      $new_file_name = uniqid() . '_' . time() . '.' . strtolower($fileData['extension']);
      $logo_file->move('../public/products', $new_file_name);
    }

    DB::beginTransaction();
    DB::insert(
      'INSERT INTO products(product_name)
                    VALUES(?)',
      [$new_file_name]
    );
    DB::commit();

    $response = Response::json(array('code' => 200, 'message' => 'Product has been added.'));
    return $response;
  }

  public function getProducts()
  {
    $imagepath = 'http://192.168.29.110/layer-maker/public/products/';
    $result = DB::select('SELECT 
        id,
        product_name,
        concat("' . $imagepath . '","",product_name) AS image
        FROM products
        ');
    $response = Response::json(array('code' => 200, 'message' => 'Products fatched successfully', 'data' => $result));
    return $response;
  }
}
