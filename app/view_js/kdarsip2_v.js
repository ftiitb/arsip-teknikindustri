valid_script = true;  
ajax_url = 'ajax.handler.php?id=' + page;  

function reportSelect(bt){

	options = grid_kodearsip2.getParamsFilter();
    report_link = 'report.php?id=' + page;
    options = Ext.apply(options,{mode:bt.mode}); 
    winReport({
        id : 'rpt-kodearsip2',
        title : 'Daftar Kode Arsip',
        url : report_link,
        type : bt.mode,
        params:options        
    });

}

var grid_kodearsip2 = new Ext.ux.PhpDynamicGridPanel({
    border:false,
    remoteSort:true, //optional default true
    autoLoadStore:true, //optional default true
    storeUrl:ajax_url,
    sortInfo:{field:'kodearsip',direction:'ASC'}, //must declaration
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
      win_kodearsip2.get(1).getForm().reset();
      win_kodearsip2.setTitle('Add Data'); 
      win_kodearsip2.show(bt.id); 
    },
    onEditData:function(bt,rec){
      win_kodearsip2.setTitle('Edit Data');
      win_kodearsip2.show(bt.id); 
      win_kodearsip2.get(1).getForm().load({
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
win_kodearsip2 = new Ext.Window({
  id:'win-kodearsip2',
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
	html: '<div id="winheader"><label>KODE ARSIP</label></div>',
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
    {xtype:'textfield',name:'kodearsip',fieldLabel:'Kode Arsip',allowBlank:false,maxLength: 15,maxLengthText: 'Maximum 15 karakter.'},
    {xtype:'textarea',name:'deskripsi',fieldLabel:'Deskripsi',allowBlank:false,maxLength: 255,maxLengthText: 'Maximum 255 karakter.'}
    ]
  }], 
  buttons:[
  {
    text:'Save',
	iconCls:'icon-save',
    handler:function(){
      if(!win_kodearsip2.get(1).getForm().isValid()){
        Ext.example.msg('Peringatan','Ada data yang kosong'); 
        return false; 
      }
      
      id_data = win_kodearsip2.get(1).getForm().getValues().id; 
      action = (id_data?'update':'create'); 
      win_kodearsip2.get(1).getForm().submit({
          params:{action:action},
          waitMsg : 'Saving Data',
          success:function(){
            win_kodearsip2.hide();
            Ext.example.msg('Simpan','Data telah disimpan'); 
            grid_kodearsip2.store.reload(); 
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
      win_kodearsip2.hide(); 
    }
  }
  ]
}); 

/**end of form**/


var main_content = {
  id : id_panel,  
  title:n.text,  
  iconCls:n.attributes.iconCls,  
  items : [grid_kodearsip2],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('win-kodearsip2');
      if (my_win)
          my_win.destroy(); 
    }
  }
}; 
