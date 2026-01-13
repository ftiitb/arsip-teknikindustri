valid_script = true;  
ajax_url = 'ajax.handler.php?id=' + page;

function reportSelect(bt){

	options = grid_arsipsurkel.getParamsFilter();
    report_link = 'report.php?id=' + page;
    options = Ext.apply(options,{mode:bt.mode}); 
    winReport({
        id : 'rpt-arsipsurkel',
        title : 'Daftar Surat Keluar',
        url : report_link,
        type : bt.mode,
        params:options        
    });  

}

var kdsuratStore2 = new Ext.data.JsonStore({
	url: ajax_url,
	baseParams: {
		action:'readsurat'
	},
	id:'id',
	autoLoad:true,
	totalProperty: 'total',
	root:'data',
	fields:[
		{name:'kodesurat'},
		{name:'deskripsi'}
	],
	sortInfo: {field: 'kodesurat', direction: 'ASC'}
}); 

var kdarsipStore2 = new Ext.data.JsonStore({
	url: ajax_url,
	baseParams: {
		action:'readarsip'
	},
	id:'id',
	autoLoad:true,
	totalProperty: 'total',
	root:'data',
	fields:[
		{name:'kodearsip'},
		{name:'deskripsi'}
	],
	sortInfo: {field: 'kodearsip', direction: 'ASC'}
}); 

var dtpejabatStore2 = new Ext.data.JsonStore({
	url: ajax_url,
	baseParams: {
		action:'readpejabat'
	},
	id:'id',
	autoLoad:true,
	totalProperty: 'total',
	root:'data',
	fields:[
		{name:'jabatan'},
		{name:'namapejabat'},
		{name:'nippejabat'}
	],
	sortInfo: {field: 'jabatan', direction: 'ASC'}
}); 

var grid_arsipsurkel = new Ext.ux.PhpDynamicGridPanel({
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
      win_arsipsurkel.get(1).getForm().reset();
	  win_arsipsurkel.get(1).getForm().findField('userid').setValue(userid);
	  win_arsipsurkel.get(1).getForm().findField('tanggal').setValue(new Date);
      win_arsipsurkel.setTitle('Add Data'); 
      win_arsipsurkel.show(bt.id); 
    },
    onEditData:function(bt,rec){
	  win_arsipsurkel.get(1).getForm().reset();
	  win_arsipsurkel.get(1).getForm().findField('userid').setValue(userid);
      win_arsipsurkel.setTitle('Edit Data');
      win_arsipsurkel.show(bt.id); 
      win_arsipsurkel.get(1).getForm().load({
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
win_arsipsurkel = new Ext.Window({
  id:'win-arsipsurkel',
  height:420,
  width:450,
  closeAction:'hide',
  closable:true,
  title:'Add Data',
  border:false,
  modal:true,
  layout:'anchor',
  items:[
  {xtype:'panel',
	border:false,
	bodyStyle:{background: 'url(images/layout-browser-hd-bg.gif) repeat-x center', padding:'10px 20px'},
	html: '<div id="winheader"><label>SURAT KELUAR</label></div>',
	height:60
  },
  {
    xtype:'form',
	id:'form-arsipsurkel',
	fileUpload: true,
    border:false,
    frame:true,
	anchor:'100% -60',
    labelWidth:100,
    waitMsgTarget: true,
    url:ajax_url,
    defaults:{
		anchor:'-20',
		labelSeparator:''
    },
    bodyStyle:{padding:'10px'},
    items:[
    {xtype:'hidden', name:'id'},
	{xtype:'hidden', name:'userid'},
    {xtype: 'compositefield',
        fieldLabel: 'Nomor',
		msgTarget : 'side',
		defaults: {flex: 1},
		items: [
		{xtype:'textfield', width: 50, name:'nomor',emptyText:'auto', readOnly:true},
		{xtype : 'combo',
			tpl: '<tpl for="."><div ext:qtip="{kodesurat}:<br> {deskripsi}" class="x-combo-list-item">{kodesurat}</div></tpl>', 
			name: 'kodesurat',
			store : kdsuratStore2,
			displayField : 'kodesurat',
			valueField : 'kodesurat',
			typeAhead: true,
			emptyText:'...',
			allowBlank:false,
			triggerAction : 'all',
			selectOnFocus:true,
			editable : true,
			mode : 'local'
			},
        {xtype : 'combo',
			width: 50,
			tpl: '<tpl for="."><div ext:qtip="{kodearsip}:<br> {deskripsi}" class="x-combo-list-item">{kodearsip}</div></tpl>',
			name: 'kodearsip',
			store : kdarsipStore2,
			displayField : 'kodearsip',
			valueField : 'kodearsip',
			typeAhead: true,
			forceSelection: true,
			emptyText:'...',
			allowBlank:false,
			triggerAction : 'all',
			selectOnFocus:true,
			mode : 'local'
        },
		{xtype:'textfield',	width: 40, name:'tahun',readOnly:true}
		]
    },
	{xtype:'datefield',
		name:'tanggal',
		width: 100,
		anchor: '-130',
		fieldLabel:'Tanggal',
		format:'d F Y',
		listeners: {
			change: function (f, value) {
				win_arsipsurkel.get(1).getForm().findField('tahun').setValue(new Date(value).getFullYear());
			}
		}	
	},
    {xtype:'textfield',name:'ditujukan',width: 270,fieldLabel:'Ditujukan kepada'},
	{xtype:'textarea',name:'perihal',width: 270,fieldLabel:'Perihal'},
	{xtype:'textfield',name:'lampiran',width: 100,anchor: '-130',emptyText:'-',fieldLabel:'Lampiran'},
    {xtype : 'combo',
		width: 270,
		tpl: '<tpl for="."><div ext:qtip="{jabatan}:<br><hr> {namapejabat}<br>NIP.{nippejabat}" class="x-combo-list-item">{jabatan}</div></tpl>',
		name: 'pengirim',
		store : dtpejabatStore2,
		displayField : 'jabatan',
		valueField : 'jabatan',
		fieldLabel:'Pengirim',
		triggerAction : 'all',
		editable : true,
		mode : 'local'
    },
	{xtype: 'fileuploadfield',
        emptyText: 'Upload pdf | softcopy arsip ke server.',
        fieldLabel: 'Upload File',
        name: 'filetoupload',
        buttonText: '',
        buttonCfg: {
           iconCls: 'event-menu'
        }
	},
	{xtype:'displayfield',
		name:'filearsip',
		width: 270,
		submitValue:false,
		autoCreate:{
			tag:'a',
			href: '#'
		}
	}
    ]
  }], 
  buttons:[
  {
    text:'Save',
	iconCls:'icon-save',
    handler:function(){
      if(!win_arsipsurkel.get(1).getForm().isValid()){
        Ext.example.msg('Peringatan','Ada data yang kosong'); 
        return false; 
      }
      
      id_data = win_arsipsurkel.get(1).getForm().getValues().id; 
      action = (id_data?'update':'create'); 
      win_arsipsurkel.get(1).getForm().submit({
          params:{action:action},
          waitMsg : 'Saving Data',
          success:function(){
            win_arsipsurkel.hide();
            Ext.example.msg('Simpan','Data telah disimpan'); 
            grid_arsipsurkel.store.reload(); 
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
      win_arsipsurkel.hide(); 
    }
  }
  ]
}); 

var main_content = {
  id : id_panel,  
  title:n.text+' - Surat Keluar',  
  iconCls:n.attributes.iconCls,  
  items : [grid_arsipsurkel],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('win-arsipsurkel');
      if (my_win)
          my_win.destroy(); 
    }
  }
}; 