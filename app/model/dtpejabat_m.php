<?php
class Pejabat extends msDB {
    var $grid;

    function  __construct() {
        $this->connect();
        $this->grid = new Grid;
        $this->grid->setTable('tu_pejabat');
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
                    'field' => 'jabatan',
                    'name'  => 'jabatan',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Nama Jabatan','width' => 200,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'namapejabat',
                    'name'  => 'namapejabat',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Nama Pejabat','width' => 200,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'nippejabat',
                    'name'  => 'nippejabat',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'NIP','width' => 80,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));				
    }

    function create($request){
        $data = array(
          'jabatan' => $request['jabatan'],
		  'namapejabat' => $request['namapejabat'],
		  'nippejabat' => $request['nippejabat']
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
          'jabatan' => $request['jabatan'],
		  'namapejabat' => $request['namapejabat'],
		  'nippejabat' => $request['nippejabat']
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