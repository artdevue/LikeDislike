Ext.onReady(function() {
    MODx.load({ xtype: 'likedislike-page-home'});
});

likeDislike.page.Home = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        components: [{
            xtype: 'likedislike-panel-home'
            ,renderTo: 'likedislike-panel-home-div'
        }]
    });
    likeDislike.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(likeDislike.page.Home,MODx.Component);
Ext.reg('likedislike-page-home',likeDislike.page.Home);