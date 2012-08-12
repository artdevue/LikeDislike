likeDislike.grid.ipBlock = function(config) {
    config = config || {};
    this.sm = new Ext.grid.CheckboxSelectionModel();
    Ext.applyIf(config,{
        id: 'likedislike-grid-ipblock'
        ,url: likeDislike.config.connectorUrl
        ,baseParams: { action: 'mgr/ip/getlist' }
        ,save_action: 'mgr/ip/updateipgrid'
        ,fields: ['id', 'ip', 'date', 'intro', 'publishedon_date', 'publishedon_time', 'actions']
        ,paging: true
        ,autosave: true
        ,remoteSort: true
        ,sm: this.sm
	,loadingText : '<div class="empty-msg"><h4>'+_('likedislike.loading')+'</h4></div>'
	,emptyText : '<div class="empty-msg"><h4>'+_('likedislike.items_empty_ip_msg')+'</h4></div>'
        ,autoExpandColumn: 'date'
        ,columns: [this.sm,{
            hidden: true
            ,hideable: false
            ,dataIndex: 'id'
        },{
            header: '<img src="'+likeDislike.config.cssUrl+'images/calendar_16.png" alt="'+  _('likedislike.date') +'" class="likedislike-date-col-header" />'
            ,dataIndex: 'date'
            ,sortable: true
            ,width: 25
            ,renderer: {fn:this._renderDate,scope:this}
        },{
            header: _('likedislike.ip_adress')
            ,dataIndex: 'ip'
            ,id: 'ip'
	    ,width: 30
	    ,sortable: true
	    ,editor: { xtype: 'textfield' }
            ,renderer : {fn:this._renderPageTitle,scope:this}
        },{
            header: _('likedislike.description')
            ,dataIndex: 'intro'
	    ,cls: 'intro'
            ,editor: { xtype: 'textfield' }
	    ,renderer: function(val) {
		return '<p class="sp_text">'+val+'</p>';
            }
        },{
	    /*header: '<img src="'+likeDislike.config.cssUrl+'images/options.png" alt="'+  _('delete') +'" class="likedislike-ipc-col-header" />'
	    ,xtype:'actioncolumn'
	    ,width:10
	    ,align: 'center'
	    ,items: [{
		icon: likeDislike.config.cssUrl + 'images/delete_24.png' 
		,tooltip:  _('delete')
		,handler: this.deleteIp
		,scope: this
	    }]*/
            header: '<img src="'+likeDislike.config.cssUrl+'images/options.png" alt="'+  _('delete') +'" class="likedislike-ip-col-header" />'
	    ,width: 10
	    ,align: 'center'	    
            ,renderer : {fn:this._renderIpDelete,scope:this}
        }]
        ,tbar: [{
		text: _('likedislike.like_selected_delete')
		,iconCls:'icon-delete'
		,handler: this.deleteIpSelect
		,scope: this			
	    },' ',{
		text: _('likedislike.ip_block_create')
		,handler: this.createIp
		,scope: this
		,iconCls:'icon-add'			
	    },'->',{
            xtype: 'textfield'
            ,id: 'likedislike-search-filterip'
            ,emptyText: _('likedislike.search...')
            ,listeners: {
                'change': {fn:this.search,scope:this}
                ,'render': {fn: function(cmp) {
                    new Ext.KeyMap(cmp.getEl(), {
                        key: Ext.EventObject.ENTER
                        ,fn: function() {
                            this.fireEvent('change',this);
                            this.blur();
                            return true;
                        }
                        ,scope: cmp
                    });
                },scope:this}
            }
        }]
    });
    likeDislike.grid.ipBlock.superclass.constructor.call(this,config)
    this._makeTemplates();
    this.on('rowclick',MODx.fireResourceFormChange); 
    this.on('click', this.onClick, this);
};
Ext.extend(likeDislike.grid.ipBlock,MODx.grid.Grid,{
    search: function(tf,nv,ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }
    ,activeSelected: function(btn,e) {
        var cs = this.getSelectedAsList();
        if (cs === false) return false;

        MODx.Ajax.request({
            url: this.config.url
            ,params: {
                action: 'mgr/likedislik/activeMultiple'
                ,like: cs
		,mode: btn['id']
            }
            ,listeners: {
                'success': {fn:function(r) {
                    this.getSelectionModel().clearSelections(true);
                    this.refresh();
                },scope:this}
            }
        });
        return true;
    }
    ,createIp: function(e) {
	gid = 0;
	var w = MODx.load({
	    xtype: 'likedislike-window-ip-create'
	    ,title: _('likedislike.ip_create')
	    ,disable_categories: true
	    ,action: 'mgr/ip/create'
	    ,listeners: {
		'success':{fn:function() {
		    Ext.getCmp('likedislike-grid-ipblock').store.reload();
		},scope:this}
		,'show':{fn:function() {this.center();}}
	    }
	});
	w.show(e.target,function() {
	    Ext.isSafari ? w.setPosition(null,30) : w.center();
	},this);
    }
    ,updatelikeDislik: function(btn,e) {
        if (!this.updatelikeDislikWindow) {
            this.updatelikeDislikWindow = MODx.load({
                xtype: 'likedislike-window-likedislik-update'
                ,record: this.menu.record
                ,listeners: {
                    'success': {fn:this.refresh,scope:this}
                }
            });
        }
        this.updatelikeDislikWindow.setValues(this.menu.record);
        this.updatelikeDislikWindow.show(e.target);
    }

    ,removelikeDislik: function() {
        MODx.msg.confirm({
            title: _('likedislike.likedislik_remove') 
            ,text: _('likedislike.likedislik_remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/likedislik/remove'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': {fn:this.refresh,scope:this}
            }
        });
    }
    ,_makeTemplates: function() {
        this.tplDate = new Ext.XTemplate('<tpl for=".">'
            +'<div class="like-grid-date">{publishedon_date}<span class="like-grid-time">{publishedon_time}</span></div>'
        +'</tpl>',{
			compiled: true
		});
        this.tplPageTitle = new Ext.XTemplate('<tpl for="."><div class="like-ip-column">'
	    +'<h3 class="main-column grey">{ip}</h3></div>'
	+'</tpl>',{
			compiled: true
		});
	this.tplIpDelete = new Ext.XTemplate('<tpl for=".">'
                +'<ul class="actions del">'
                    +'<tpl for="actions">'
                        +'<li><a href="#homeTab:ip-blocking"><img class="controlBtn deleteip" src="' + likeDislike.config.cssUrl +'images/delete_24.png" ext:qtip="{text}" /></a></li>'
                    +'</tpl>'
                +'</ul>'
	+'</tpl>',{
			compiled: true
		});
    }
    ,_renderPageTitle:function(v,md,rec) {
		return this.tplPageTitle.apply(rec.data);
	}
    ,_renderDate:function(v,md,rec) {
		return this.tplDate.apply(rec.data);
	}
    ,_renderIpDelete:function(v,md,rec) {
		return this.tplIpDelete.apply(rec.data);
	}
    ,unpublishLike: function(btn,e) {
        MODx.Ajax.request({
            url: this.config.url
            ,params: {
                action: 'mgr/likedislik/unpublish'
                ,id: this.menu.record.id
                ,mode: 'unpub'
            }
            ,listeners: {
                'success':{fn:this.refresh,scope:this}
            }
        });
    } 
    ,publishLike: function(btn,e) {
        MODx.Ajax.request({
            url: this.config.url
            ,params: {
                action: 'mgr/likedislik/unpublish'
                ,id: this.menu.record.id
                ,mode: 'pub' 
            }
            ,listeners: {
                'success':{fn:this.refresh,scope:this}
            }
        });
    }
    ,deleteIp: function(btn,e) {
        MODx.msg.confirm({            
            title: _('likedislike.likedislik_remove_ip') 
            ,text: _('likedislike.likedislik_remove_ip_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/ip/remove' 
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success':{fn:this.refresh,scope:this}
            }
        });
    }
    ,deleteIpSelect: function(btn,e) {
        var cs = this.getSelectedAsList();
        if (cs === false) return false;

        MODx.msg.confirm({
            title: _('likedislike.likedislik_remove_ips')
            ,text: _('likedislike.likedislik_remove_ips_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/ip/deleteMultiple'
                ,ids: cs
            }
            ,listeners: {
                'success': {fn:function(r) {
                    this.getSelectionModel().clearSelections(true);
                    this.refresh();
                },scope:this}
            }
        });
        return true;
    }
    ,onClick: function(e){
		var t = e.getTarget();
		var elm = t.className.split(' ')[0];
		if(elm == 'controlBtn') {
			var action = t.className.split(' ')[1];
			var record = this.getSelectionModel().getSelected();
                        this.menu.record = record;
			switch (action) {
                            case 'deleteip':
                                this.deleteIp();
			    default:
				break;
            }
	}
    }
});
Ext.reg('likedislike-grid-ipblock',likeDislike.grid.ipBlock); 

likeDislike.window.CreateIp = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('likedislike.ip_create')
        ,url: likeDislike.config.connectorUrl
        ,baseParams: {
            action: 'mgr/ip/create'
        }
        ,fields: [{
            xtype: 'textfield'
            ,fieldLabel: _('likedislike.ip_block')
            ,name: 'ip'
            ,anchor: '100%'
        },{
            xtype: 'textarea'
            ,fieldLabel: _('likedislike.description')
            ,name: 'intro'
            ,anchor: '100%'
        }]
    });
    likeDislike.window.CreateIp.superclass.constructor.call(this,config);
};
Ext.extend(likeDislike.window.CreateIp,MODx.Window);
Ext.reg('likedislike-window-ip-create',likeDislike.window.CreateIp);


likeDislike.window.UpdateHotels = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('westh.west_update')
        ,url: Westh.config.connectorUrl
        ,baseParams: {
            action: 'mgr/westh/update'
        }
        ,fields: [{
            xtype: 'hidden'
            ,name: 'id'
        },{
            xtype: 'textfield'
            ,fieldLabel: _('westh.name')
            ,name: 'name'
            ,anchor: '100%'
        },{
            xtype: 'textarea'
            ,fieldLabel: _('westh.description')
            ,name: 'description'
            ,anchor: '100%'
        }]
    });
    likeDislike.window.UpdateHotels.superclass.constructor.call(this,config);
};
Ext.extend(likeDislike.window.UpdateHotels,MODx.Window);
Ext.reg('likedislike-window-hotels-update',likeDislike.window.UpdateHotels);
