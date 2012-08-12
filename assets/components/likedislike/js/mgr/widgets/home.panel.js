var tokenDelimiter = ':';
//console.log(window.location.hash);
var acTab = 0;
var token = window.location.hash.substr(1);
if(token){
    var parts = token.split(tokenDelimiter);
    var tabPanel = Ext.getCmp(parts[0]);
    var tabId = parts[1];
    acTab = tabId;
}

likeDislike.panel.Home = function(config) {	
    config = config || {};   
     Ext.apply(config,{
        cls: 'container'
		,renderTo: Ext.getBody()
		,unstyled: true
		,defaults: { collapsible: false ,autoHeight: true }
		,id: 'panelHome'
        ,items: [{
            html: '<h2> &nbsp;</h2>'
            ,border: false
            ,cls: 'modx-page-header head-logo'
        },{
            xtype: 'modx-vtabs'
	    ,activeTab: 0
	    ,autoWidth: true
	    ,resizable: true
	    ,monitorResize:true
	    ,deferredRender: false
	    ,cls: 'x-panel-bwrap'
            ,bodyStyle: 'padding: 10px'
	    ,id: 'homeTab'
	    ,enableTabScroll : true
	    ,activeTab: acTab
            ,defaults: {
                bodyCssClass: 'vertical-tabs tabs-likedislike'
		,autoScroll: true
		,autoHeight: true
		,autoWidth: true
		,layout: 'form'
	    }			
            ,items: [{
                title: _('likedislike.home')
		,id: 'home'
                ,defaults: { autoHeight: true }
                ,items: [{
                    html: '<p>'+ _('likedislike.management_desc') +'</p>'
                    ,border: true
                    ,bodyCssClass: 'panel-desc'
                },{
                    xtype: 'likedislike-grid-likedislike'
                    ,preventRender: true
                }]
            },{
                title: _('likedislike.ip_block')
                ,cls: 'loc-manager'
                ,defaults: { autoHeight: true }
		,id: 'ip-blocking'
                ,items: [{
                    html: '<p>'+ _('likedislike.management_ip_desc') +'</p>'
                    ,border: true
                    ,bodyCssClass: 'panel-desc'
                },{
                    xtype: 'likedislike-grid-ipblock'
                    ,preventRender: true
                }]
            }],
	    listeners: {
            'tabchange': function(tabPanel, tab){
                    Ext.History.add(tabPanel.id + tokenDelimiter + tab.id); 
            }
        }
        }]
    });        
    likeDislike.panel.Home.superclass.constructor.call(this,config);	
};
Ext.extend(likeDislike.panel.Home,MODx.Panel);
Ext.reg('likedislike-panel-home',likeDislike.panel.Home);


MODx.combo.category = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        name: 'category'
        ,hiddenName: 'category'
        ,displayField: 'category'
        ,valueField: 'category'
        ,editable: false
        ,fields: ['category','category']
        ,pageSize: 10
	,emptyText: _('likedislike.category_select')
        ,url: likeDislike.config.connectorUrl
		,baseParams: {
			action:  'mgr/likedislik/getcategories'
		}
    });
    MODx.combo.category.superclass.constructor.call(this,config);
};
Ext.extend(MODx.combo.category,MODx.combo.ComboBox);
Ext.reg('likedislike-filter-category',MODx.combo.category);
