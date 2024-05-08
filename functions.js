login_div               = document.getElementById('login_div');
register_div            = document.getElementById('register_div');
add_user_div            = document.getElementById('add_user_div');
upload_csv_div          = document.getElementById('upload_csv_div');
confirm_delete_all_div  = document.getElementById('confirm_delete_all_div');


function displayLogin() {
    login_div.style.display = "grid";
}
function hideLogin() {
    login_div.style.display = "none";
}


function displayRegister() {
    hideLogin();
    register_div.style.display = "grid";
}
function hideRegister() {
    register_div.style.display = "none";
    displayLogin();
}


function displayAddUsers() {
    add_user_div.style.display = "grid";
}
function hideAddUsers() {
    add_user_div.style.display = "none";
}


function displayEditUsers(id) {
    document.getElementById('edit_user_div_' + id).style.display = "grid";
}
function hideEditUsers(id) {
    document.getElementById('edit_user_div_' + id).style.display = "none";
}


function displayUploadCSV() {
    upload_csv_div.style.display = "grid";
}
function hideUploadCSV() {
    upload_csv_div.style.display = "none";
}


function displayConfirmDeleteAll() {
    confirm_delete_all_div.style.display = "grid";
}
function hideConfirmDeleteAll() {
    confirm_delete_all_div.style.display = "none";
}



function showEditUserError() {
    if (document.getElementById('edit_user_div_' + id) != null) {
        displayAddUsers();
    }
}
function showLoginError() {
    if (document.getElementById('login_error') != null) {
        displayLogin();
    }
}
function showRegisterError() {
    if (document.getElementById('register_error') != null) {
        displayRegister();
    }
}
function showAddUserError() {
    if (document.getElementById('add_user_error') != null) {
        displayAddUsers();
    }
}