valid_script = true;  
ajax_url = 'ajax.handler.php?id=' + page;

function reportSelect(bt){
	options = grid_surmas.getParamsFilter();
    report_link = 'report.php?id=' + page;
    options = Ext.apply(options,{mode:bt.mode}); 
    winReport({
        id : 'rpt-surmas',
        title : 'Daftar Surat Masuk',
        url : report_link,
        type : bt.mode,
        params:options        
    });  
}
function printKendali(bt,rec){
    report_link = 'report.php?id=' + page;
    winReport({
        id : 'rpt-kartukendali',
        title : 'Print Kartu Kendali',
        url : report_link,
        type : 'pdf',
        params:{mode:'kendali',id:rec.data.id}        
    });				
}
function addDisposisi(bt,rec){
	  win_disposisi.get(1).getForm().reset();
	  win_disposisi.get(1).getForm().findField('userid').setValue(userid);
      win_disposisi.setTitle('Edit Data');
      win_disposisi.show(bt.id); 
      win_disposisi.get(1).getForm().load({
          waitMsg:'Loading Data..',
          params:{action:'edit',id:rec.data.id}
      });

}
function showMenu(grid, index, event) {
      event.stopEvent();
      //var record = grid.getStore().getAt(index);
	  
	  var selDisable=true;
	  the_selected = grid.getSelectionModel().getSelected();
	  if (!the_selected){
		selDisable=true;
	  }else{
		selDisable=false;
	  
	  }
      var menugridsurmas = new Ext.menu.Menu({
            items: ['<b class="menu-title">Menu Surat Keluar</b>',
			{text: 'Add Data',
				iconCls:'add-data',
				hidden:!grid.topBar.get(1).isVisible(),
                handler: function() {
					grid.onAddData(grid.topBar.get(1));
                }
            },{text: '<i>Edit Data</i>',
				iconCls:'form-edit',
				disabled:selDisable,
				hidden:!grid.topBar.get(2).isVisible(),
                handler: function() {
					the_rec = grid.getSelectionModel().getSelected(); 
					if (!the_rec)
						Ext.example.msg('Edit Data','Anda belum memilih data yang akan di Edit.');
					else
						grid.onEditData(grid.topBar.get(2),the_rec); 
                }
            },{text: '<i>Remove Data</i>',
				iconCls:'table-delete',
				disabled:selDisable,
				hidden:!grid.topBar.get(3).isVisible(),
                handler: function() {
					  the_rec = grid.getSelectionModel().getSelections(); 
					  if (!the_rec.length)
						Ext.example.msg('Hapus Data','Anda belum memilih data(s) yang akan di Hapus.');
					  else{
						Ext.MessageBox.show({ 
							title:'Peringatan',  
							msg:'Yakin akan menghapus data yang dipilih?',  
							buttons : Ext.MessageBox.YESNO,  
							animEl:grid.topBar.get(3).id,  
							icon :Ext.MessageBox.WARNING,  
							fn:function(b){
							  if (b =='yes')
								grid.onRemoveData(grid.topBar.get(3),the_rec);
							},
							  scope:grid
						});
					  }
                }
            },'-',{text:'<b>Disposisi</b>',
				iconCls:'user-comment',
				menu:{
					items:['<b class="menu-title">Menu Disposisi</b>',
					{
						text:'Disposisi',
						iconCls:'add-data',
						disabled:selDisable,
						hidden:!grid.topBar.get(6).isVisible(),
						handler:function(bt){
						  the_rec = grid.getSelectionModel().getSelected(); 
						  if (!the_rec)
							Ext.example.msg('Input Disposisi','Anda belum memilih data yang akan di Disposisi.');
						  else
							addDisposisi(bt,the_rec);         
						}
					},{
						text:'Kartu Kendali',
						iconCls:'report-pdf',
						disabled:selDisable,
						hidden:!grid.topBar.get(7).isVisible(),
						handler:function(bt){
						  the_rec = grid.getSelectionModel().getSelected(); 
						  if (!the_rec)
							Ext.example.msg('Print Kartu Kendali','Anda belum memilih data Surat Masuk yang akan di Print Kartu Kendali.');
						  else
							printKendali(bt,the_rec); 
						}
					}
					]
				}
			},'-',{text:'Print Data',
				iconCls:'report-mode',
				menu:{
					items:['<b class="menu-title">Pilih format</b>',
					{text:'PDF format',mode:'pdf',handler:reportSelect,iconCls:'report-pdf'},
					{text:'XLS format',mode:'xls',handler:reportSelect,iconCls:'report-xls'}
					]
				}
            },
			{text: 'Refresh',
				iconCls:'drop',
                handler: function() {
					grid.store.reload();
                    Ext.example.msg('Data Grid Menu','Refreshing Data');
                }
            }
			]
        }).showAt(event.xy);
}

var kdarsipsurmasStore = new Ext.data.JsonStore({
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
/*
var dsUnit = new Ext.data.ArrayStore({
        data: [
            ['1', 'Ketua Prodi TMI'], 
			['2', 'Ketua KK-SM'], 
			['3', 'Ketua KK-MI'], 
			['4', 'Ketua KK-SITE'], 
			['5', 'Koordinator Lab. LSP'],
			['6', 'Koordinator Lab. LIPO'],
			['7', 'Koordinator Lab. LSIK'],
			['8', 'Koordinator Lab. POSI'],
			['9', 'Koordinator Lab.PSKE'],
			['10', 'Koordinator Lab. Multimedia'],
			['11', 'Koordinator Lab. PTI'],
            ['12', 'Koordinator Perpustakaan'], 
			['13', 'Staf / Dosen']],
        fields: ['value','text'],
        sortInfo: {
            field: 'value',
            direction: 'ASC'
        }
}); 
var dsUnit2 = new Ext.data.JsonStore({
	url: ajax_url,
	baseParams: {
		action:'readSubunit'
	},
	id:'id',
	autoLoad:true,
	totalProperty: 'total',
	root:'data',
	fields:[
		{name:'id'},
		{name:'subunit'}
	],
	sortInfo: {field: 'id', direction: 'ASC'}
}); 
*/
var grid_surmas = new Ext.ux.PhpDynamicGridPanel({
    border:false,
    remoteSort:true, //optional default true
    autoLoadStore:true, //optional default true
    storeUrl:ajax_url,
    sortInfo:{field:'nomor',direction:'DESC'}, //must declaration
    baseParams:{
      action:'read'
    },
    tbar:['-',{
      text:'Print Data',
      iconCls:'report-mode',
	  iconAlign: 'top',
      menu:{
        items:[
        {text:'PDF format',mode:'pdf',handler:reportSelect,iconCls:'report-pdf'},
        {text:'XLS format',mode:'xls',handler:reportSelect,iconCls:'report-xls'}
        ]
      }
    },'-',{
        text:'Disposisi',
        iconCls:'add-data',
		iconAlign: 'top',
        disabled:!ROLE.DISPOSISI,
		hidden:!ROLE.DISPOSISI,
        handler:function(bt){
          the_rec = grid_surmas.getSelectionModel().getSelected(); 
          if (!the_rec)
            Ext.example.msg('Input Disposisi','Anda belum memilih data yang akan di Disposisi.');
          else
            addDisposisi(bt,the_rec);         
        }
    },{
		text:'Kartu Kendali',
		iconCls:'report-pdf',
		iconAlign: 'top',
        disabled:!ROLE.KENDALI,
		hidden:!ROLE.KENDALI,
        handler:function(bt){
          the_rec = grid_surmas.getSelectionModel().getSelected(); 
          if (!the_rec)
            Ext.example.msg('Print Kartu Kendali','Anda belum memilih data Surat Masuk yang akan di Print Kartu Kendali.');
          else
            printKendali(bt,the_rec);  
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
      win_surmas.get(1).getForm().reset();
	  win_surmas.get(1).getForm().findField('userid').setValue(userid);
	  win_surmas.get(1).getForm().findField('tanggalterima').setValue(new Date);
	  win_surmas.get(1).getForm().findField('tahun').setValue(new Date().getFullYear());
      win_surmas.setTitle('Add Data'); 
      win_surmas.show(bt.id); 
    },
    onEditData:function(bt,rec){
	  win_surmas.get(1).getForm().reset();
	  win_surmas.get(1).getForm().findField('userid').setValue(userid);
      win_surmas.setTitle('Edit Data');
      win_surmas.show(bt.id); 
      win_surmas.get(1).getForm().load({
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
    },
	listeners: {
	    'rowcontextmenu' : function(grid, index, event) {
	        showMenu(grid, index, event);
	    }
	}

}); 

/**form edit dan form add **/ 
win_surmas = new Ext.Window({
  id:'win-surmas',
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
	id:'form-surmas',
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
			store : kdarsipsurmasStore,
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
				win_surmas.get(1).getForm().findField('tahun').setValue(new Date(value).getFullYear());
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
      if(!win_surmas.get(1).getForm().isValid()){
        Ext.example.msg('Peringatan','Ada data yang kosong'); 
        return false; 
      }
      
      id_data = win_surmas.get(1).getForm().getValues().id; 
      action = (id_data?'update':'create'); 
      win_surmas.get(1).getForm().submit({
          params:{action:action},
          waitMsg : 'Saving Data',
          success:function(f,a){
            win_surmas.hide();
            Ext.example.msg('Simpan','Data telah disimpan'); 
            grid_surmas.store.reload(); 
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
      win_surmas.hide(); 
    }
  }
  ]
}); 

win_disposisi = new Ext.Window({
  id:'win-disposisi',
  height:500,
  width:550,
  closeAction:'hide',
  closable:true,
  title:'Add Data',
  waitMsgTarget: true,
  border:false,
  modal:true,
  layout:'anchor',
  items:[
  {xtype:'panel',
	border:false,
	bodyStyle:{background: 'url(images/layout-browser-hd-bg.gif) repeat-x center', padding:'10px 20px'},
	html: '<div id="winheader"><label>DISPOSISI</label></div>',
	height:60
  },
  {
    xtype:'form',
	id:'form-disposisi',
    border:false,
    frame:true,
	anchor:'100% -60',
    labelWidth:80,
    url:ajax_url,
    defaults:{
		anchor:'-20',
		labelSeparator:''
    },
    bodyStyle:{padding:'10px'},
    items:[
    {xtype:'hidden', name:'id'},
	{xtype:'hidden', name:'userid'},
	{layout:'column',
		items:[{
            columnWidth:.5,
            layout: 'form',
            items: [
				{xtype:'displayfield',name:'pengirim',fieldLabel:'Asal Surat',submitValue:false},
				{xtype:'displayfield',name:'nomorsurat',fieldLabel:'Nomor Surat',submitValue:false},
				{xtype:'displayfield',name:'tanggalsurat',fieldLabel:'Tanggal Surat',submitValue:false}
			]
        },{
            columnWidth:.5,
            layout: 'form',
            items: [
				{xtype: 'compositefield',
				fieldLabel: 'Nomor Agenda',
				items: [
					{xtype:'displayfield',name:'nomor',submitValue:false},
					{xtype:'displayfield',name:'kodearsip',submitValue:false},
					{xtype:'displayfield',name:'tahun',submitValue:false}
				]},
				{xtype:'displayfield',name:'tanggalterima',fieldLabel:'Tanggal Terima',submitValue:false}					
			]
        }]
    },
	{xtype:'displayfield',name:'perihal',fieldLabel:'Perihal Surat',submitValue:false},
	{layout:'column',
		labelAlign: 'top',
		items:[{
            columnWidth:.5,
            layout: 'form',
            items: [
				{xtype:'textarea',name:'diteruskan',height: 150,anchor: '-10',fieldLabel:'Diteruskan kepada'}
			]
        },{
            columnWidth:.5,
            layout: 'form',
            items: [
				{xtype:'textarea',name:'instruksi',height: 150,anchor: '-10',fieldLabel:'Instruksi / Informasi'}					
			]
        }]
    },
	{layout:'column',
		labelAlign: 'top',
		items:[{
            columnWidth:1,
            layout: 'form',
            items: [
				{xtype:'textarea',name:'catatan',height: 45,anchor: '-10',fieldLabel:'Catatan'}
			]
        }]
    }
	
    ]
  }], 
  buttons:[
  {
    text:'Save',
	iconCls:'icon-save',
    handler:function(){
      if(!win_disposisi.get(1).getForm().isValid()){
        Ext.example.msg('Peringatan','Ada data yang kosong'); 
        return false; 
      }
      
      //id_data = win_disposisi.get(1).getForm().getValues().id; 
      action = 'updatedisposisi'; 
      win_disposisi.get(1).getForm().submit({
          params:{action:action},
          waitMsg : 'Saving Data',
          success:function(f,a){
            win_disposisi.hide();
            Ext.example.msg('Simpan','Data telah disimpan'); 
            grid_surmas.store.reload(); 
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
      win_disposisi.hide(); 
    }
  }
  ]
}); 
/**end of form**/


var main_content = {
  id : id_panel,  
  title:n.text+' - Surat Masuk',  
  iconCls:n.attributes.iconCls,  
  items : [grid_surmas],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('win-surmas');
      if (my_win)
          my_win.destroy(); 
	  my_win2 = Ext.getCmp('win-disposisi');
      if (my_win2)
          my_win2.destroy(); 
    }
  }
}; 