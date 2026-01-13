<?php
class Instruksi extends msDB {
    var $grid;

    function  __construct() {
        $this->connect();
        $this->grid = new Grid;
        $this->grid->setTable('tu_instruksi');
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
                    'field' => 'instruksi',
                    'name'  => 'instruksi',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'instruksi','width' => 300,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));
				
    }

    function create($request){
        $data = array(
		  'instruksi' => $request['instruksi']
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
          'instruksi' => $request['instruksi']
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