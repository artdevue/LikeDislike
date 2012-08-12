likeDislike.grid.likeDislike = function(config) {
    config = config || {};
    this.sm = new Ext.grid.CheckboxSelectionModel();
    Ext.applyIf(config,{
        id: 'likedislike-grid-likedislike'
        ,url: likeDislike.config.connectorUrl
        ,baseParams: { action: 'mgr/likedislik/getList' }
        ,save_action: 'mgr/likedislik/updatefromgrid'
        ,fields: ['id', 'closed', 'category', 'name', 'votes_up'
                  , 'votes_down', 'date', 'publishedon_date', 'publishedon_year'
                  , 'pag_name', 'actions', 'pag_num']
        ,paging: true
        ,autosave: true
        ,remoteSort: true
        ,sm: this.sm
        ,loadingText : '<div class="empty-msg"><h4>'+_('likedislike.loading')+'</h4></div>'
	,emptyText : '<div class="empty-msg"><h4>'+_('likedislike.items_empty_msg')+'</h4></div>'
        ,autoExpandColumn: 'date'
        ,columns: [this.sm,{
            hidden: true
            ,hideable: false
            ,dataIndex: 'id'
        },{
            header: '<img src="'+likeDislike.config.cssUrl+'images/calendar_16.png" alt="'
                +  _('likedislike.date') +'" class="likedislike-date-col-header" /> '
                + _('likedislike.date')
            ,dataIndex: 'date'
            ,sortable: true
            ,width: 45
            ,renderer: {fn:this._renderDate,scope:this}
        },{
            header: _('likedislike.name')
            ,dataIndex: 'name'
            ,id: 'main'
            ,sortable: true
            ,renderer : {fn:this._renderPageTitle,scope:this}
        },{
            header: '<img src="'+likeDislike.config.cssUrl+'images/chart_up_16.png" alt="'
                +  _('likedislike.up') +'" class="likedislike-icon-col-header" /><br/>'
                + _('likedislike.up')
            ,dataIndex: 'votes_up'
            ,sortable: true
            ,width: 30
            ,align: 'center'
            ,editor: { xtype: 'textfield' }
            ,renderer : function(val) {
                return '<div class="wi_val">' + val + '</div>';
            }
        },{
            header: '<img src="'+likeDislike.config.cssUrl+'images/chart_down_16.png" alt="'
                +  _('likedislike.down') +'" class="likedislike-icon-col-header" /><br/>'
                + _('likedislike.down')
            ,dataIndex: 'votes_down'
            ,sortable: true
            ,width: 30
            ,align: 'center'
            ,editor: { xtype: 'textfield' }
            ,renderer : function(val) {
                return '<div class="wi_val">' + val + '</div>';
            }
        },{
            header: '<img src="'+likeDislike.config.cssUrl+'images/chart_line_16.png" alt="'
                +  _('likedislike.total') +'" class="likedislike-icon-col-header" /><br/>'
                + _('likedislike.total')
            ,width: 30
            ,align: 'center'
            ,renderer : {fn:this._renderTotal,scope:this}
        },{
            header: '<img src="'+likeDislike.config.cssUrl+'images/chart_bar1_16.png" alt="'
                +  _('likedislike.balance') +'" class="likedislike-icon-col-header" /><br/>'
                + _('likedislike.balance')
            ,width: 30
            ,id: 'balance'
            ,align: 'center'
            ,renderer : {fn:this._renderBalance,scope:this}
        },{
            header: '<img src="'+likeDislike.config.cssUrl+'images/chart_bar_up_16.png" alt="'
                +  _('likedislike.up') +'" class="likedislike-icon-col-header" /><br/>% '
                + _('likedislike.up')
            ,align: 'center'
            ,width: 30
            ,renderer : {fn:this._renderPctUp,scope:this}            
        },{
            header: '<img src="'+likeDislike.config.cssUrl+'images/chart_bar_down_16.png" alt="'
                +  _('likedislike.down') +'" class="likedislike-icon-col-header" /><br/>% '
                + _('likedislike.down')
            ,align: 'center'
            ,width: 30
            ,renderer : {fn:this._renderPctDown,scope:this}
        }]
        ,tbar: [{
            text: _('bulk_actions')
            ,iconCls:'icon-options'
            ,menu: [{
                text: _('likedislike.like_selected_publish')
                ,handler: this.activeSelected
                ,id: 'publishitem'
                ,scope: this
            },{
                text: _('likedislike.like_selected_unpublish')
                ,handler: this.activeSelected
                ,id: 'unpublishitem'
                ,scope: this
            },'-',{
                text: _('likedislike.like_selected_delete')
                ,handler: this.activeSelected
                ,id: 'deleteitem'
                ,scope: this
            }]
        },' ',{
            xtype: 'likedislike-filter-category'
            ,id: 'vfc'
            ,listeners: {'select': {fn: this.filterByCategory, scope:this}}
        },'->',{
            xtype: 'textfield'
            ,id: 'likedislike-search-filter'
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
        },{
            xtype: 'button'
            ,id: 'modx-filter-clear'
            ,iconCls:'icon-reload'
            ,text: _('filter_clear')
            ,listeners: {
                'click': {fn: this.clearFilter, scope: this}
            }
        }]
    });
    likeDislike.grid.likeDislike.superclass.constructor.call(this,config)
    this._makeTemplates();
    this.on('rowclick',MODx.fireResourceFormChange); 
    this.on('click', this.onClick, this);
};
Ext.extend(likeDislike.grid.likeDislike,MODx.grid.Grid,{
    search: function(tf,nv,ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }
    ,clearFilter: function() {
    	this.getStore().baseParams = {
            action: 'mgr/likedislik/getList'
            ,'parent': this.config.resource
    	};
        Ext.getCmp('likedislike-search-filter').reset();
    	this.getBottomToolbar().changePage(1);
        this.refresh();
    }
    ,filterByCategory: function(cb) {
		this.getStore().baseParams['category'] = cb.value;
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
            +'<div class="like-grid-date">{publishedon_date}<span class="like-grid-category like-grid-year">{publishedon_year}</span><span class="like-grid-category">{category} / {pag_num}</span></div>'
        +'</tpl>',{
			compiled: true
		});
        this.tplPageTitle = new Ext.XTemplate('<tpl for="."><div class="like-title-column">'
	    +'<h3 class="main-column">{pag_name}</h3></div>'
            +'<tpl if="actions">'
                +'<ul class="actions">'
                    +'<tpl for="actions">'
                        +'<li><a href="#" class="controlBtn {className}">{text}</a></li>'
                    +'</tpl>'
                +'</ul>'
            +'</tpl>'
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
    ,_renderTotal:function(v,md,rec) {
                total = rec.data.votes_up*1 + rec.data.votes_down*1;
		return '<div class="wi_val">' + total + '</div>';
	}
    ,_renderBalance:function(v,md,rec) {
                balanc = rec.data.votes_up - rec.data.votes_down;
                if(balanc > 0) balanc = '+' + balanc;
		return '<div class="wi_val">' + balanc + '</div>';
	}
    ,_renderPctUp:function(v,md,rec) {
                total = rec.data.votes_up*1 + rec.data.votes_down*1;
                pctUp = total === 0 ? 0 : Math.round(rec.data.votes_up / total * 100) + '%';
		return '<div class="wi_val">' + pctUp + '</div>';
	}
    ,_renderPctDown:function(v,md,rec) {
                total = rec.data.votes_up*1 + rec.data.votes_down*1;
                pctDown = total === 0 ? 0 : Math.round(rec.data.votes_down / total * 100) + '%';
		return '<div class="wi_val">' + pctDown + '</div>';
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
    ,deleteLike: function(btn,e) {
        MODx.msg.confirm({            
            title: _('likedislike.likedislik_remove') 
            ,text: _('likedislike.likedislik_remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/likedislik/removelike' 
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success':{fn:this.refresh,scope:this}
            }
        });
    }
    ,onClick: function(e){
		var t = e.getTarget();
		var elm = t.className.split(' ')[0];
		if(elm == 'controlBtn') {
			var action = t.className.split(' ')[1];
			var record = this.getSelectionModel().getSelected();
                        this.menu.record = record;
			switch (action) {
                            case 'delete':
                                this.deleteLike();
                                break;
			    case 'publish':
				this.publishLike();
				break;
			    case 'unpublish':
				this.unpublishLike();
				break;
			    default:
				break;
            }
	}
    }
});
Ext.reg('likedislike-grid-likedislike',likeDislike.grid.likeDislike);


likeDislike.window.CreatelikeDislik = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('likedislike.likedislik_create')
        ,url: likeDislike.config.connectorUrl
        ,baseParams: {
            action: 'mgr/likedislik/create'
        }
        ,fields: [{
            xtype: 'textfield'
            ,fieldLabel: _('likedislike.name')
            ,name: 'name'
            ,anchor: '100%'
        },{
            xtype: 'textarea'
            ,fieldLabel: _('likedislike.description')
            ,name: 'description'
            ,anchor: '100%'
        }]
    });
    likeDislike.window.CreatelikeDislik.superclass.constructor.call(this,config);
};
Ext.extend(likeDislike.window.CreatelikeDislik,MODx.Window);
Ext.reg('likedislike-window-likedislik-create',likeDislike.window.CreatelikeDislik);


likeDislike.window.UpdatelikeDislik = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('likedislike.likedislik_update')
        ,url: likeDislike.config.connectorUrl
        ,baseParams: {
            action: 'mgr/likedislik/update'
        }
        ,fields: [{
            xtype: 'hidden'
            ,name: 'id'
        },{
            xtype: 'textfield'
            ,fieldLabel: _('likedislike.name')
            ,name: 'name'
            ,anchor: '100%'
        },{
            xtype: 'textarea'
            ,fieldLabel: _('likedislike.description')
            ,name: 'description'
            ,anchor: '100%'
        }]
    });
    likeDislike.window.UpdatelikeDislik.superclass.constructor.call(this,config);
};
Ext.extend(likeDislike.window.UpdatelikeDislik,MODx.Window);
Ext.reg('likedislike-window-likedislik-update',likeDislike.window.UpdatelikeDislik);
