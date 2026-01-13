valid_script = true;  
ajax_url = 'ajax.handler.php?id=' + page;

function reportSelect(bt){

	options = grid_arsipsurmas.getParamsFilter();
    report_link = 'report.php?id=' + page;
    options = Ext.apply(options,{mode:bt.mode}); 
    winReport({
        id : 'rpt-arsipsurmas',
        title : 'Daftar Surat Masuk',
        url : report_link,
        type : bt.mode,
        params:options        
    });  

}

var kdarsipsurmasStore2 = new Ext.data.JsonStore({
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


var grid_arsipsurmas = new Ext.ux.PhpDynamicGridPanel({
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
      win_arsipsurmas.get(1).getForm().reset();
	  win_arsipsurmas.get(1).getForm().findField('userid').setValue(userid);
	  win_arsipsurmas.get(1).getForm().findField('tanggalterima').setValue(new Date);
	  win_arsipsurmas.get(1).getForm().findField('tahun').setValue(new Date().getFullYear());
      win_arsipsurmas.setTitle('Add Data'); 
      win_arsipsurmas.show(bt.id); 
    },
    onEditData:function(bt,rec){
	  win_arsipsurmas.get(1).getForm().reset();
	  win_arsipsurmas.get(1).getForm().findField('userid').setValue(userid);
      win_arsipsurmas.setTitle('Edit Data');
      win_arsipsurmas.show(bt.id); 
      win_arsipsurmas.get(1).getForm().load({
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
win_arsipsurmas = new Ext.Window({
  id:'win-arsipsurmas',
  height:500,
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
	html: '<div id="winheader"><label>SURAT MASUK</label></div>',
	height:60
  },
  {
    xtype:'form',
	id:'form-arsipsurmas',
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
        fieldLabel: 'Nomor Agenda',
		msgTarget : 'side',
		defaults: {flex: 1},
		items: [
		{xtype:'textfield', width: 50, name:'nomor',emptyText:'auto', readOnly:true},
        {xtype : 'combo',
			width: 70,
			tpl: '<tpl for="."><div ext:qtip="{kodearsip}:<br> {deskripsi}" class="x-combo-list-item">{kodearsip}</div></tpl>',
			name: 'kodearsip',
			store : kdarsipsurmasStore2,
			displayField : 'kodearsip',
			valueField : 'kodearsip',
			typeAhead: true,
			forceSelection: true,
			emptyText:'Arsip..',
			allowBlank:false,
			triggerAction : 'all',
			selectOnFocus:true,
			mode : 'local'
        },
		{xtype:'textfield',	width: 40, name:'tahun',readOnly:true}
		]
    },
	{xtype:'datefield',
		name:'tanggalterima',
		width: 100,
		anchor: '-130',
		fieldLabel:'Diterima Tanggal',
		format:'d F Y',
		listeners: {
			change: function (f, value) {
				win_arsipsurmas.get(1).getForm().findField('tahun').setValue(new Date(value).getFullYear());
			}
		}	
	},
    {xtype:'textfield',name:'ditujukan',width: 270,fieldLabel:'Ditujukan Kepada',maxLength: 255,maxLengthText: 'Panjang maximum 255 karakter.'},
	{xtype:'fieldset',
		title: 'Rincian informasi surat yang diterima:',
        collapsible: false,
		items :[
	{xtype:'textfield',name:'pengirim',width: 250,anchor: '-10',fieldLabel:'Nama Pengirim',maxLength: 255,maxLengthText: 'Panjang maximum 255 karakter.'},
	{xtype:'textfield',name:'nomorsurat',width: 100,anchor: '-100',emptyText:'-',fieldLabel:'Nomor Surat',maxLength: 100,maxLengthText: 'Panjang maximum 100 karakter.'},
	{xtype:'datefield',name:'tanggalsurat',width: 100,anchor: '-100',emptyText:'-',fieldLabel:'Tanggal Surat',format:'d F Y'},
	{xtype:'textarea',name:'perihal',width: 250,anchor: '-10',fieldLabel:'Perihal'},
	{xtype:'textfield',name:'lampiran',width: 100,anchor: '-100',emptyText:'-',fieldLabel:'Lampiran',maxLength: 100,maxLengthText: 'Panjang maximum 100 karakter.'},
	]},
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
      if(!win_arsipsurmas.get(1).getForm().isValid()){
        Ext.example.msg('Peringatan','Ada data yang kosong'); 
        return false; 
      }
      
      id_data = win_arsipsurmas.get(1).getForm().getValues().id; 
      action = (id_data?'update':'create'); 
      win_arsipsurmas.get(1).getForm().submit({
          params:{action:action},
          waitMsg : 'Saving Data',
          success:function(f,a){
            win_arsipsurmas.hide();
            Ext.example.msg('Simpan','Data telah disimpan'); 
            grid_arsipsurmas.store.reload(); 
          },
          failure:function(f,a){
            Ext.MessageBox.alert('Peringatan',a.result.errormsg); 
          }
      }); 
      
    }
  },{
    text:'Close',
	iconCls:'pindah-kk',
    handler:function(){
      win_arsipsurmas.hide(); 
    }
  }
  ]
}); 

var main_content = {
  id : id_panel,  
  title:n.text+' - Surat Masuk',  
  iconCls:n.attributes.iconCls,  
  items : [grid_arsipsurmas],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('win-arsipsurmas');
      if (my_win)
          my_win.destroy(); 
    }
  }
}; 