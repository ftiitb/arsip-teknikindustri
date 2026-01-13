Ext.onReady(function(){	
	Ext.QuickTips.init();	
	var reloadIcon = false; 
	 var iconStore = new Ext.data.JsonStore({
		url:'icon.php',
		id: 'id',
		totalProperty: 'total',
		baseParams: {
			task: 'getIcon'
		},
		root: 'data',
		fields: [
		  {name:'id'}, 
		  {name:'title'},
		  {name:'clsname'}, 
		  {name:'icon'}
		],
		  sortInfo: {field: 'clsname', direction: 'ASC'},
		  remoteSort: true, 
		  listeners: {
				load : function(thisIcon) {
					iconcss =""; 
					thisIcon.each(function(r,i){
							row = r.data; 
							iconcss +=" "; 
							iconcss += String.format('.{0} { background-image: url(images/icon/{1}) !important; }',row.clsname,row.icon); 
							
						}
					);
					if (reloadIcon)
						Ext.util.CSS.removeStyleSheet('iconcss'); 	
					Ext.util.CSS.createStyleSheet(iconcss, 'iconcss'); 
					reloadIcon = false; 
				}
		  }
	});
	iconStore.load({params:{start: 0, limit:500}});	
	//just for loading.. 
	var loadingDiv;
	loadingDiv = Ext.getDom('loading');
	loadingDiv.style.display = 'none';
	
	var winLogin = {
			layout:'border',
			id:'winLogin',
			width:400,
			height:210,
			border:true,
			iconCls:'lock',
			title:'Please Login',
			//plain:true,
			frame:true,
			items:[picLogin,loginForm],
			buttons: [
					{
						text:'Submit',
						iconCls:'login',
						id:'btn-login',
						scale:'medium',
						handler:function() {
							if (Ext.getCmp('frmLogin').getForm().isValid()) {
								Ext.getCmp('content-panel').body.mask('Validating User','x-mask-loading'); 
								dataLogin = Ext.getCmp('frmLogin').getForm().getValues();
								Ext.Ajax.request({
									url:'ajax.admin.php',
									params:{
											id:'login',
											task: "login",
											username : dataLogin.username, 
											pwd : dataLogin.pwd
									},
									success: function(response) {
										res = Ext.decode(response.responseText);
										if(res.success){
											Ext.getCmp('content-panel').body.unmask();
											window.location = '/';
										} else {
											userid=0; 
											Ext.getCmp('content-panel').body.unmask();
											Ext.MessageBox.show({
												title: 'Invalid',
												msg: 'Sorry, Invalid Username or Password, Please try Again',
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.WARNING
											});										
										
										}
										
									}
								}); 
							}
							
						}
					},{
						text:'Reset',
						scale:'medium',
						iconCls:'drop',
						handler:function() {
								Ext.getCmp('frmLogin').getForm().reset();
						}					
					}
			]
	};
	
	var cLogin = {
		id:'cLogin',
		layout:'hbox',
		title:'Login Page',
	    layoutConfig: {
	    	padding:'5',
	    	pack:'center',
	    	align:'middle'
		},
		items:[winLogin]
	};
	
	var contentPanel = {
		id: 'content-panel',
		region: 'center', // this is what makes this panel into a region within the containing layout
		layout: 'card',

		activeItem: 0,
		border: false,
		items: [
			cLogin
		]
	};
	
    var viewPort = new Ext.Viewport({
		layout: 'border',
		title: 'Ext Layout Browser',
		items: [
		{
		    xtype: 'box',
			region: 'north',
			applyTo: 'header',
			height: 60
		},
          contentPanel
		],
        renderTo:Ext.getBody()
    });	
});