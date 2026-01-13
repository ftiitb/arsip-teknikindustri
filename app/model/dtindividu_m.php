<?php
class Individu extends msDB {
    var $grid;

    function  __construct() {
        $this->connect();
        $this->grid = new Grid;
        $this->grid->setTable('tu_individu');
        $this->grid->addField(
                array(
                    'field' => 'id',
                    'name'  => 'id',
                    'primary'=> true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false, 'menuDisabled' => true)
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'nama',
                    'name'  => 'nama',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Nama','width' => 200,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'email',
                    'name'  => 'email',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Email','width' => 200,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'status',
                    'name'  => 'status',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Status','width' => 70,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));				
    }

    function create($request){
        $data = array(
          'nama' => $request['nama'],
		  'email' => $request['email'],
		  'status' => $request['status']
        );                
        return $this->grid->doCreate(json_encode($data));
    }

    function edit($id,$request){
       $this->grid->loadSingle = true;
       $this->grid->setManualFilter(" and id = $id"); 
       return $this->grid->doRead($request); 
    }
    
    function read($request){
        return $this->grid->doRead($request);
    }
    
	function update($request){
        $data = array(
          'id' => $request['id'],
          'nama' => $request['nama'],
		  'email' => $request['email'],
		  'status' => $request['status']
        );                
        return $this->grid->doUpdate(json_encode($data));
    }
    
    function doReport($request){
      return $this->grid->dosql($request); 
    }

    function destroy($request){
        return $this->grid->doDestroy($request);
    }
}
?>