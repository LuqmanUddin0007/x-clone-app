const apiUrl = '/api';
document.getElementById('registerForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  const data = {
    name: document.getElementById('registerName').value,
    username: document.getElementById('registerUsername').value,
    email: document.getElementById('registerEmail').value,
    password: document.getElementById('registerPassword').value,
    password_confirmation: document.getElementById('registerPasswordConfirm').value
  };
  const res = await fetch(`${apiUrl}/register`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  });
  const json = await res.json();
  if (res.ok) {
    localStorage.setItem('apiToken', json.token);
    window.location.href = '/dashboard';
  } else {
    alert(json.message || 'Registration failed');
  }
});
