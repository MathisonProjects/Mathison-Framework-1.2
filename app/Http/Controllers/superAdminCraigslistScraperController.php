<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class superAdminCraigslistScraperController extends Controller {
    const SOCKET_TIMEOUT = 10;
    const USER_AGENT = "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 GTB5 (.NET CLR 3.5.30729)";

    public function index() {
        $keys = array('View', 'Edit', 'Delete', 'Id', 'City Code', 'Section');
        $items = array();
        foreach ($this->menu[$this->currentModule] as $key => $item) {
            array_push($items, array(
                    '<a href="/admin/super/'.$this->currentModule.'/'.$item->id.'">'.$this->vedIcon['View'].'</a>',
                    '<a href="/admin/super/'.$this->currentModule.'/'.$item->id.'/edit">'.$this->vedIcon['Edit'].'</a>',
                    '<a href="/admin/super/'.$this->currentModule.'/'.$item->id.'/destroy">'.$this->vedIcon['Delete'].'</a>',
                    $item->id,
                    $item->citycode,
                    $item->section
                ));
        }

        $table = $this->tableBuilder($keys,$items);
        return $this->launchView('views', array('table' => $table));
    }

    public function create() {
        return $this->launchView('create');
    }

    public function store(Request $request) {
        parent::save('create',$request);
    }

    public function show($id) {
        return $this->launchView('view');
    }

    public function edit($id) {
        $data = $this->module[$this->currentModule]->where('id', $id)->first();
        return $this->launchView('edit', array('data' => $data));
    }

    public function update($id, request $request) {
        parent::save('update',$request, array('id' => $id));
    }

    public function destroy($id) {
        $this->deleteItem($this->module[$this->currentModule], $id);
        return $this->launchView('views');
    }

    public function showList() {
        $keys = array('View', 'Post Date', 'City', 'Section', 'Name');
        $items = array();
        $filtersDB = $this->module['craigslistFilter']->get();
        
        foreach ($this->menu[$this->currentModule] as $key => $item) {
            $data = $this->getSearchResults($item->citycode, $item->section);
            foreach ($data as $key2 => $values) {
                $continue = true;
                foreach ($filtersDB as $key => $value) {
                    if (strpos(strtolower($values['title']), strtolower($value->phrase)) !== false) {
                        $continue = false;
                    }
                }

                if ($continue == false) {
                    continue;
                }

                array_push($items, array(
                        '<a href="http://'.$values['url'].'" target="_blank">'.$this->vedIcon['View'].'</a>',
                        $values['submission'],
                        $item->citycode,
                        $item->section,
                        $values['title']));

            }
        }

        $table = $this->tableBuilder($keys,$items);
        return $this->launchView('showList', array('table' => $table));
    }

    
    public function getSearchResults($city, $category) {
        $craigslist = new \Divinityfound\CraigslistApi\Reader;

        return $craigslist->getSearchResults($city,$category);
    }

}