// ---------------------------------------------------------------------------
// -------------------                                   ---------------------
// -------------------           CREATE TASKS            ---------------------
// -------------------                                   ---------------------
// ---------------------------------------------------------------------------


function createTasks(data, category, priority) {
    $.each(data, function (_, elem) {
        if ((category == undefined && priority == undefined) || (category == undefined && priority == elem['importanceId']) || (category == elem['categoryId'] && priority == undefined) || (category == elem['categoryId'] && priority == elem['importanceId'])) {

            const mainItemWrap = document.createElement("div");
            mainItemWrap.className = "main-wrap";
            mainItemWrap.setAttribute('id', elem['id']);

            const mainItem = document.createElement("div");
            mainItem.className = "main__item";
            mainItemWrap.appendChild(mainItem);

            const checkbox = document.createElement("input");
            checkbox.type = 'checkbox';
            checkbox.className = 'checkbox_task';
            if (elem['done'] == "1") {
                checkbox.setAttribute('checked', '');
            }
            checkbox.setAttribute('id', elem['id']);

            checkbox.addEventListener('change', setDone);

            mainItemWrap.insertAdjacentElement('afterbegin', checkbox);

            const taskLeft = document.createElement("div");
            taskLeft.className = "task__left";
            taskLeft.setAttribute('id', elem['id']);

            const taskTitle = document.createElement("div");
            taskTitle.className = "task__title";
            taskTitle.innerText = elem['title'];
            taskTitle.setAttribute('id', elem['id']);
            taskLeft.appendChild(taskTitle);

            const taskEdit = document.createElement("input");
            taskEdit.style.display = "none";
            taskEdit.setAttribute('class', 'task__edit input_text');
            taskEdit.setAttribute('id', elem['id']);
            taskLeft.appendChild(taskEdit);

            const taskSettings = document.createElement("div");
            taskSettings.className = "task__settings";
            taskSettings.setAttribute('id', elem['id']);
            taskLeft.appendChild(taskSettings);

            const btnEdit = document.createElement("div");
            btnEdit.className = "btn__edit";
            btnEdit.setAttribute('id', elem['id']);

            const imgEdit = document.createElement("img");
            imgEdit.src = '/img/icons/edit.svg';

            btnEdit.appendChild(imgEdit);

            const btnSave = document.createElement("div");
            btnSave.className = "btn__save";
            btnSave.setAttribute('id', elem['id']);
            btnSave.style.display = 'none';

            const imgSave = document.createElement("img");
            imgSave.src = '/img/done.svg';

            btnSave.appendChild(imgSave);


            const btnDelete = document.createElement("div");
            btnDelete.className = "btn__delete";
            btnDelete.setAttribute('id', elem['id']);

            const imgDelete = document.createElement("img");
            imgDelete.src = '/img/icons/delete.svg';

            btnDelete.appendChild(imgDelete);

            taskSettings.appendChild(btnSave);
            taskSettings.appendChild(btnEdit);
            taskSettings.appendChild(btnDelete);

            btnDelete.addEventListener('click', deleteTask);
            btnEdit.addEventListener('click', editTask);
            btnSave.addEventListener('click', saveTask);


            const taskLabels = document.createElement("div");
            taskLabels.className = "task__labels";

            const labelCategory = document.createElement("div");
            labelCategory.className = "label__category";
            labelCategory.innerText = elem['category'];

            taskLabels.appendChild(labelCategory);

            const labelPriority = document.createElement("div");
            labelPriority.classList.add("label__priority", "priority-" + elem['importanceId']);
            labelPriority.innerText = elem['importance'];

            taskLabels.appendChild(labelPriority);

            mainItem.appendChild(taskLeft);
            mainItem.appendChild(taskLabels);
            document.getElementById("allItems").appendChild(mainItemWrap);
        }
    });
}


// ---------------------------------------------------------------------------
// -------------------                                   ---------------------
// -------------------          DOCUMENT ONLOAD          ---------------------
// -------------------                                   ---------------------
// ---------------------------------------------------------------------------

if ((window.location.href).includes('home.php')) {
    document.querySelector("#curr_tab").style.background = '#ff4c13';

    document.onload = $.get('/include/get_tasks.php?userid=' + document.getElementById("userid").innerText, function (data) {

        localStorage.setItem("userTasks", JSON.stringify(data));
        createTasks(data);

        document.querySelectorAll('.task__left').forEach(item => {
            item.addEventListener('mouseleave', removeStylesBtns)
        });
    });

} else if ((window.location.href).includes('completed.php')) {
    document.querySelector("#compl_tab").style.background = '#ff4c13';

    document.onload = $.get('/include/get_tasks_done.php?userid=' + document.getElementById("userid").innerText, function (data) {

        localStorage.setItem("userTasks", JSON.stringify(data));
        createTasks(data);

    });
} else if((window.location.href).includes('busket.php')) {
    document.querySelector("#busk_tab").style.background = '#ff4c13';

    document.onload = $.get('/include/get_tasks.php?userid=' + document.getElementById("userid").innerText + '&deleted', function (data) {

        localStorage.setItem("userTasks", JSON.stringify(data));
        createTasks(data);

    });
}


// ---------------------------------------------------------------------------
// ---------------                                          ------------------
// ---------------      CREATE VARIABLES FOR LISTENER       ------------------
// ---------------                                          ------------------
// ---------------------------------------------------------------------------

let newTask = document.getElementById('newTask');
let taskField = document.getElementById('taskField');
let taskInput = document.getElementById('taskInput');
let btnCancel = document.getElementById('btnCancel');
let btnAdd = document.getElementById('submit_form');
let body = document.getElementById('body');
let mainTitle = document.getElementById('mainTitle');
let addWrap = document.getElementById('addWrap');
let categoryHide = document.getElementById('category_hide');
let priorityHide = document.getElementById('priority_hide');
let categoryFilter = document.getElementById('normal-select-1');
let priorityFilter = document.getElementById('normal-select-2');

let userInfo = document.getElementById('btnUserInfo');
let btnDeleteAll = document.getElementById('btnDeleteAll');

let btnEditProfile = document.querySelector(".btn_edit_profile");
let btnSaveProfile = document.querySelector("#btnSaveProfile");
let panelUser = document.querySelector("#panelUser");


if (newTask) {
    newTask.addEventListener('click', openField);
}
if (taskInput) {
    taskInput.addEventListener('input', btnDisable);
}
if (btnCancel) {
    btnCancel.addEventListener('click', closeField);
}
if (categoryHide) {
    categoryHide.addEventListener("click", btnDisable);
}
if (priorityHide) {
    priorityHide.addEventListener("click", btnDisable);
}
if (categoryFilter) {
    categoryFilter.addEventListener("change", sortBy);
}
if (priorityFilter) {
    priorityFilter.addEventListener("change", sortBy);
}
if (btnEditProfile) {
    btnEditProfile.addEventListener("click", showEditFields);
}

userInfo.addEventListener('click', function () {
    let panelInfo = document.querySelector('.panel__user-info');

    if (panelInfo.style.display == 'block') {
        panelInfo.style.display = 'none';
    } else {
        panelInfo.style.display = 'block';
    }
});

if (btnDeleteAll) {
    btnDeleteAll.addEventListener('click', deleteAll);
}

if (btnSaveProfile) {
    btnSaveProfile.addEventListener('click', updateProfile);
}

if (panelUser && userInfo.style.display == '' && $(window).width() < 750) {
    panelUser.addEventListener('click', function () {
        let panelInfo = document.querySelector('.panel__user-info');
        let userPanel = document.querySelector('.panel__user');
        let panel = document.querySelector('.panel');
        let main = document.querySelector('.main');

        if (panelInfo.style.display == 'block') {
            panelInfo.style.display = 'none';
            panel.style.height = 'fit-content';
            main.style.marginTop = '18%';
        } else {
            panelInfo.style.display = 'block';
            panel.style.height = '168px';
            main.style.marginTop = '27%';


        }
    });
}

// ---------------------------------------------------------------------------
// -------------------                                   ---------------------
// -------------------         CREATE FUNCTIONS          ---------------------
// -------------------                                   ---------------------
// ---------------------------------------------------------------------------


function showEditFields() {
    document.querySelector(".block_name_edit").style.display = "block";
    document.querySelector(".field_block_name").style.display = "none";
}

function deleteAll() {
    $.get("/include/delete_tasks.php?&userid=" + document.getElementById("userid").innerText, function () {
        document.querySelectorAll(".main-wrap").forEach(element => element.remove());
    });
}

function setStyle(selector, displayStyle) {
    document.querySelector(selector).style.display = displayStyle;
}


function updateProfile() {
    let userId = document.getElementById("userid").innerText;
    let name = document.getElementById("inputName").value;
    let surName = document.getElementById("inputSurName").value;

    $.get("/include/update_profile.php?id=" + userId + "&first_name=" + name + "&last_name=" + surName, function () {
        document.querySelector('.block_name').innerText = name + ' ' + surName;
        document.querySelector(".user_name").innerText = name;
        document.querySelector(".block_name_edit").style.display = "none";
        document.querySelector(".field_block_name").style.display = "flex";
    });
}


function saveTask() {
    let id = this.getAttribute("id");

    let titleValue = document.querySelector(".task__edit[id='" + id + "']").value;
    $.get("/include/update_task.php?id=" + id + "&title='" + titleValue + "'" + "&userid=" + document.getElementById("userid").innerText, function () {
        document.querySelector(".task__title[id='" + id + "']").innerHTML = titleValue;
    });

    setStyle(".task__title[id='" + id + "']", "flex");
    setStyle(".task__edit[id='" + id + "']", "none");
    setStyle(".btn__save[id='" + id + "']", "none");
    setStyle(".btn__edit[id='" + id + "']", "flex");

    document.querySelector(".task__settings[id='" + id + "']").style.width = "70px";
}

function deleteTask() {
    let id = this.getAttribute("id");

    $.get("/include/update_task.php?id=" + id + "&userid=" + document.getElementById("userid").innerText + "&deleted=1", function () {
        setTimeout(() => document.querySelector(".main-wrap[id='" + id + "']").style.opacity = '50%', 300),
            setTimeout(() => document.querySelector(".main-wrap[id='" + id + "']").remove(), 700)
    });
}

function setDone() {
    let id = this.getAttribute("id");
    $.get("/include/update_task.php?id=" + id + "&done=" + this.checked + "&userid=" + document.getElementById("userid").innerText, function () {
        setTimeout(() => document.querySelector(".main-wrap[id='" + id + "']").style.opacity = '50%', 300),
            setTimeout(() => document.querySelector(".main-wrap[id='" + id + "']").style.display = 'none', 700)
    });
}

function removeStylesBtns() {
    let id = this.getAttribute("id");

    setStyle(".task__title[id='" + id + "']", "flex");
    setStyle(".task__edit[id='" + id + "']", "none");
    setStyle(".btn__edit[id='" + id + "']", "flex");
    setStyle(".btn__save[id='" + id + "']", "none");

    document.querySelector(".task__settings[id='" + id + "']").style.width = "70px";
}

function editTask() {
    let id = this.getAttribute("id");

    setStyle(".task__title[id='" + id + "']", "none");
    setStyle(".task__edit[id='" + id + "']", "flex");
    setStyle(".btn__edit[id='" + id + "']", "none");
    setStyle(".btn__save[id='" + id + "']", "flex");

    document.querySelector(".btn__save[id='" + id + "']").style.marginRight = "20px";

    let taskTitle = document.querySelector(".task__title[id='" + id + "']");
    let taskEdit = document.querySelector(".task__edit[id='" + id + "']");

    document.querySelector(".task__settings[id='" + id + "']").style.width = "15%";

    taskEdit.value = taskTitle.textContent;
}


function openField() {
    taskField.style.display = 'block';
    taskInput.focus();
    body.style.filter = 'brightness(50%)';
    btnDisable();
}

function closeField() {
    taskField.style.display = 'none';
    newTask.style.display = 'block';
    body.style.filter = 'brightness(100%)';
}


function sortBy() {
    let categoryValue = document.querySelector("#normal-select-1").value;
    let priorityValue = document.querySelector("#normal-select-2").value;

    if (categoryValue == "undefined") {
        categoryValue = undefined;
    }
    if (priorityValue == "undefined") {
        priorityValue = undefined;
    }

    document.querySelector("#allItems").innerHTML = '';

    const data = localStorage.getItem("userTasks");
    createTasks(JSON.parse(data), categoryValue, priorityValue);
}

function btnDisable() {
    if (taskInput.value == "" || document.querySelector("#category_hide").value == 'hide' ||
        document.querySelector("#priority_hide").value == 'hide') {
        document.getElementById('submit_form').classList.add("btnDisabled");
        btnAdd.disabled = 'true';
        addWrap.classList.remove("add_wrap");
    } else {
        btnAdd.disabled = '';
        btnAdd.classList.remove("btnDisabled");
        addWrap.classList.add("add_wrap");
    }
}


// ------------------------------------------------------------------
// ------------------------------------------------------------------


function uploadFile() {
    resUpload = "";

    var files = document.getElementById("avatarUpload").files;

    if (files.length > 0) {

        var formData = new FormData();
        formData.append("upload_image", files[0]);
        formData.append("userid", document.getElementById("userid").innerText)

        var xhttp = new XMLHttpRequest();

        // Set POST method and ajax file path
        xhttp.open("POST", "/include/add_img.php", true);

        // call on request changes state
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                var response = this.responseText;
                if (response != 1) {
                    resUpload = "File not uploaded.";
                }
            }
        };
        xhttp.send(formData);

    } else {
        resUpload = "Please select a file";
    }
    return resUpload;
}



$(function () {
    if (
        window.createObjectURL || window.URL || window.webkitURL || window.FileReader) {
        $('.browser').hide()
        $('.preview').children().show()
    }

    function isDataURL(s) {
        return !!s.match(isDataURL.regex);
    }
    isDataURL.regex = /^\s*data:([a-z]+\/[a-z]+(;[a-z\-]+\=[a-z\-]+)?)?(;base64)?,[a-z0-9\!\$\&\'\,\(\)\*\+\,\;\=\-\.\_\~\:\@\/\?\%\s]*\s*$/i;

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var preview = $(input).data('preview');
            var _invalid = $(input).parent().parent().find('.invalid-file')

            reader.onload = function (e) {

                if (isDataURL(e.target.result)) {
                    resUpload = uploadFile();
                    if (resUpload != "") {
                        $('#' + preview).hide()
                        _invalid.html('<div class="alert alert-danger"><strong>Error!</strong>' + resUpload + '</div>')
                        _invalid.show()
                    } else {
                        _invalid.hide()
                        $('#' + preview).css('background-image', 'url(' + e.target.result + ')');
                        $('#' + preview).hide();
                        $('#' + preview).fadeIn(650);
                    }
                } else {
                    $('#' + preview).hide()
                    _invalid.html('<div class="alert alert-danger"><strong>Error!</strong> Invalid image file.</div>')
                    _invalid.show()
                }

            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('.imageUpload').bind('change', function (e) {
        e.preventDefault()
        readURL(this)
    });
})