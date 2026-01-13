valid_script = true;  
ajax_url = 'ajax.handler.php?id=' + page;  

    var grid_confsurmas = new Ext.grid.PropertyGrid({

        width: 300,
        autoHeight: true,
        propertyNames: {
            tested: 'QA',
            borderWidth: 'Border Width'
        },
        source: {
            '(name)': 'Properties Grid',
            grouping: false,
            autoFitColumns: true,
            productionQuality: false,
            created: new Date(Date.parse('10/15/2006')),
            tested: false,
            version: 0.01,
            borderWidth: 1
        },
        viewConfig : {
            forceFit: true,
            scrollOffset: 2 // the grid will never have scrollbars
        }
    });

    // simulate updating the grid data via a button click
    var btn_confsurmas = new Ext.Button({

        text: 'Update source',
        handler: function(){
            grid_confsurmas.setSource({
                '(name)': 'Property Grid',
                grouping: false,
                autoFitColumns: true,
                productionQuality: true,
                created: new Date(),
                tested: false,
                version: 0.8,
                borderWidth: 2
            });
        }
    });

var panelConfig = new Ext.Panel({
		id:'confsurmas',
		layout:'vbox',
		title:'Configuration',
	    layoutConfig: {
	    	padding:'10',
	    	pack:'top',
	    	align:'left'
		},
		items:[grid_confsurmas,btn_confsurmas]
});
	
var main_content = {
  id : id_panel,  
  title:n.text+' - Surat Masuk',  
  iconCls:n.attributes.iconCls,  
  items : [panelConfig]
}; 
