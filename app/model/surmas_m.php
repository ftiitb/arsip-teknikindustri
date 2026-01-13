<?php
class Surmas extends msDB {
    var $grid;
	var $surmasUploadDir="app/assets/arsip/surat/masuk/";
	
    function  __construct() {
		$thisyear=date_format(date_create(), 'Y');
        $this->connect();
        $this->grid = new Grid;
        $this->grid->setTable('tu_suratmasuk');
		$this->grid->setManualFilter(" and tahun = $thisyear");
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
                    'field' => 'nomor',
                    'name'  => 'nomor',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('header' => 'Nomor','width' => 60,'sortable' => true),
					  'filter' => array('type' => 'int')
                    )
                ));				
        $this->grid->addField(
                array(
                    'field' => 'kodearsip',
                    'name'  => 'kodearsip',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Arsip','width' => 50,'align' => 'center','sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'tahun',
                    'name'  => 'tahun',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Tahun','width' => 40,'sortable' => true),
                      'filter' => array('type' => 'string')//, 'options' =>'2009','2010',['2011'],['2012'])
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'tanggalterima',
                    'name'  => 'tanggalterima',
                    'meta' => array(
                      'st' => array('type' => 'datetime'), 
                      'cm' => array('header' => 'Tanggal Masuk','width' => 90,'align' => 'center', 'sortable' => true),//, 'renderer' => "Ext.util.Format.dateRenderer('m-d-Y')"),
                      'filter' => array('type' => 'date')
                    )                
                ));
        $this->grid->addField(
                array(
                    'field' => 'ditujukan',
                    'name'  => 'ditujukan',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Ditujukan Kepada','width' => 150,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'pengirim',
                    'name'  => 'pengirim',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Pengirim','width' => 150,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'nomorsurat',
                    'name'  => 'nomorsurat',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Nomor','width' => 100,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'tanggalsurat',
                    'name'  => 'tanggalsurat',
                    'meta' => array(
                      'st' => array('type' => 'datetime'), 
                      'cm' => array('header' => 'Tanggal','width' => 90,'align' => 'center', 'sortable' => true),//, Ext.util.Format.dateRenderer('m/d/Y')'renderer' => "Ext.util.Format.dateRenderer('m-d-Y')"),
                      'filter' => array('type' => 'date')
                    )                
                ));				
        $this->grid->addField(
                array(
                    'field' => 'perihal',
                    'name'  => 'perihal',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Perihal','width' => 350,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));		
        $this->grid->addField(
                array(
                    'field' => 'lampiran',
                    'name'  => 'lampiran',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Lampiran','width' => 80),
                      'filter' => array('type' => 'string')
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'filearsip',
                    'name'  => 'filearsip',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'File','width' => 40,'sortable' => true,'align' => 'center', 'renderer' => 'renderIkon(val)'),
                      'filter' => array('type' => 'string')
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'addby',
                    'name'  => 'addby',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => true,'header' => 'Add By','width' => 60, 'sortable' => false,'align' => 'center', 'menuDisabled' => true)
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'addon',
                    'name'  => 'addon',
                    'meta' => array(
                      'st' => array('type' => 'datetime'),
                      'cm' => array('hidden' => true, 'hideable' => true,'header' => 'Add On','width' => 120, 'sortable' => false,'align' => 'center', 'menuDisabled' => true)
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'lasteditby',
                    'name'  => 'lasteditby',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => true,'header' => 'Edit By','width' => 60,'sortable' => false,'align' => 'center', 'menuDisabled' => true)
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'lastediton',
                    'name'  => 'lastediton',
                    'meta' => array(
                      'st' => array('type' => 'datetime'),
                      'cm' => array('hidden' => true, 'hideable' => true,'header' => 'Edit On','width' => 120, 'sortable' => false,'align' => 'center', 'menuDisabled' => true)
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'diteruskan',
                    'name'  => 'diteruskan',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('hidden' => true, 'hideable' => true,'header' => 'Diteruskan','width' => 120, 'sortable' => false,'align' => 'center', 'menuDisabled' => true)
                    )
                ));
		$this->grid->addField(
                array(
                    'field' => 'instruksi',
                    'name'  => 'instruksi',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('hidden' => true, 'hideable' => true,'header' => 'Instruksi','width' => 120, 'sortable' => false,'align' => 'center', 'menuDisabled' => true)
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'catatan',
                    'name'  => 'catatan',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('hidden' => true, 'hideable' => true,'header' => 'Catatan','width' => 120, 'sortable' => false,'align' => 'center', 'menuDisabled' => true)
                    )
                ));
    }
		
	function create($post){
		//uploading file
		$file_arsip=$this->uploadsurmas($post);
	
		/** start build query **/
		$this->db->BeginTrans(); 

		$str ="INSERT INTO tu_suratmasuk (nomor,kodearsip,tahun,tanggalterima,ditujukan,pengirim,nomorsurat,tanggalsurat,perihal,lampiran,filearsip,addBy,addOn) 
			   SELECT IFNULL(max(surmas.nomor)+1,1), '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %s, NOW()
			   FROM tu_suratmasuk surmas WHERE surmas.tahun='%s'";
		
		$post_tanggalterima=date_format(date_create($post['tanggalterima']), 'Y-m-d');
		if ($post['tanggalsurat']==='-'){
			$post_tanggalsurat=NULL;
		}else{
			$post_tanggalsurat=date_format(date_create($post['tanggalsurat']), 'Y-m-d');
		}
		
		$query= sprintf($str,mysql_real_escape_string($post['kodearsip']),
							 mysql_real_escape_string($post['tahun']),
							 mysql_real_escape_string($post_tanggalterima),
							 mysql_real_escape_string($post['ditujukan']),
							 mysql_real_escape_string($post['pengirim']),
							 mysql_real_escape_string($post['nomorsurat']),
							 mysql_real_escape_string($post_tanggalsurat),
							 mysql_real_escape_string($post['perihal']),
							 mysql_real_escape_string($post['lampiran']),
							 mysql_real_escape_string($file_arsip),
							 mysql_real_escape_string($post['userid']),							 
							 mysql_real_escape_string($post['tahun'])); 
						                      
		$this->setSQL($query);   
 
		$ok = $this->executeSQL();
		
		if ($ok)
			$this->db->CommitTrans(); 
		else
			$this->db->RollbackTrans(); 
		/** end build query **/
	
		$result = new stdClass(); 
		$result->success = ($ok)?true:false; 
		$result->message = $this->db->ErrorMsg(); 
    
		return json_encode($result); 
	
	}
	function uploadsurmas($post){
		if(($_FILES["filetoupload"]["type"] == "application/pdf") || ($_FILES["filetoupload"]["type"] == "application/msword")){
			$filedir="app/assets/arsip/surat/masuk/".date_format(date_create($post['tanggalterima']), 'Y')."/".date_format(date_create($post['tanggalterima']), 'm');
			if(!is_dir($filedir)){ 
				mkdir($filedir, 0777,true);
				copy("app/index.php",$filedir."/index.php");
			}
			
			$filedir = $filedir."/";
			
			$SafeFile = $_FILES['filetoupload']['name'];
			$SafeFile = str_replace("#", "No.", $SafeFile);
			$SafeFile = str_replace("$", "Dollar", $SafeFile);
			$SafeFile = str_replace("%", "Percent", $SafeFile);
			$SafeFile = str_replace("^", "", $SafeFile);
			$SafeFile = str_replace("&", "and", $SafeFile);
			$SafeFile = str_replace("*", "", $SafeFile);
			$SafeFile = str_replace("?", "", $SafeFile); 
			
			
			if(move_uploaded_file($_FILES['filetoupload']['tmp_name'],$filedir.$SafeFile)){
				return $filedir.$SafeFile;
			}else{ 
				return NULL;
			}
		}else{
			return NULL;
		}
	}

	function update($post){
	
		$post_tanggalterima=date_format(date_create($post['tanggalterima']), 'Y-m-d');
		if ($post['tanggalsurat']==='-'){
			$post_tanggalsurat=NULL;
		}else{
			$post_tanggalsurat=date_format(date_create($post['tanggalsurat']), 'Y-m-d');
		}
		//uploading file
		if ($_FILES['filetoupload']['size'] === 0){
	
			$str ="UPDATE tu_suratmasuk SET kodearsip='%s',tanggalterima='%s',ditujukan='%s',pengirim='%s',nomorsurat='%s',tanggalsurat='%s',perihal='%s',lampiran='%s',lasteditBy=%s,lasteditOn=NOW() WHERE tu_suratmasuk.id=%s";

			$query= sprintf($str,mysql_real_escape_string($post['kodearsip']),
								 mysql_real_escape_string($post_tanggalterima),
								 mysql_real_escape_string($post['ditujukan']),
								 mysql_real_escape_string($post['pengirim']),
								 mysql_real_escape_string($post['nomorsurat']),
								 mysql_real_escape_string($post_tanggalsurat),
								 mysql_real_escape_string($post['perihal']),
								 mysql_real_escape_string($post['lampiran']),
								 mysql_real_escape_string($post['userid']),							 
								 mysql_real_escape_string($post['id'])); 								 
		}else{
			$file_arsip=$this->uploadsurmas($post);
			$str ="UPDATE tu_suratmasuk SET kodearsip='%s',tanggalterima='%s',ditujukan='%s',pengirim='%s',nomorsurat='%s',tanggalsurat='%s',perihal='%s',lampiran='%s',filearsip='%s',lasteditBy=%s,lasteditOn=NOW() WHERE tu_suratmasuk.id=%s";
			
			$query= sprintf($str,mysql_real_escape_string($post['kodearsip']),
								 mysql_real_escape_string($post_tanggalterima),
								 mysql_real_escape_string($post['ditujukan']),
								 mysql_real_escape_string($post['pengirim']),
								 mysql_real_escape_string($post['nomorsurat']),
								 mysql_real_escape_string($post_tanggalsurat),
								 mysql_real_escape_string($post['perihal']),
								 mysql_real_escape_string($post['lampiran']),
								 mysql_real_escape_string($file_arsip),
								 mysql_real_escape_string($post['userid']),							 
								 mysql_real_escape_string($post['id'])); 
		}
		/** start build query **/
		$this->db->BeginTrans(); 
				                      
		$this->setSQL($query);   
 
		$ok = $this->executeSQL();
		
		if ($ok)
		  $this->db->CommitTrans(); 
		else
		  $this->db->RollbackTrans(); 
		/** end build query **/

		$result = new stdClass(); 
		$result->success = ($ok)?true:false; 
		$result->message = $this->db->ErrorMsg(); 
		
		return json_encode($result); 
		
	}
	
	function updatedisposisi($post){
	
		$str ="UPDATE tu_suratmasuk SET diteruskan='%s',instruksi='%s',catatan='%s' WHERE tu_suratmasuk.id=%s";

		$query= sprintf($str,mysql_real_escape_string($post['diteruskan']),
							mysql_real_escape_string($post['instruksi']),
							mysql_real_escape_string($post['catatan']),
							mysql_real_escape_string($post['id'])); 								 

		/** start build query **/
		$this->db->BeginTrans(); 
				                      
		$this->setSQL($query);   
 
		$ok = $this->executeSQL();
		
		if ($ok)
		  $this->db->CommitTrans(); 
		else
		  $this->db->RollbackTrans(); 
		/** end build query **/

		$result = new stdClass(); 
		$result->success = ($ok)?true:false; 
		$result->message = $this->db->ErrorMsg(); 
		
		return json_encode($result); 
		
	}
	
    function edit($id,$request){
       $this->grid->loadSingle = true;
       $this->grid->setManualFilter(" and id = $id"); 
       return $this->grid->doRead($request); 
    }

    function read($request){
        return $this->grid->doRead($request);
    }
	
    function doReport($request){
      return $this->grid->dosql($request); 
    }
    function doReport2($id,$request){
	  $this->grid->loadSingle = true;
	  $this->grid->setManualFilter(" and id = $id");
      return $this->grid->dosql($request); 
    }
    function destroy($request){
        return $this->grid->doDestroy($request);
    }
}
?>