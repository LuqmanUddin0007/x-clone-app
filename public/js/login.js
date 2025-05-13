// POST /api/login
const apiUrl = '/api';

document.getElementById('loginForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  const data = {
    email: document.getElementById('loginEmail').value,
    password: document.getElementById('loginPassword').value
  };

  const res = await fetch(`${apiUrl}/login`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  });

  const json = await res.json();
  if (res.ok) {
    localStorage.setItem('apiToken', json.token);
    window.location.href = '/dashboard';
  } else {
    alert(json.message || 'Login failed');
  }
});
