
    function validateUser() {
      
      const username = document.getElementById('username').value;
      const password = document.getElementById('password').value;
      
      
      const validUsername = 'pacifique';
      const validPassword = '12345';
      
     
      if (username === validUsername && password === validPassword) {
       
        window.location.href = 'qn2.html';
      } else {
        
        alert('Invalid credentials. Please try again.');
      }
    }
