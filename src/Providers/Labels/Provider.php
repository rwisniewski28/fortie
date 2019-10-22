<?php namespace Rwis\Fortie\Providers\Labels;

/*

   Copyright 2015 Andreas Göransson

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.

*/

use Rwis\Fortie\Providers\ProviderBase;
use Rwis\Fortie\FortieRequest;

class Provider extends ProviderBase {

  protected $attributes = [
    'Id',
    'Description',
  ];


  protected $writeable = [
    // 'Id',
    'Description',
  ];


  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'labels';


  /**
   * Retrieves a list of all the available labels.
   *
   * @return array
   */
  public function all ($page = null)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath);

    if (!is_null($page)) {  
      $req->param('page', $page);
    }

    return $this->send($req->build());
  }


  /**
   * Create a label.
   *
   * The created label will be returned if everything succeeded, if there
   * was any problems an error will be returned.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('Label');
    $req->data($data);
    $req->setRequired($this->required_create);

    return $this->send($req->build());
  }


  /**
   * Update a label.
   *
   * Updates the specified label with the values provided in the properties.
   * Any property not provided will be left unchanged.
   *
   * @param $id
   * @param array   $data
   * @return array
   */
  public function update ($id, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id);
    $req->wrapper('Label');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }


  /**
   * Delete a label.
   *
   * Deletes the label and it’s connection to documents permanently.
   * You need to supply the unique label id that was returned when the label
   * was created or retrieved from the list of labels.
   *
   * @param $id
   * @return null
   */
  public function delete ($id)
  {
    $req = new FortieRequest();
    $req->method('DELETE');
    $req->path($this->basePath)->path($id);

    return $this->send($req->build());
  }

}
