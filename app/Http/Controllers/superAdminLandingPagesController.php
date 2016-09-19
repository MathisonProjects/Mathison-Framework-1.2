<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use J20\Uuid\Uuid as Uuid;

class superAdminLandingPagesController extends Controller
{
    public function index()
    {
        $keys = array('View', 'Edit', 'Delete', 'Id', 'Landing Page Name', 'Campaign');
        $items = array();
        foreach ($this->menu[$this->currentModule] as $key => $item) {
            array_push($items, array('<a href="/admin/super/landingPages/'.$item->id.'">'.$this->vedIcon['View'].'</a>',
                                    '<a href="/admin/super/landingPages/'.$item->id.'/edit">'.$this->vedIcon['Edit'].'</a>',
                                    '<a href="/admin/super/landingPages/'.$item->id.'/delete">'.$this->vedIcon['Delete'].'</a>',
                                    $item->id,
                                    $item->campaign()->name));
        }
        $table = $this->tableBuilder($keys,$items);
        return $this->launchView('views',array('table' => $table));
    }

    public function create()
    {
        $campaigns = array('' => '');
        $guid = Uuid::v4();
        foreach($this->module['lPCampaigns']->get() as $key => $value) {
            $campaigns[$value->id] = $value->name;
        }
        return $this->launchView('create', compact('campaigns','guid'));
    }

    public function store(Request $request)
    {
        parent::save('create',$request);
    }

    public function show($id)
    {
        $data = array('data' => $this->module[$this->currentModule]->where('id', $id)->first());
        return $this->launchView('view',$data);
    }

    public function edit($id)
    {
        $data = $this->module[$this->currentModule]->where('id', $id)->first();
        return $this->launchView('edit', array('data' => $data));
    }

    public function update($id, request $request) {
        parent::save('update',$request, array('id' => $id));
    }

    public function destroy($id)
    {
        $this->deleteItem($this->module[$this->currentModule], $id);
        return $this->launchView('views');
    }
}
