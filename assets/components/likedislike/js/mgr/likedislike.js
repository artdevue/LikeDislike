var likeDislike = function(config) {
    config = config || {};
    likeDislike.superclass.constructor.call(this,config);
};
Ext.extend(likeDislike,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {}
});
Ext.reg('likedislike',likeDislike);

likeDislike = new likeDislike();