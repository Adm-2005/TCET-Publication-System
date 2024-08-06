document.getElementById('signupForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const branch = document.getElementById('branch').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    
    const response = await fetch('signup.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ firstName, lastName, username, email, branch, password, confirmPassword })
    });

    const result = await response.json();
    const messageElement = document.getElementById('message');
    if (result.success) {
        messageElement.style.color = 'green';
        messageElement.textContent = 'Signup successful!';
    } else {
        messageElement.style.color = 'red';
        messageElement.textContent = 'Signup failed: ' + result.message;
    }
});