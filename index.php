<?php

include('env.php');
include('route.php');

//====================Site Verification Routes====================
Route::add('/honeyweb-domain-verification',function(){
    echo "$2y$10$uyohYtWlS/h598L7/FRXl.I8L6tMlfEONA4GZOc2Gz4Skk21rFJZy";
});
//====================End of Site Verification Routes=============


//====================Guest Routes====================
Route::add('/',function()use($app_key){
    include($app_key.'/views/welcome.php');
});
//====================End of Guest Routes=============


//====================Authentication Routes====================
Route::add('/email_verified/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/auth/email_verified_id.php');
});
Route::add('/resend_verification_mail',function()use($app_key){
    include($app_key.'/controller/auth/resend_verification_mail.php');
},'post');
Route::add('/login_view',function()use($app_key){
    include($app_key.'/controller/auth/login_view.php');
});
Route::add('/login',function()use($app_key){
    include($app_key.'/controller/auth/login.php');
},'post');
Route::add('/register_view',function()use($app_key){
    include($app_key.'/controller/auth/register_view.php');
});
Route::add('/register',function()use($app_key){
    include($app_key.'/controller/auth/register.php');
},'post');
Route::add('/logout',function()use($app_key){
    include($app_key.'/controller/auth/logout.php');
},'post');
Route::add('/password_reset_request_view',function()use($app_key){
    include($app_key.'/controller/auth/password_reset_request_view.php');
});
Route::add('/password_email',function()use($app_key){
    include($app_key.'/controller/auth/password_email.php');
},'post');
Route::add('/password_reset/([a-zA-Z0-9_]*)',function($token)use($app_key){
    include($app_key.'/controller/auth/password_reset_view.php');
});
Route::add('/password_reset',function()use($app_key){
    include($app_key.'/controller/auth/password_reset.php');
},'post');
//====================Authentication Routes Ends====================


//====================User Routes====================
Route::add('/user/add_avatar',function()use($app_key){
    include($app_key.'/controller/user/add_avatar.php');
},'post');
Route::add('/user/invite_friend',function()use($app_key){
    include($app_key.'/controller/user/invite_friend.php');
},'post');
Route::add('/user/usage_report',function()use($app_key){
    include($app_key.'/controller/user/usage_report.php');
},'get');
Route::add('/user/recharge_offers',function()use($app_key){
    include($app_key.'/controller/user/recharge_offers.php');
},'get');
Route::add('/user/recharge',function()use($app_key){
    include($app_key.'/controller/user/recharge.php');
},'post');
Route::add('/user/payment_status',function()use($app_key){
    include($app_key.'/controller/user/payment_status.php');
},'post');
Route::add('/user/payment_status/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/user/payment_status_id.php');
},'get');
Route::add('/user/payment_refund/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/user/payment_refund_id.php');
},'get');
Route::add('/user/payment_refund_status/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/user/payment_refund_status_id.php');
},'get');
Route::add('/user/recharge_history',function()use($app_key){
    include($app_key.'/controller/user/recharge_history.php');
},'get');
//====================End of App Routes=============


//====================App Routes====================
Route::add('/app/new_app',function()use($app_key){
    include($app_key.'/controller/app/new_app.php');
},'post');
Route::add('/app/app_list',function()use($app_key){
    include($app_key.'/controller/app/app_list.php');
},'get');
Route::add('/app/invited_app_list',function()use($app_key){
    include($app_key.'/controller/app/invited_app_list.php');
},'get');
Route::add('/app/public_app_list',function()use($app_key){
    include($app_key.'/controller/app/public_app_list.php');
},'get');
Route::add('/app/app_description/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/app/app_description_id.php');
},'get');
Route::add('/app/copy_app',function()use($app_key){
    include($app_key.'/controller/app/copy_app.php');
},'post');
Route::add('/app/delete_app',function()use($app_key){
    include($app_key.'/controller/app/delete_app.php');
},'delete');
Route::add('/app/save_app_description',function()use($app_key){
    include($app_key.'/controller/app/save_app_description.php');
},'post');
Route::add('/app/app_user_name_fields/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/app/app_user_name_fields_id.php');
},'get');
Route::add('/app/save_user_name_fields',function()use($app_key){
    include($app_key.'/controller/app/save_user_name_fields.php');
},'post');
Route::add('/app/app_origins/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/app/app_origins_id.php');
},'get');
Route::add('/app/new_origin/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/app/new_origin_id.php');
},'post');
Route::add('/app/delete_origin/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/app/delete_origin_id.php');
},'delete');
Route::add('/app/invited_users/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/app/invited_users_id.php');
},'get');
Route::add('/app/new_invited_user',function()use($app_key){
    include($app_key.'/controller/app/new_invited_user.php');
},'post');
Route::add('/app/delete_invited_user',function()use($app_key){
    include($app_key.'/controller/app/delete_invited_user.php');
},'delete');
Route::add('/app/activate',function()use($app_key){
    include($app_key.'/controller/app/activate.php');
},'post');
Route::add('/app/update',function()use($app_key){
    include($app_key.'/controller/app/update.php');
},'post');
Route::add('/app/delete',function()use($app_key){
    include($app_key.'/controller/app/delete.php');
},'delete');
Route::add('/app/sql/{id?}',function()use($app_key){
    include($app_key.'/controller/app/sql/{id?}.php');
},'get');
Route::add('/app/csv',function()use($app_key){
    include($app_key.'/controller/app/csv.php');
},'get');
Route::add('/app/log_view',function()use($app_key){
    include($app_key.'/controller/app/log_view.php');
},'get');
//====================End of App Routes=============




//====================License Routes====================
Route::add('/license/new_license',function()use($app_key){
    include($app_key.'/controller/license/new_license.php');
},'post');
Route::add('/license/license_list',function()use($app_key){
    include($app_key.'/controller/license/license_list.php');
},'get');
Route::add('/license/license_details/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/license/license_details_id.php');
},'get');
Route::add('/license/test_bench',function()use($app_key){
    include($app_key.'/controller/license/test_bench.php');
},'get');
Route::add('/license/update/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/license/update_id.php');
},'post');
Route::add('/license/delete/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/license/delete_id.php');
},'post');
//====================End of License Routes=============



//====================Table Routes====================
Route::add('/table/table_list',function()use($app_key){
    include($app_key.'/controller/table/table_list.php');
},'get');
Route::add('/table/new_table_view',function()use($app_key){
    include($app_key.'/controller/table/new_table_view.php');
},'get');
Route::add('/table/new_table',function()use($app_key){
    include($app_key.'/controller/table/new_table.php');
},'post');
Route::add('/table/add_columns_view',function()use($app_key){
    include($app_key.'/controller/table/add_columns_view.php');
},'get');
Route::add('/table/add_columns',function()use($app_key){
    include($app_key.'/controller/table/add_columns.php');
},'post');
Route::add('/table/get_columns',function()use($app_key){
    include($app_key.'/controller/table/get_columns.php');
},'get');
Route::add('/table/rename_column',function()use($app_key){
    include($app_key.'/controller/table/rename_column.php');
},'post');
Route::add('/table/delete_column',function()use($app_key){
    include($app_key.'/controller/table/delete_column.php');
},'post');
Route::add('/table/add_index',function()use($app_key){
    include($app_key.'/controller/table/add_index.php');
},'post');
Route::add('/table/remove_index',function()use($app_key){
    include($app_key.'/controller/table/remove_index.php');
},'post');
Route::add('/table/crud_view',function()use($app_key){
    include($app_key.'/controller/table/crud_view.php');
},'get');
Route::add('/table/add_record_view',function()use($app_key){
    include($app_key.'/controller/table/add_record_view.php');
},'get');
Route::add('/table/add_record',function()use($app_key){
    include($app_key.'/controller/table/add_record.php');
},'post');
Route::add('/table/edit_record_view',function()use($app_key){
    include($app_key.'/controller/table/edit_record_view.php');
},'get');
Route::add('/table/edit_record',function()use($app_key){
    include($app_key.'/controller/table/edit_record.php');
},'post');
Route::add('/table/delete_record',function()use($app_key){
    include($app_key.'/controller/table/delete_record.php');
},'delete');
Route::add('/table/rename',function()use($app_key){
    include($app_key.'/controller/table/rename.php');
},'post');
Route::add('/table/truncate',function()use($app_key){
    include($app_key.'/controller/table/truncate.php');
},'post');
Route::add('/table/delete',function()use($app_key){
    include($app_key.'/controller/table/delete.php');
},'post');
//====================End of Table Routes=============



//====================Query Routes====================
Route::add('/query/query_list',function()use($app_key){
    include($app_key.'/controller/query/query_list.php');
},'get');
Route::add('/query/new_query_view',function()use($app_key){
    include($app_key.'/controller/query/new_query_view.php');
},'get');
Route::add('/query/get_all_columns',function()use($app_key){
    include($app_key.'/controller/query/get_all_columns.php');
},'get');
Route::add('/query/new_query',function()use($app_key){
    include($app_key.'/controller/query/new_query.php');
},'post');
Route::add('/query/query_details/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/query/query_details_id.php');
},'get');
Route::add('/query/update/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/query/update_id.php');
},'put');
Route::add('/query/delete',function()use($app_key){
    include($app_key.'/controller/query/delete.php');
},'delete');
Route::add('/query/custom_valid_msg_view',function()use($app_key){
    include($app_key.'/controller/query/custom_valid_msg_view.php');
},'get');
Route::add('/query/custom_valid_msg_submit',function()use($app_key){
    include($app_key.'/controller/query/custom_valid_msg_submit.php');
},'post');
Route::add('/query/custom_valid_view',function()use($app_key){
    include($app_key.'/controller/query/custom_valid_view.php');
},'get');
Route::add('/query/custom_valid_submit',function()use($app_key){
    include($app_key.'/controller/query/custom_valid_submit.php');
},'post');
Route::add('/query/custom_valid_delete',function()use($app_key){
    include($app_key.'/controller/query/custom_valid_delete.php');
},'delete');
//====================End of Query Routes=============



//====================Files Routes====================
Route::add('/files/csv_export/([a-zA-Z0-9_]*)',function($table)use($app_key){
    include($app_key.'/controller/files/csv_export_table.php');
},'get');
Route::add('/files/txt_export/([a-zA-Z0-9_]*)',function($table)use($app_key){
    include($app_key.'/controller/files/txt_export_table.php');
},'get');
Route::add('/files/json_export/([a-zA-Z0-9_]*)',function($table)use($app_key){
    include($app_key.'/controller/files/json_export_table.php');
},'get');
Route::add('/files/csv_import_create',function()use($app_key){
    include($app_key.'/controller/files/csv_import_create.php');
},'post');
Route::add('/files/csv_import_update',function()use($app_key){
    include($app_key.'/controller/files/csv_import_update.php');
},'post');
Route::add('/files/json_import_create',function()use($app_key){
    include($app_key.'/controller/files/json_import_create.php');
},'post');
Route::add('/files/json_import_update',function()use($app_key){
    include($app_key.'/controller/files/json_import_update.php');
},'post');
Route::add('/files/files_view',function()use($app_key){
    include($app_key.'/controller/files/files_view.php');
},'get');
Route::add('/files/upload_files',function()use($app_key){
    include($app_key.'/controller/files/upload_files.php');
},'post');
Route::add('/files/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/files/id}.php');
},'get');
Route::add('/files/replace_file',function()use($app_key){
    include($app_key.'/controller/files/replace_file.php');
},'post');
Route::add('/files/delete_file',function()use($app_key){
    include($app_key.'/controller/files/delete_file.php');
},'post');
//====================End of Files Routes=============



//====================Email Routes====================
Route::add('/email/email_users_list',function()use($app_key){
    include($app_key.'/controller/email/email_users_list.php');
},'get');
Route::add('/email/domain_list',function()use($app_key){
    include($app_key.'/controller/email/domain_list.php');
},'get');
Route::add('/email/domain_new',function()use($app_key){
    include($app_key.'/controller/email/domain_new.php');
},'post');
Route::add('/email/domain_verify/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/email/domain_verify_id.php');
},'get');
Route::add('/email/domain_delete',function()use($app_key){
    include($app_key.'/controller/email/domain_delete.php');
},'delete');
Route::add('/email/alias_list',function()use($app_key){
    include($app_key.'/controller/email/alias_list.php');
},'get');
Route::add('/email/alias_new',function()use($app_key){
    include($app_key.'/controller/email/alias_new.php');
},'post');
Route::add('/email/alias_verify',function()use($app_key){
    include($app_key.'/controller/email/alias_verify.php');
},'post');
Route::add('/email/alias_delete',function()use($app_key){
    include($app_key.'/controller/email/alias_delete.php');
},'delete');
Route::add('/email/mail_list',function()use($app_key){
    include($app_key.'/controller/email/mail_list.php');
},'get');
Route::add('/email/new_mail_view',function()use($app_key){
    include($app_key.'/controller/email/new_mail_view.php');
},'get');
Route::add('/email/update_mail_view/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/email/update_mail_view_id.php');
},'get');
Route::add('/email/mail_new',function()use($app_key){
    include($app_key.'/controller/email/mail_new.php');
},'post');
Route::add('/email/mail_send',function()use($app_key){
    include($app_key.'/controller/email/mail_send.php');
},'post');
Route::add('/email/mail_update',function()use($app_key){
    include($app_key.'/controller/email/mail_update.php');
},'put');
Route::add('/email/mail_copy',function()use($app_key){
    include($app_key.'/controller/email/mail_copy.php');
},'post');
Route::add('/email/mail_delete',function()use($app_key){
    include($app_key.'/controller/email/mail_delete.php');
},'delete');
Route::add('/email/create_email_account_view',function()use($app_key){
    include($app_key.'/controller/email/create_email_account_view.php');
},'get');
Route::add('/email/new_email_account',function()use($app_key){
    include($app_key.'/controller/email/new_email_account.php');
},'post');
Route::add('/email/delete',function()use($app_key){
    include($app_key.'/controller/email/delete.php');
},'delete');
Route::add('/email/get_txt',function()use($app_key){
    include($app_key.'/controller/email/get_txt.php');
},'post');
Route::add('/email/get_page',function()use($app_key){
    include($app_key.'/controller/email/get_page.php');
},'post');
//====================End of Email Routes=============


//====================Push Notification Routes====================
Route::add('/push/save_subscription',function()use($app_key){
    include($app_key.'/controller/push/save_subscription.php');
},'post');
Route::add('/push/messages',function()use($app_key){
    include($app_key.'/controller/push/messages.php');
},'get');
Route::add('/push/new_message',function()use($app_key){
    include($app_key.'/controller/push/new_message.php');
},'get');
Route::add('/push/new_message_submit',function()use($app_key){
    include($app_key.'/controller/push/new_message_submit.php');
},'post');
Route::add('/push/update_message/{id}',function()use($app_key){
    include($app_key.'/controller/push/update_message/{id}.php');
},'get');
Route::add('/push/update_message_submit',function()use($app_key){
    include($app_key.'/controller/push/update_message_submit.php');
},'put');
Route::add('/push/copy_message',function()use($app_key){
    include($app_key.'/controller/push/copy_message.php');
},'post');
Route::add('/push/delete_message',function()use($app_key){
    include($app_key.'/controller/push/delete_message.php');
},'post');
Route::add('/push/broadcast/([0-9]*)',function($id)use($app_key){
    include($app_key.'/controller/push/broadcast_id.php');
},'get');
Route::add('/push/push_subscriptions',function()use($app_key){
    include($app_key.'/controller/push/push_subscriptions.php');
},'get');
//====================End of Push Notification Routes=============


//====================Chat Routes====================
Route::add('/chat/messages_view',function()use($app_key){
    include($app_key.'/controller/chat/messages_view.php');
},'get');
Route::add('/chat/requests_view',function()use($app_key){
    include($app_key.'/controller/chat/requests_view.php');
},'get');
Route::add('/chat/update_message',function()use($app_key){
    include($app_key.'/controller/chat/update_message.php');
},'put');
Route::add('/chat/delete_message',function()use($app_key){
    include($app_key.'/controller/chat/delete_message.php');
},'delete');
Route::add('/chat/can_chat_with_view',function()use($app_key){
    include($app_key.'/controller/chat/can_chat_with_view.php');
},'get');
Route::add('/chat/can_chat_with',function()use($app_key){
    include($app_key.'/controller/chat/can_chat_with.php');
},'put');
Route::add('/chat/customer_care_app_config_view',function()use($app_key){
    include($app_key.'/controller/chat/customer_care_app_config_view.php');
},'get');
Route::add('/chat/cc_app_config',function()use($app_key){
    include($app_key.'/controller/chat/cc_app_config.php');
},'put');
Route::add('/chat/chat_page',function()use($app_key){
    include($app_key.'/controller/chat/chat_page.php');
},'get');
Route::add('/chat/request_token',function()use($app_key){
    include($app_key.'/controller/chat/request_token.php');
},'post');
Route::add('/chat/save_resource_id',function()use($app_key){
    include($app_key.'/controller/chat/save_resource_id.php');
},'put');
Route::add('/chat/my_chats',function()use($app_key){
    include($app_key.'/controller/chat/my_chats.php');
},'post');
Route::add('/chat/messages',function()use($app_key){
    include($app_key.'/controller/chat/messages.php');
},'post');
Route::add('/chat/start_chat',function()use($app_key){
    include($app_key.'/controller/chat/start_chat.php');
},'post');
Route::add('/chat/waiting_chats',function()use($app_key){
    include($app_key.'/controller/chat/waiting_chats.php');
},'post');
Route::add('/chat/delete_chat_request',function()use($app_key){
    include($app_key.'/controller/chat/delete_chat_request.php');
},'delete');
Route::add('/chat/pick_chat',function()use($app_key){
    include($app_key.'/controller/chat/pick_chat.php');
},'put');
Route::add('/chat/save_message',function()use($app_key){
    include($app_key.'/controller/chat/save_message.php');
},'post');
Route::add('/chat/message_status',function()use($app_key){
    include($app_key.'/controller/chat/message_status.php');
},'put');
//====================End of Chat Routes=============




Route::pathNotFound(function($path){
    include('env.php');
    include($app_key.'/404.php');
});

Route::methodNotAllowed(function($path, $method){
    echo 'Method not allowed - 405 error';
});

Route::run('/');
