Ext.ux.PhpDynamicGridPanel = Ext.extend(Ext.ux.DynamicGridPanel, {
    tbarDisable:{add:false,edit:false,remove:false},
	tbarHidden:{add:false,edit:false,remove:false},
    initComponent: function () {
        this.createTbar(); 
        if (this.tbar)
         this.topBar.add(this.tbar);                 
        this.tbar = this.topBar;          
        Ext.ux.PhpDynamicGridPanel.superclass.initComponent.apply(this, arguments);
        
        this.on('celldblclick',
          function(){
            if (!this.tbarDisable.edit){
              the_rec = this.getSelectionModel().getSelected(); 
              this.onEditData(this.topBar.get(2),the_rec);
            }
          },
          this
        )
    },
    onAddData:function(bt){
      
    },
    onEditData:function(bt,rec){
      
    },
    onRemoveData:function(bt,rec){
      
    },
	
    createTbar:function(){
      this.topBar = new Ext.Toolbar({xtype:'buttongroup',items:[
      {
        text:'Add Data',
        iconCls:'add-data',
		iconAlign: 'top',
        scope:this,
        disabled:this.tbarDisable.add,
		hidden:this.tbarHidden.add,
        handler:function(bt){
          this.onAddData(bt);     
        }
      },{
        text:'Edit Data',
        iconCls:'form-edit',
		iconAlign: 'top',
        disabled:this.tbarDisable.edit,
		hidden:this.tbarHidden.edit,
        scope:this,
        handler:function(bt){
          the_rec = this.getSelectionModel().getSelected(); 
          if (!the_rec)
            Ext.example.msg('Edit Data','Anda belum memilih data yang akan di Edit.');
          else
            this.onEditData(bt,the_rec);         
        }
      },{
        text:'Remove Data',
        iconCls:'table-delete',
		iconAlign: 'top',
        disabled:this.tbarDisable.remove,
		hidden:this.tbarHidden.remove,
        scope:this,
        handler:function(bt){
          the_rec = this.getSelectionModel().getSelections(); 
          if (!the_rec.length)
            Ext.example.msg('Remove Data','Anda belum memilih data yang akan di Hapus.');
          else{
            Ext.MessageBox.show({ 
                title:'Peringatan',  
                msg:'Yakin akan menghapus data ini?',  
                buttons : Ext.MessageBox.YESNO,  
                animEl:bt.id,  
                icon :Ext.MessageBox.WARNING,  
                fn:function(b){
                  if (b =='yes')
                    this.onRemoveData(bt,the_rec);
                },
                  scope:this
            });
          }
        }
      }
      ]});
      return this.topBar; 
    }
 });