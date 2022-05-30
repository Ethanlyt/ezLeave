function reviewPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
}

function directToStaffHomepage(){
    window.location.href="staffHomepage.html"
}