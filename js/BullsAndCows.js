var btn_login = $('#btn_login')[0]
var loginPage = $('#login')[0]
var loginclose = $('#login>#close')[0]

btn_login.addEventListener("click", function () {
    loginPage.style.display = "flex";
});
loginclose.addEventListener("click", function () {
    loginPage.style.display = "none";
});


var btn_register = $('#btn_register')[0]
var registerPage = $('#register')[0]
var registerclose = $('#register>#close')[0]

btn_register.addEventListener("click", function () {
    registerPage.style.display = "flex";
});
registerclose.addEventListener("click", function () {
    registerPage.style.display = "none";
});

