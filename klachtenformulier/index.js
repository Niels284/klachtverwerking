function init() {
  console.log("Body loaded succesfully!");

  // Variables
  const name = document.querySelector(".name");
  const emailaddress = document.querySelector(".emailaddress");

  function emailValidation() {
    const emailValue = emailaddress.value;
    const patternForMail =
      /([a-zA-Z0-9_.+-]+)@([a-zA-Z0-9_.+-]+)\.([a-zA-Z0-9_.+-]{1,})/gi;
    if (patternForMail.test(emailValue)) {
      emailaddress.style.borderBottom = "5px solid limegreen";
      emailaddress.style.transition = "250ms linear";
    } else {
      emailaddress.style.borderBottom = "5px solid red";
      emailaddress.style.transition = "250ms linear";
    }
  }

  function nameValidation() {
    const nameValue = name.value;
    const patternForMail =
      /[0-9!@#$%^&*()_+-=\[\]\{\}\;\:\'\"\|\\\,\<\.\>\/\?\§\±]{1,}/gi;
    if (patternForMail.test(nameValue) || nameValue === "") {
      name.style.borderBottom = "5px solid red";
      name.style.transition = "250ms linear";
    } else {
      name.style.borderBottom = "5px solid limegreen";
      name.style.transition = "250ms linear";
    }
  }

  // Events add keyup
  emailaddress.addEventListener("keyup", () => {
    emailValidation();
  });
  emailaddress.addEventListener("focus", () => {
    emailValidation();
  });
  name.addEventListener("keyup", () => {
    nameValidation();
  });
  name.addEventListener("focus", () => {
    nameValidation();
  });
}

function notFocused() {
  const emailaddress = document.querySelector(".emailaddress");
  emailaddress.style.borderBottom = "3px solid #846E4F";
  emailaddress.style.transition = "250ms linear";
  const name = document.querySelector(".name");
  name.style.borderBottom = "3px solid #846E4F";
  name.style.transition = "250ms linear";
}
