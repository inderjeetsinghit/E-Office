<?php

if ($_SESSION['username'] != NULL) {

    function blockty($ty) {
        if ($ty == "receipt") {
            if ($_SESSION['type'] == 'normal' || $_SESSION['type'] == 'admin') {
                echo '<h3>Receipt</h3>
            <ul class="toggle">
                <li class="icn_new_article"><a href="up_form.php">New Upload</a></li>
                <li class="icn_edit_article"><a href="browse.php">Browse Diaries</a></li>
                <li class="icn_folder"><a href="inbox.php">Inbox</a></li>
                <li class="icn_jump_back"><a href="outbox.php">Sent</a></li>
                <li class="icn_logout"><a href="closed.php">Closed</a></li>
            </ul>
            
            <h3>E-File</h3>
            <ul class="toggle">
                <li class="icn_folder"><a href="../efile/inbox.php">Inbox</a></li>
                <li class="icn_new_article"><a href="../efile/new.php">Create New</a></li>
                <li class="icn_jump_back"><a href="../efile/sent.php">Sent</a></li>
                <li class="icn_logout"><a href="../efile/closed.php">Closed</a></li>
            </ul>';
                if ($_SESSION['type'] == 'admin') {
                    echo ' <h3>Users</h3>
            <ul class="toggle">
                <li class="icn_add_user"><a href="../admin/newuser.php">Add New User</a></li>
                <li class="icn_view_users"><a href="../admin/viewuser.php">View Users</a></li>
                <li class="icn_profile"><a href="../admin/removeuser.php">Remove User</a></li>
                <li class="icn_settings"><a href="#">Options</a></li>
                <li class="icn_security"><a href="#">Security</a></li>
            </ul>';
                } elseif ($_SESSION['type'] == 'normal') {
                    echo '<h3>Users</h3>
            <ul class="toggle">
                <li class="icn_add_user"><strike>Add New User</strike></li>
                <li class="icn_view_users"><strike>View Users</strike></li>
                <li class="icn_profile"><strike>Remove User</strike></li>
                <li class="icn_settings"><strike>Options</strike></li>
                <li class="icn_security"><strike>Security</strike></li>';
                }
                echo '<h3>Other</h3>
            <ul class="toggle">
                
                <li class="icn_logout"><a href="../checklogin/logout.php?log=logout">Logout</a></li>
            </ul>';
            } elseif ($_SESSION['type'] == 'clerk') {
                echo '<h3>Receipt</h3>
            <ul class="toggle">
                <li class="icn_new_article"><a href="up_form.php">New Upload</a></li>
                <li class="icn_edit_article"><strike>Browse Diaries</strike></li>
                <li class="icn_folder"><strike>Inbox</strike></li>
                <li class="icn_jump_back"><strike>Sent</strike></li>
                <li class="icn_logout"><strike>Closed</strike></li>
            </ul>
            
            <h3>E-File</h3>
            <ul class="toggle">
                <li class="icn_folder"><strike>Inbox</strike></li>
                <li class="icn_new_article"><strike>Create New</strike></li>
                <li class="icn_jump_back"><strike>Sent</strike></li>
                <li class="icn_video"><strike>Closed</strike></li>
            </ul> <h3>Users</h3>
            <ul class="toggle">
                <li class="icn_add_user"><strike>Add New User</strike></li>
                <li class="icn_view_users"><strike>View Users</strike></li>
                <li class="icn_profile"><strike>Remove User</strike></li>
                <li class="icn_settings"><strike>Options</strike></li>
                <li class="icn_security"><strike>Security</strike></li>
            </ul><h3>Other</h3>
            <ul class="toggle">
                
                <li class="icn_jump_back"><a href="../checklogin/logout.php?log=logout">Logout</a></li>
            </ul>';
            }
        } elseif ($ty == 'file') {
            if ($_SESSION['type'] == 'normal' || $_SESSION['type'] == 'admin') {
                echo '<h3>Receipt</h3>
            <ul class="toggle">
                <li class="icn_new_article"><a href="../receipt/up_form.php">New Upload</a></li>
                <li class="icn_edit_article"><a href="../receipt/browse.php">Browse Diaries</a></li>
                <li class="icn_folder"><a href="../receipt/inbox.php">Inbox</a></li>
                <li class="icn_jump_back"><a href="../receipt/outbox.php">Sent</a></li>
                <li class="icn_logout"><a href="../receipt/closed.php">Closed</a></li>
            </ul>
            
            <h3>E-File</h3>
            <ul class="toggle">
                <li class="icn_folder"><a href="inbox.php">Inbox</a></li>
                <li class="icn_new_article"><a href="new.php">Create New</a></li>
                <li class="icn_jump_back"><a href="sent.php">Sent</a></li>
                <li class="icn_logout"><a href="closed.php">Closed</a></li>
            </ul>';
                if ($_SESSION['type'] == 'admin') {
                    echo ' <h3>Users</h3>
            <ul class="toggle">
                <li class="icn_add_user"><a href="../admin/newuser.php">Add New User</a></li>
                <li class="icn_view_users"><a href="../admin/viewuser.php">View Users</a></li>
                <li class="icn_profile"><a href="../admin/removeuser.php">Remove User</a></li>
                <li class="icn_settings"><a href="#">Options</a></li>
                <li class="icn_security"><a href="#">Security</a></li>
            </ul>';
                } elseif ($_SESSION['type'] == 'normal') {
                    echo '<h3>Users</h3>
            <ul class="toggle">
                <li class="icn_add_user"><strike>Add New User</strike></li>
                <li class="icn_view_users"><strike>View Users</strike></li>
                <li class="icn_profile"><strike>Remove User</strike></li>
                <li class="icn_settings"><strike>Options</strike></li>
                <li class="icn_security"><strike>Security</strike></li>';
                }
                echo '<h3>Other</h3>
            <ul class="toggle">
                
                <li class="icn_logout"><a href="../checklogin/logout.php?log=logout">Logout</a></li>
            </ul>';
            } elseif ($_SESSION['type'] == 'clerk') {
                echo '<h3>Receipt</h3>
            <ul class="toggle">
                <li class="icn_new_article"><a href="../receipt/up_form.php">New Upload</a></li>
                <li class="icn_edit_article"><strike>Browse Diaries</strike></li>
                <li class="icn_categories"><strike>Inbox</strike></li>
                <li class="icn_tags"><strike>Sent</strike></li>
                <li class="icn_tags"><strike>Closed</strike></li>
            </ul>
            
            <h3>E-File</h3>
            <ul class="toggle">
                <li class="icn_folder"><strike>Inbox</strike></li>
                <li class="icn_photo"><strike>Create New</strike></li>
                <li class="icn_audio"><strike>Sent</strike></li>
                <li class="icn_video"><strike>Closed</strike></li>
            </ul> <h3>Users</h3>
            <ul class="toggle">
                <li class="icn_add_user"><strike>Add New User</strike></li>
                <li class="icn_view_users"><strike>View Users</strike></li>
                <li class="icn_profile"><strike>Remove User</strike></li>
                <li class="icn_settings"><strike>Options</strike></li>
                <li class="icn_security"><strike>Security</strike></li>
            </ul><h3>Other</h3>
            <ul class="toggle">
                
                <li class="icn_logout"><a href="../checklogin/logout.php?log=logout">Logout</a></li>
            </ul>';
            }
        } elseif ($ty == 'admin') {
            echo '<h3>Receipt</h3>
            <ul class="toggle">
                <li class="icn_new_article"><a href="../receipt/up_form.php">New Upload</a></li>
                <li class="icn_edit_article"><a href="../receipt/browse.php">Browse Diaries</a></li>
                <li class="icn_folder"><a href="../receipt/inbox.php">Inbox</a></li>
                <li class="icn_jump_back"><a href="../receipt/outbox.php">Sent</a></li>
                <li class="icn_logout"><a href="../receipt/closed.php">Closed</a></li>
            </ul>
            
            <h3>E-File</h3>
            <ul class="toggle">
                <li class="icn_folder"><a href="../efile/inbox.php">Inbox</a></li>
                <li class="icn_new_article"><a href="../efile/new.php">Create New</a></li>
                <li class="icn_jump_back"><a href="../efile/sent.php">Sent</a></li>
                <li class="icn_logout"><a href="../efile/closed.php">Closed</a></li>
            </ul> <h3>Users</h3>
            <ul class="toggle">
                <li class="icn_add_user"><a href="newuser.php">Add New User</a></li>
                <li class="icn_view_users"><a href="viewuser.php">View Users</a></li>
                <li class="icn_profile"><a href="removeuser.php">Remove User</a></li>
                <li class="icn_settings"><a href="#">Options</a></li>
                <li class="icn_security"><a href="#">Security</a></li>
            </ul><h3>Other</h3>
            <ul class="toggle">
                
                <li class="icn_logout"><a href="../checklogin/logout.php?log=logout">Logout</a></li>
            </ul>';
        }
    }

}
else{
    echo 'Permission Denied';
}
?>
