BootstrapDialog.confirm = function( title, message, callback ) {
    new BootstrapDialog({
        title: title,
        message: message,
        closable: false,
        data: {
            'callback': callback
        },
        buttons: [{
            label: 'Yes',
            action: function(dialog){
                typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
                dialog.close();
            }
        }, {
            label: 'No',
            action: function(dialog){
                typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
                dialog.close();
            }
        }]
    }).open();
}