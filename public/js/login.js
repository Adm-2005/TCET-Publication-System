document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value; 
    const password = document.getElementById('password').value;

    try {
        const response = await fetch('login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username, email, password })
        });

        if (!response.ok) {
            throw new Error('Network failed to respond.');
        }

        const result = await response.json();
        console.log(result);
        const messageElement = document.getElementById('message');

        if (result.success) {
            localStorage.setItem('token', result.token);
            localStorage.setItem('role', result.role); 
            const role = localStorage.getItem('role');

            if (role === "faculty") {
                window.location.href = 'faculty_dashboard.html';
            } else {
                window.location.href = 'dashboard.html';
            }
        } else {
            messageElement.style.color = 'red';
            messageElement.textContent = 'Login failed: ' + result.message;
        }
    } catch (error) {
        console.error('Error during login:', error);
        const messageElement = document.getElementById('message');
        messageElement.style.color = 'red';
        messageElement.textContent = 'An error occurred. Please try again later.';
    }
});
