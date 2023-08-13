
document.querySelectorAll(".user_delete").forEach(
    (element) => element.addEventListener('click', deleteUser)
);

function deleteUser() {
    let id = this.getAttribute("id");

    $.get("/include/delete_user.php?userid=" + id);

    document.querySelector(".users__block[id='" + id + "']").remove();

    console.log(id);
}