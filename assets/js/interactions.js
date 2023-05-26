$(document).ready( ()=>{

} )


const  passwordShow = (passowrField,passwordIcon)=>{
    let password = document.getElementById(passowrField);
    let icon = document.getElementById(passwordIcon);
    if(password.getAttribute('type') == "password"){
        password.setAttribute( "type", "text" )
        icon.classList.remove("fa-eye")
        icon.classList.add("fa-eye-slash")
    }
    else{
        password.setAttribute( "type", "password" )
        icon.classList.remove("fa-eye-slash")
        icon.classList.add("fa-eye")
    }
}