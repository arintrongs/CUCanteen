<?php

namespace App\Http\Controllers\Canteen;

use App\ImageRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ImageController extends Controller
{
    protected $image;

    public function __construct() //ImageRepository $imageRepository
    {
        $this->image = new ImageRepository(); // $imageRepository;
    }

    public function postUpload()
    {
        $photo = Input::all();
        $response = $this->image->upload($photo);
        return $response;
    }

    public function deleteUpload()
    {

        $filename = Input::get('uid');

        if(!$filename)
        {
            return 0;
        }

        $response = $this->image->delete( $filename );

        return $response;
    }
}
