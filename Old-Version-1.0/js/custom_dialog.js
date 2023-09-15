BootstrapDialog.confirm = function( title, message, callback ) {

    var dialog = new BootstrapDialog({
        title: title,
        message: message,
        closable: false,
        //closable: true,
        data: {
            'callback': callback
        },
        buttons: [
            {
                label: 'Cancel',
                cssClass: 'btn-dialog-blue',
                action: function(dialog){
                    typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
                    dialog.close();
                }
            },
            {
                label: 'Delete',
                cssClass: 'btn-dialog-yellow',
                action: function(dialog){
                    typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
                    dialog.close();
                }
            }
        ]
    });

    dialog.realize();
    dialog.getModalHeader().hide();
    dialog.open();
}