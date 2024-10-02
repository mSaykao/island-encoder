const users = [
    {
        name: "Dan Murphy",
        username: "admin",
        password: "admin"
    }
]

function login (usernameInput, passwordInput) {
    for(const user of users) {
      if (!user.username) {
        break;
        //preventing crash from null comparison that happened below for some reason
      }
      console.log(user);
      if(usernameInput === user.username && passwordInput === user.password)
      {
        //login successful
        return true;
      }
    }
  
    return false;
}

export {
    login
}