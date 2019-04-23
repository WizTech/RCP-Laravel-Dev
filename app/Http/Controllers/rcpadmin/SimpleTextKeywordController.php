<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Input;


class SimpleTextKeywordController extends Controller
{

  private $token;

  public function __construct()
  {
    $this->token = '59b764e83a80bd99af1c0b5ffa5cc322';
  }
  public function index()
  {
    return view('rcpadmin.simple-text-keyword');
  }

  public function show()
  {

  }

  public function store(Request $request)
  {
    $file = $request->file('file');
    $data = $this->get_array($file);
    if (!empty($data)) {
      $this->requestedParams($data);
    }else{
      return redirect('rcpadmin/simple-keyword-text');
    }
  }


  function get_array($csvFile)


  {


    $file_handle = fopen($csvFile, 'r') or die('ssssss');


    $row = 0;


    while (($data = fgetcsv($file_handle, 0, ",")) !== FALSE) {

      if ($row == 0) {


        foreach ($data as $key => $value) {


          $title[$key] = trim($value); //this extracts the titles from the first row and builds array


        }


      } else {


        $new_row = $row - 1; //this is needed so that the returned array starts at 0 instead of 1


        foreach ($title as $key => $value) //this assumes there are as many columns as their are title columns


        {


          $result[$new_row][$value] = trim($data[$key]);


        }


      }

      $row++;


    }


    fclose($file_handle);


    return $result;


  }

  function requestedParams($data)


  {


    $csv = $data;


    $keywords = $this->listKeyword($this->token);


    foreach ($csv as $data) {


      $keyword = $data['Property ID'];


      $keyword_message = $data['Final URL'];


      if (!isset($keywords[strtolower($keyword)])) {

        $this->addKeyword($this->token, $keyword, $keyword_message);

      }


    }


  }


  function curl_init($url)


  {


    $ch = curl_init();


    // set url


    curl_setopt($ch, CURLOPT_URL, $url);


    //return the transfer as a string


    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


    curl_setopt($ch, CURLOPT_HEADER, false);


    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);


    // $output contains the output string


    $output = curl_exec($ch);


    // close curl resource to free up system resources


    curl_close($ch);


    // return json_decode(json_encode($output),true);


    return $output;


  }


  function listKeyword($token)


  {


    $authUrl = "https://app3.simpletexting.com/v1/keyword/list?token=" . $token;


    $result = $this->curl_init($authUrl);


    $xml = new \SimpleXMLElement($result);


    $keywods = [];


    foreach ($xml->keyword as $id => $data) {


      foreach ($data->name as $name) {


        $key = (string)$name;


        $keywods[$key] = (string)$name;


      }


    }


    return $keywods;


  }


  function addKeyword($token, $keyword = "", $message = "")


  {


    $authUrl = "https://app3.simpletexting.com/v1/keyword/rent?token=" . $token . '&keyword=' . $keyword;


    $result = $this->curl_init($authUrl);


    if ($result) {


      echo '<pre>';
      print_r($keyword . ' keyword added successfully.');
      echo '</pre>';


      $this->configureKeyword($this->token, strtolower($keyword), $message);


    }


  }


  function configureKeyword($token, $keyword = "", $message = "")


  {


    $authUrl = "https://app3.simpletexting.com/v1/keyword/configure?token=" . $token . '&keyword=' . $keyword . '&autoreply=' . $message;


    $result = $this->curl_init($authUrl);


    if ($result) {


      echo '<pre>';
      print_r($keyword . ' keyword configured successfully.');
      echo '</pre>';


    }


  }
}
