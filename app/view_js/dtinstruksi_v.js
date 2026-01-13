valid_script = true;  
ajax_url = 'ajax.handler.php?id=' + page;  

function reportSelect(bt){

	options = grid_dtinstruksi.getParamsFilter();
    report_link = 'report.php?id=' + page;
    options = Ext.apply(options,{mode:bt.mode}); 
    winReport({
        id : 'rpt-instruksi',
        title : 'Daftar Instruksi Disposisi',
        url : report_link,
        type : bt.mode,
        params:options        
    });

}

var grid_dtinstruksi = new Ext.ux.PhpDynamicGridPanel({
    border:false,
    remoteSort:true, //optional default true
    autoLoadStore:true, //optional default true
    storeUrl:ajax_url,
    sortInfo:{field:'id',direction:'ASC'}, //must declaration
    baseParams:{
      action:'read'
    },
    tbar:[
    '-',{
      text:'Print Data',
      iconCls:'report-mode',
	  iconAlign: 'top',
      menu:{
        items:[
        {text:'PDF format',mode:'pdf',handler:reportSelect,iconCls:'report-pdf'},
        {text:'XLS format',mode:'xls',handler:reportSelect,iconCls:'report-xls'}
        ]
      }
    }
    ],
    tbarDisable:{  //if not declaration default is true
      add:!ROLE.ADD_DATA,
      edit:!ROLE.EDIT_DATA,
      remove:!ROLE.REMOVE_DATA
    },
  	tbarHidden:{  //if not declaration default is true
      add:!ROLE.ADD_DATA,
      edit:!ROLE.EDIT_DATA,
      remove:!ROLE.REMOVE_DATA
    },
	   
    onAddData:function(bt){
      win_dtinstruksi.get(1).getForm().reset();
      win_dtinstruksi.setTitle('Add Data'); 
      win_dtinstruksi.show(bt.id); 
    },
    onEditData:function(bt,rec){
      win_dtinstruksi.setTitle('Edit Data');
      win_dtinstruksi.show(bt.id); 
      win_dtinstruksi.get(1).getForm().load({
          waitMsg:'Loading Data..',
          params:{action:'edit',id:rec.data.id}
      }); 
    },
    onRemoveData:function(bt,rec){
      data = []; 
      Ext.each(rec,function(r){
        data.push(r.data.id); 
      }); 
      Ext.Ajax.request({
        url: ajax_url, 
        params:{
          action:'destroy',
          data:data.join(",")
        },
        success:function(){
          this.store.reload(); 
        },
        scope:this
      });       
    }
}); 



/**form edit dan form add **/ 
win_dtinstruksi = new Ext.Window({
  id:'win-dtinstruksi',
  closeAction:'hide',
  closable:true,
  title:'Add Data',
  height:260,
  border:false,
  width:400,
  modal:true,
  layout:'anchor',
  items:[{
	xtype:'panel',
	border:false,
	bodyStyle:{background: 'url(images/layout-browser-hd-bg.png) repeat-x center', padding:'10px 20px'},
	html: '<div id="winheader"><label>DATA INSTRUKSI DISPOSISI</label></div>',
	height:60
  },
  {
    xtype:'form',
    border:false,
    frame:true,
	anchor:'100% -60',
    labelWidth:100,
    waitMsgTarget: true,
    url:ajax_url,
    defaults:{
      anchor:'98%',
      labelSeparator:''
    },
    bodyStyle:{padding:'10px'},
    items:[
    {xtype:'hidden', name:'id'},
    {xtype:'textfield',name:'instruksi',fieldLabel:'Instruksi',allowBlank:false,maxLength: 255,maxLengthText: 'Maximum 255 karakter.'}
    ]
  }], 
  buttons:[
  {
    text:'Save',
	iconCls:'icon-save',
    handler:function(){
      if(!win_dtinstruksi.get(1).getForm().isValid()){
        Ext.example.msg('Peringatan','Ada data yang kosong'); 
        return false; 
      }
      
      id_data = win_dtinstruksi.get(1).getForm().getValues().id; 
      action = (id_data?'update':'create'); 
      win_dtinstruksi.get(1).getForm().submit({
          params:{action:action},
          waitMsg : 'Saving Data',
          success:function(){
            win_dtinstruksi.hide();
            Ext.example.msg('Simpan','Data telah disimpan'); 
            grid_dtinstruksi.store.reload(); 
          },
          failure:function(){
            Ext.MessageBox.alert('Peringatan','Data tidak bisa disimpan, lihat difirebug errornya!!'); 
          }
      }); 
      
    }
  },{
    text:'Close',
	iconCls:'pindah-kk',
    handler:function(){
      win_dtinstruksi.hide(); 
    }
  }
  ]
}); 

/**end of form**/


var main_content = {
  id : id_panel,  
  title:n.text,  
  iconCls:n.attributes.iconCls,  
  items : [grid_dtinstruksi],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('win-dtinstruksi');
      if (my_win)
          my_win.destroy(); 
    }
  }
}; 
